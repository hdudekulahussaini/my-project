<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('backend.pages.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.pages.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'sale_price' => 'required',
            'original_price' => 'required',
            'thumbnail' => 'nullable|image',
            'gallery.*' => 'nullable|image',
            'stock' => 'required|integer|min:0',
        ]);

        $image = null;

        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail')->store('products', 'public');
        }
        $galleryImages = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $gallery) {
                $galleryImages[] = $gallery->store('products/gallery', 'public');
            }
        }
        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'thumbnail' => $image,
            'gallery' => json_encode($galleryImages),
            'sale_price' => $request->sale_price,
            'original_price' => $request->original_price,
            'color' => $request->color,
            'weight' => $request->weight,
            'stock' => $request->stock,
            'description' => $request->description,
        ]);
        return redirect()->route('products.index');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('backend.pages.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'slug' => 'nullable|string|unique:products,slug,' . $product->id,
            'sale_price' => 'required',
            'original_price' => 'required',
            'thumbnail' => 'nullable|image',
            'gallery.*' => 'nullable|image',
            'stock' => 'required|integer|min:0',
        ]);
        $image = $product->thumbnail;
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail')->store('products', 'public');
        }
        $galleryImages = json_decode($product->gallery, true) ?? [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $gallery) {
                $galleryImages[] = $gallery->store('products/gallery', 'public');
            }
        }
        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => $request->slug && !empty(trim($request->slug)) ? Str::slug($request->slug) : Str::slug($request->name),
            'thumbnail' => $image,
            'gallery' => json_encode($galleryImages),
            'sale_price' => $request->sale_price,
            'original_price' => $request->original_price,
            'color' => $request->color,
            'weight' => $request->weight,
            'stock' => $request->stock,
            'description' => $request->description,
        ]);
        return redirect()->route('products.index');
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
    public function show(Product $product)
    {
        return redirect()->route('products.index');
    }
}