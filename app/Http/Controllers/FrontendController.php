<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\Feature;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use App\Mail\OrderSuccessMail;
use App\Mail\NewOrderAdminMail;
use App\Models\Address;
use Illuminate\Support\Facades\Mail;




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
        $features = Feature::get();
        $wishlistIds = [];
        if (Auth::check()) {
            $wishlistIds = Wishlist::where('user_id', Auth::id())->pluck('product_id')->toArray();
        }
        return view('frontend.pages.index', compact('products', 'fruitProducts', 'vegetableProducts', 'features', 'wishlistIds'));
    }
    public function shop(Request $request)
    {
        $categories = Category::withCount('products')->get();

        $productQuery = Product::with('category');

        if ($request->filled('search')) {
            $search = $request->search;

            $productQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('color', 'like', "%{$search}%")
                    ->orWhere('weight', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $productQuery->where('category_id', $request->category);
        }

        if ($request->filled('sort')) {
            match ($request->sort) {
                'price_asc' => $productQuery->orderBy('sale_price', 'asc'),
                'price_desc' => $productQuery->orderBy('sale_price', 'desc'),
                'name' => $productQuery->orderBy('name', 'asc'),
                default => $productQuery->latest(),
            };
        } else {
            $productQuery->latest();
        }

        $products = $productQuery->get();

        $featuredProducts = Product::with('category')->latest()->take(4)->get();

        return view('frontend.pages.shop', compact(
            'products',
            'categories',
            'featuredProducts'
        ));
    }
    public function contact()
    {
        return view('frontend.pages.contact');
    }
    public function wishlist()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to view your wishlist.');
        }
        $wishlists = Wishlist::with('product')->where('user_id', Auth::id())->get();
        return view('frontend.pages.wishlist', compact('wishlists'));
    }
    public function addToWishlist(Product $product)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to add products to your wishlist.');
        }
        $existing = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();
        if ($existing) {
            return redirect()->route('wishlist')->with('info', 'Product is already in your wishlist.');
        }
        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);
        return back()->with('success', 'Product added to wishlist.');
    }
    public function moveCartToWishlist(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }
        Wishlist::firstOrCreate([
            'user_id' => Auth::id(),
            'product_id' => $cart->product_id,
        ]);
        $cart->delete();
        return back()->with('success', 'Product moved to wishlist.');
    }
    public function moveWishlistToCart(Wishlist $wishlist)
    {
        if ($wishlist->user_id !== Auth::id()) {
            abort(403);
        }
        $cart = Cart::where('user_id', Auth::id())
            ->where('product_id', $wishlist->product_id)
            ->first();
        if ($cart) {
            $cart->increment('quantity');
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $wishlist->product_id,
                'quantity' => 1,
            ]);
        }
        $wishlist->delete();
        return back()->with('success', 'Product moved to cart.');
    }
    public function deleteWishlist(Wishlist $wishlist)
    {
        if ($wishlist->user_id !== Auth::id()) {
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
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Please login to add products to your cart.');
        }

        // Check stock first
        if ($product->stock <= 0) {
            return back()->with('error', 'Product is Out Of Stock');
        }

        $cart = Cart::where('product_id', $product->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($cart) {

            if (($cart->quantity + 1) > $product->stock) {
                return back()->with(
                    'error',
                    'Only ' . $product->stock . ' quantity available.'
                );
            }

            $cart->increment('quantity');
        } else {

            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return back()->with('success', 'Product added to cart.');
    }
    public function cart()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to view your cart.');
        }
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('frontend.pages.cart', compact('carts'));
    }

    public function deleteCart(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }
        $cart->delete();
        return back();
    }

    public function increaseCartQuantity(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
            abort(403);
        }

        $product = $cart->product;
        if ($cart->quantity >= $product->stock) {
            return back()->with(
                'error',
                'Only ' . $product->stock . ' quantity available.'
            );
        }
        $cart->increment('quantity');
        return back()->with(
            'success',
            'Quantity updated successfully.'
        );
    }
    public function decreaseCartQuantity(Cart $cart)
    {
        if ($cart->user_id !== Auth::id()) {
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
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to checkout.');
        }
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        $addresses = Address::where('user_id', Auth::id())->get();
        return view('frontend.pages.checkout', compact('carts', 'addresses'));
    }
    public function storeOrder(Request $request)
    {
        $request->validate([
            'address_id' => 'required|exists:addresses,id',
            'payment_method' => 'required|in:cod,razorpay,bank,paypal',
        ]);

        if ($request->payment_method == 'razorpay' && !$request->razorpay_payment_id) {
            return back()->with('error', 'Payment failed. Please try again.');
        }

        $selectedAddress = Address::findOrFail($request->address_id);

        $carts = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        // CHECK STOCK BEFORE ORDER
        foreach ($carts as $cart) {

            if ($cart->product->stock <= 0) {
                return back()->with(
                    'error',
                    $cart->product->name . ' is Out Of Stock'
                );
            }

            if ($cart->product->stock < $cart->quantity) {
                return back()->with(
                    'error',
                    'Only ' . $cart->product->stock .
                        ' quantity available for ' .
                        $cart->product->name
                );
            }
        }

        $total = 0;

        foreach ($carts as $cart) {
            $total += $cart->product->sale_price * $cart->quantity;
        }

        $paymentMethod = match ($request->payment_method) {
            'cod' => 'COD',
            'razorpay' => 'Razorpay',
            default => 'COD',
        };

        $order = Order::create([
            'user_id' => Auth::id(),
            'address_id' => $selectedAddress->id,
            'name' => $selectedAddress->name,
            'phone' => $selectedAddress->phone,
            'address' => $selectedAddress->address,
            'email' => $selectedAddress->email,
            'total' => $total + 50,
            'payment_method' => $paymentMethod,
            'payment_status' => $request->payment_method == 'razorpay'
                ? 'Paid'
                : 'Pending',
            'transaction_id' => $request->payment_method == 'razorpay'
                ? $request->razorpay_payment_id
                : null,
        ]);

        foreach ($carts as $cart) {

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->sale_price,
            ]);

            // REDUCE STOCK
            $cart->product->decrement(
                'stock',
                $cart->quantity
            );
        }

        Mail::to($order->email)
            ->send(new OrderSuccessMail($order));

        Mail::to('hdudekulahussaini@gmail.com')
            ->send(new NewOrderAdminMail($order));

        Cart::where('user_id', Auth::id())->delete();

        return redirect('/')
            ->with('success', 'Order placed successfully!');
    }
    public function orders()
    {
        $ordersQuery = Order::latest();
        if (Schema::hasColumn('orders', 'user_id')) {
            $ordersQuery->where(function ($query) {
                $query->where('user_id', Auth::id())
                    ->orWhere('email', Auth::user()->email);
            });
        } else {
            $ordersQuery->where('email', Auth::user()->email);
        }
        $orders = $ordersQuery->get();
        return view('frontend.pages.orders', compact('orders'));
    }

    public function userDashboard()
    {
        if (Schema::hasColumn('orders', 'user_id')) {
            $ordersCount = Order::where(function ($query) {
                $query->where('user_id', Auth::id())
                    ->orWhere('email', Auth::user()->email);
            })->count();
        } else {
            $ordersCount = Order::where('email', Auth::user()->email)->count();
        }

        $cartCount = Cart::where('user_id', Auth::id())->count();
        $wishlistCount = Wishlist::where('user_id', Auth::id())->count();
        return view('frontend.pages.user-dashboard', compact('ordersCount', 'cartCount', 'wishlistCount'));
    }

}
