<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $categories = Category::count();
        $products = Product::count();
        $users = User::count();
        $orders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalRevenue = Order::sum('total');
        $recentCategories = Category::latest()->take(5)->get();
        $recentProducts = Product::with('category')->latest()->take(5)->get();

        return view('backend.pages.dashboard.index', compact(
            'categories',
            'products',
            'users',
            'orders',
            'pendingOrders',
            'totalRevenue',
            'recentCategories',
            'recentProducts'
        ));
    }
}
