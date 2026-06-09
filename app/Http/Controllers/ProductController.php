<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function create()
    {
        $categories = Category::latest()->get();
        return view('products.create', compact('categories'));
    }

    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required|string|max:255',
            'sale_price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,webp',
        ]);

        $thumbnailPath = null;

        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('products', 'public');
        }

        $galleryPaths = [];

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $galleryPaths[] = $image->store('products/gallery', 'public');
            }
        }

        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $request->slug ?: Str::slug($request->name),
            'thumbnail' => $thumbnailPath,
            'gallery' => json_encode($galleryPaths),
            'sale_price' => $request->sale_price,
            'original_price' => $request->original_price,
            'color' => $request->color,
            'weight' => $request->weight,
            'stock' => $request->stock,
            'description' => $request->description,
        ]);

        return redirect()->route('products.index')
            ->with('success', 'Product Added Successfully');
    }
}