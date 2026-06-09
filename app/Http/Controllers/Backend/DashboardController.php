<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Wishlist;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $categories = Category::count();
        $products = Product::count();
        $users = User::count();
        $orders = Order::count();
        $pendingOrders = Order::where('payment_status', 'Pending')->count();
        $totalRevenue = Order::sum('total');
        $customers = User::where('user_type', 'customer')->count();
        $wishlists = Wishlist::count();
        
        $recentCategories = Category::latest()->take(5)->get();
        $recentProducts = Product::with('category')->latest()->take(5)->get();
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $recentCustomers = User::where('user_type', 'customer')->latest()->take(5)->get();
        $recentWishlists = Wishlist::with(['user', 'product'])->latest()->take(5)->get();

        return view('backend.pages.dashboard.index', compact(
            'categories',
            'products',
            'users',
            'orders',
            'pendingOrders',
            'totalRevenue',
            'customers',
            'wishlists',
            'recentCategories',
            'recentProducts',
            'recentOrders',
            'recentCustomers',
            'recentWishlists'
        ));
    }
}
