<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Backend\DashboardController;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        $fruitProducts = Product::with('category')->whereHas('category', function ($q) {
            $q->where('slug', 'fruits');
        })->latest()->take(4)->get();
        $vegetableProducts = Product::with('category')->whereHas('category', function ($q) {
            $q->where('slug', 'vegetables');
        })->latest()->get()->unique('name');
        return view('frontend.pages.index', compact('products', 'fruitProducts', 'vegetableProducts'));
    }
    public function shop()
    {
        $products = Product::with('category')->latest()->get();
        $fruitProducts = Product::with('category')->whereHas('category', function ($q) {
            $q->where('slug', 'fruits');
        })->latest()->get();
        $categories = Category::withCount('products')->get();
        return view('frontend.pages.shop', compact('products', 'fruitProducts', 'categories'));
    }
    public function contact()
    {
        return view('frontend.pages.contact');
    }
    public function wishlist()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to view your wishlist.');
        }

        $wishlists = Wishlist::with('product')->where('user_id', auth()->id())->get();
        return view('frontend.pages.wishlist', compact('wishlists'));
    }

    public function addToWishlist(Product $product)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to add products to your wishlist.');
        }

        $existing = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($existing) {
            return back()->with('info', 'Product is already in your wishlist.');
        }

        Wishlist::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
        ]);

        return back()->with('success', 'Product added to wishlist.');
    }

    public function moveCartToWishlist(Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        Wishlist::firstOrCreate([
            'user_id' => auth()->id(),
            'product_id' => $cart->product_id,
        ]);

        $cart->delete();

        return back()->with('success', 'Product moved to wishlist.');
    }

    public function moveWishlistToCart(Wishlist $wishlist)
    {
        if ($wishlist->user_id !== auth()->id()) {
            abort(403);
        }

        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $wishlist->product_id)
            ->first();

        if ($cart) {
            $cart->increment('quantity');
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $wishlist->product_id,
                'quantity' => 1,
            ]);
        }

        $wishlist->delete();

        return back()->with('success', 'Product moved to cart.');
    }

    public function deleteWishlist(Wishlist $wishlist)
    {
        if ($wishlist->user_id !== auth()->id()) {
            abort(403);
        }

        $wishlist->delete();

        return back()->with('success', 'Product removed from wishlist.');
    }

    public function productDetails($slug)
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();
        return view('frontend.pages.product-details', compact('product'));
    }
    public function addToCart(Product $product)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to add products to your cart.');
        }
        $cart = Cart::where('product_id', $product->id)
            ->where('user_id', auth()->id())
            ->first();
        if ($cart) {
            $cart->increment('quantity');
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }
        return redirect()->route('cart')->with('success', 'Product added to cart.');
    }
    public function cart()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to view your cart.');
        }
        $carts = Cart::with('product')->where('user_id', auth()->id())->get();
        return view('frontend.pages.cart', compact('carts'));
    }

    public function deleteCart(Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }
        $cart->delete();
        return back();
    }

    public function increaseCartQuantity(Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }
        $cart->increment('quantity');
        return back();
    }
    public function decreaseCartQuantity(Cart $cart)
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        if ($cart->quantity > 1) {
            $cart->decrement('quantity');
        } else {
            $cart->delete();
        }
        return back();
    }

    public function checkout()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please login to checkout.');
        }
        $carts = Cart::with('product')->where('user_id', auth()->id())->get();
        return view('frontend.pages.checkout', compact('carts'));
    }

    public function storeOrder(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $name = trim($request->first_name . ' ' . $request->last_name);

        $carts = Cart::with('product')->where('user_id', auth()->id())->get();
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->product->sale_price * $cart->quantity;
        }

        $orderData = [
            'name' => $name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'total' => $total + 50,
            'status' => 'pending',
        ];

        if (auth()->check() && Schema::hasColumn('orders', 'user_id')) {
            $orderData['user_id'] = auth()->id();
        }

        $order = Order::create($orderData);

        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->sale_price,
            ]);
        }

        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('orders')->with('success', 'Order placed successfully.');
    }
    public function orders()
    {
        if (auth()->check() && Schema::hasColumn('orders', 'user_id')) {
            $orders = Order::where('user_id', auth()->id())->latest()->get();
        } else {
            $orders = Order::where('email', auth()->user()->email)->latest()->get();
        }

        return view('frontend.pages.orders', compact('orders'));
    }

    public function userDashboard()
    {
        if (Schema::hasColumn('orders', 'user_id')) {
            $ordersCount = Order::where('user_id', auth()->id())->count();
        } else {
            $ordersCount = Order::where('email', auth()->user()->email)->count();
        }

        $cartCount = Cart::where('user_id', auth()->id())->count();
        $wishlistCount = Wishlist::where('user_id', auth()->id())->count();

        return view('frontend.pages.user-dashboard', compact('ordersCount','cartCount','wishlistCount'));
    }
}
