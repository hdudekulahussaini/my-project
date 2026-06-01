<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductVariant;

class ProductController extends Controller
{
    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
        ]);

        foreach ($request->variants as $variant) {
            ProductVariant::create([
                'product_id' => $product->id,
                'storage' => $variant['storage'],
                'color' => $variant['color'],
                'price' => $variant['price'],
                'stock' => $variant['stock'],
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Product Added Successfully');
    }

    public function index()
    {
        $products = Product::with('variants')->latest()->get();
        return view('products.index', compact('products'));
    }
}