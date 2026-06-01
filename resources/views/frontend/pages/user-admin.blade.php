@extends('layouts.frontend.app')

@section('content')

<div class="container py-5 mb-5" style="margin-top:120px;">
    <h2 class="mb-4">User Admin Dashboard</h2>
    <div class="row">

        <div class="col-md-6">
            <div class="card p-4 shadow text-center">
                <h4>Categories</h4>
                <h2>{{ $categories }}</h2>

                <a href="{{ route('categories.index') }}"
                   class="btn btn-primary">
                    Manage Categories
                </a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card p-4 shadow text-center">
                <h4>Products</h4>
                <h2>{{ $products }}</h2>

                <a href="{{ route('products.index') }}"
                   class="btn btn-success">
                    Manage Products
                </a>
            </div>
        </div>
    </div>
</div>
@endsection