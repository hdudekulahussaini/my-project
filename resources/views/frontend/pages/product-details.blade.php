@extends('layouts.frontend.app')

@section('content')
    <div class="container py-5" style="margin-top:120px;">

        <div class="row g-5">

            <div class="col-lg-6">

                <img src="{{ asset('storage/' . $product->thumbnail) }}" class="img-fluid rounded w-100"
                    alt="{{ $product->name }}">

            </div>

            <div class="col-lg-6">

                <h2>
                    {{ $product->name }}
                </h2>

                <p>

                    Category :

                    <span class="badge bg-success">

                        {{ $product->category->name }}

                    </span>

                </p>

                <h3 class="text-primary">

                    ₹{{ number_format($product->sale_price, 2) }}

                </h3>

                <del class="text-danger">

                    ₹{{ number_format($product->original_price, 2) }}

                </del>

                <p class="mt-3">

                    {{ $product->description }}

                </p>

                <p>

                    Weight :

                    {{ $product->weight }}

                </p>

                <p>

                    Color :

                    {{ $product->color }}

                </p>

                <div class="d-flex gap-3">

                    <input type="number" class="form-control" value="1" min="1" style="width:100px;">

                    <button class="btn btn-primary">

                        Add To Cart

                    </button>

                </div>

            </div>

        </div>

    </div>
@endsection
