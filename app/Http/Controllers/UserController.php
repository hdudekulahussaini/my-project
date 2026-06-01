<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\Order;
use Illuminate\Support\Facades\Schema;

class UserController extends Controller
{
    public function dashboard()
    {
        if (Schema::hasColumn('orders', 'user_id')) {
            $ordersCount = Order::where('user_id', auth()->id())->count();
        } else {
            $ordersCount = Order::where('email', auth()->user()->email)->count();
        }

        $cartCount = Cart::where('user_id', auth()->id())->count();
        $wishlistCount = Wishlist::where('user_id', auth()->id())->count();

        return view('frontend.pages.user-dashboard', compact('ordersCount', 'cartCount', 'wishlistCount'));
    }
}