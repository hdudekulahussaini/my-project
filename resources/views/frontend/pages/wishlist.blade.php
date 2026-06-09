@extends('layouts.frontend.app')

@section('content')
    <style>
        .wishlist-page {
            padding: 130px 0 80px;
            background: linear-gradient(180deg, #f8fafc 0%, #eef7f0 100%);
            min-height: 100vh;
        }

        .wishlist-hero {
            background: linear-gradient(135deg, #0f9f4a, #22c55e);
            border-radius: 28px;
            padding: 38px;
            color: #fff;
            margin-bottom: 35px;
            box-shadow: 0 20px 45px rgba(34, 197, 94, .28);
        }

        .wishlist-hero h2 {
            font-size: 32px;
            font-weight: 900;
        }

        .wishlist-card {
            background: #fff;
            border-radius: 26px;
            overflow: hidden;
            height: 100%;
            border: 1px solid #e8eef3;
            box-shadow: 0 12px 35px rgba(15, 23, 42, .08);
            transition: .35s ease;
            position: relative;
        }

        .wishlist-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 22px 55px rgba(15, 23, 42, .15);
        }

        .wishlist-img-box {
            height: 245px;
            background: #f1f5f9;
            position: relative;
            overflow: hidden;
        }

        .wishlist-img-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: .45s ease;
        }

        .wishlist-card:hover .wishlist-img-box img {
            transform: scale(1.08);
        }

        .wishlist-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, .45), transparent);
            opacity: 0;
            transition: .3s;
        }

        .wishlist-card:hover .wishlist-overlay {
            opacity: 1;
        }

        .heart-badge {
            position: absolute;
            top: 16px;
            right: 16px;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #fff;
            color: #ef4444;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .18);
            z-index: 2;
        }

        .stock-top-badge {
            position: absolute;
            left: 16px;
            bottom: 16px;
            z-index: 2;
            border-radius: 40px;
            padding: 8px 15px;
            font-size: 12px;
            font-weight: 800;
        }

        .wishlist-body {
            padding: 24px;
        }

        .category-badge {
            display: inline-block;
            background: #dcfce7;
            color: #15803d;
            padding: 6px 14px;
            border-radius: 40px;
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        .wishlist-title {
            color: #0f172a;
            font-size: 19px;
            font-weight: 900;
            line-height: 1.35;
            min-height: 52px;
            margin-bottom: 14px;
        }

        .wishlist-price {
            font-size: 25px;
            font-weight: 950;
            color: #16a34a;
        }

        .wishlist-meta {
            background: #f8fafc;
            border-radius: 18px;
            padding: 14px;
            margin: 16px 0;
        }

        .action-btn {
            border-radius: 40px;
            padding: 12px 18px;
            font-weight: 900;
            transition: .3s;
        }

        .btn-move-cart {
            background: #16a34a;
            color: #fff;
            border: none;
        }

        .btn-move-cart:hover {
            background: #15803d;
            color: #fff;
            transform: translateY(-2px);
        }

        .btn-move-cart:disabled {
            background: #dc2626;
            opacity: .9;
            cursor: not-allowed;
        }

        .btn-remove-wishlist {
            background: #fff1f2;
            color: #e11d48;
            border: 1px solid #fecdd3;
        }

        .btn-remove-wishlist:hover {
            background: #e11d48;
            color: #fff;
        }

        .quick-view {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #ecfdf5;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }

        .quick-view:hover {
            background: #16a34a;
            color: #fff;
        }

        .empty-wishlist {
            background: #fff;
            border-radius: 30px;
            padding: 80px 30px;
            text-align: center;
            box-shadow: 0 15px 45px rgba(15, 23, 42, .1);
        }

        .empty-wishlist i {
            font-size: 78px;
            color: #ef4444;
            margin-bottom: 22px;
        }
    </style>

    <div class="wishlist-page">
        <div class="container">

            <div class="wishlist-hero d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="mb-2">
                        <i class="fa fa-heart me-2"></i>
                        My Wishlist
                    </h2>
                    <p class="mb-0">
                        Save your favorite products and move them to cart anytime.
                    </p>
                </div>

                <a href="{{ route('shop') }}" class="btn btn-light fw-bold px-4 py-2 rounded-pill">
                    <i class="fa fa-store me-2"></i>
                    Continue Shopping
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success rounded-4 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger rounded-4 shadow-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row g-4">
                @forelse ($wishlists as $wishlist)
                    @php
                        $product = $wishlist->product;
                    @endphp

                    <div class="col-md-6 col-lg-4">
                        <div class="wishlist-card">

                            <div class="wishlist-img-box">
                                <a href="{{ route('product.details', $product->slug) }}" class="text-decoration-none">
                                    <div class="wishlist-img-box">
                                        <img src="{{ asset('storage/' . $product->thumbnail) }}" alt="{{ $product->name }}">

                                        <div class="wishlist-overlay"></div>

                                        <div class="heart-badge">
                                            <i class="fa fa-heart"></i>
                                        </div>

                                        @if ($product->stock == 0)
                                            <span class="badge bg-danger stock-top-badge">
                                                Out Of Stock
                                            </span>
                                        @elseif($product->stock <= 5)
                                            <span class="badge bg-warning text-dark stock-top-badge">
                                                Last Few Left
                                            </span>
                                        @else
                                            <span class="badge bg-success stock-top-badge">
                                                In Stock
                                            </span>
                                        @endif
                                    </div>
                                </a>

                                <div class="wishlist-overlay"></div>

                                <div class="heart-badge">
                                    <i class="fa fa-heart"></i>
                                </div>

                                @if ($product->stock == 0)
                                    <span class="badge bg-danger stock-top-badge">
                                        Out Of Stock
                                    </span>
                                @elseif($product->stock <= 5)
                                    <span class="badge bg-warning text-dark stock-top-badge">
                                        Last Few Left
                                    </span>
                                @else
                                    <span class="badge bg-success stock-top-badge">
                                        In Stock
                                    </span>
                                @endif
                            </div>

                            <div class="wishlist-body">

                                <span class="category-badge">
                                    {{ $product->category->name ?? 'Wishlist Item' }}
                                </span>

                                <a href="{{ route('product.details', $product->slug) }}" class="text-decoration-none">
                                    <h5 class="wishlist-title">
                                        {{ $product->name }}
                                    </h5>
                                </a>

                                <div class="wishlist-meta d-flex justify-content-between align-items-center">
                                    <div>
                                        <small class="text-muted d-block">Price</small>
                                        <span class="wishlist-price">
                                            ₹{{ number_format($product->sale_price, 2) }}
                                        </span>
                                    </div>
                                </div>

                                <div class="d-grid gap-2">

                                    <form action="{{ route('wishlist.move.to.cart', $wishlist->id) }}" method="POST">
                                        @csrf

                                        @if ($product->stock > 0)
                                            <button type="submit" class="btn action-btn btn-move-cart w-100">
                                                <i class="fa fa-shopping-cart me-2"></i>
                                                Move To Cart
                                            </button>
                                        @else
                                            <button type="button" class="btn action-btn btn-move-cart w-100" disabled>
                                                Out Of Stock
                                            </button>
                                        @endif
                                    </form>

                                    <form action="{{ route('wishlist.delete', $wishlist->id) }}" method="POST"
                                        onsubmit="return confirm('Remove this product from wishlist?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn action-btn btn-remove-wishlist w-100">
                                            <i class="fa fa-trash me-2"></i>
                                            Remove From Wishlist
                                        </button>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>

                @empty
                    <div class="col-12">
                        <div class="empty-wishlist">
                            <i class="fa fa-heart-broken"></i>

                            <h3 class="fw-bold">Your wishlist is empty</h3>

                            <p class="text-muted mb-4">
                                Browse products and save your favorite items here.
                            </p>

                            <a href="{{ route('shop') }}" class="btn btn-success px-5 py-3 rounded-pill fw-bold">
                                <i class="fa fa-shopping-bag me-2"></i>
                                Go To Shop
                            </a>
                        </div>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
@endsection
