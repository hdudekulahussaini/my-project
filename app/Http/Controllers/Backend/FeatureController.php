<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feature;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::latest()->get();
        return view('backend.pages.features.index', compact('features'));
    }

    public function create()
    {
        return view('backend.pages.features.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);
        Feature::create([
            'icon' => $request->icon,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);
        return redirect()->route('features.index')->with('success', 'Feature Added Successfully');
    }

    public function edit(Feature $feature)
    {
        return view('backend.pages.features.edit', compact('feature'));
    }

    public function update(Request $request, Feature $feature)
    {
        $request->validate([
            'icon' => 'required',
            'title' => 'required',
            'description' => 'required',
        ]);
        $feature->update([
            'icon' => $request->icon,
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);
        return redirect()->route('features.index')->with('success', 'Feature Updated Successfully');
    }
    public function destroy(Feature $feature)
    {
        $feature->delete();
        return redirect()->route('features.index')->with('success', 'Feature Deleted Successfully');
    }
}