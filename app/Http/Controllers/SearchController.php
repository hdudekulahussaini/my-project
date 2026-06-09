<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
     public function liveSearch(Request $request)
    {
        $products = \App\Models\Product::where('name', 'LIKE', '%' . $request->search . '%')
            ->select('id', 'name', 'slug', 'thumbnail', 'sale_price')
            ->limit(10)
            ->get();

        return response()->json($products);
    }
}
