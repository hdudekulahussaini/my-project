<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class UserAdminController extends Controller
{
    public function index()
    {
        $categories = Category::count();
        $products = Product::count();
        return view('frontend.pages.user-admin', compact('categories', 'products'));
    }
}