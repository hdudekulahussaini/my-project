@extends('layouts.frontend.app')
@section('content')
    <!-- Shop Header Start -->
    <div class="container-fluid page-header py-5">
        <div class="container py-5">
            <div class="text-center">
                <h1 class="display-5 text-white">Shop Fresh Organic Products</h1>
                <p class="text-white-50 mb-4">Browse premium fruits, vegetables, and farm-fresh groceries with fast delivery.
                </p>
            </div>
            <div class="row justify-content-center">
                <div class="col-xl-6">
                    <form action="{{ route('shop') }}" method="GET" class="position-relative">
                        <input type="search" name="search" value="{{ request('search') }}"
                            class="form-control border-0 rounded-pill py-3 ps-4 pe-5"
                            placeholder="Search products, categories or brands...">
                        <button type="submit"
                            class="btn btn-primary rounded-pill position-absolute top-50 end-0 translate-middle-y me-2 px-4">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Header End -->

    <!-- Shop Content Start -->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-3">
                    <div class="card border-0 shadow-sm mb-4 shop-sidebar">
                        <div class="card-body">
                            <h4 class="mb-4">Shop Filters</h4>
                            <div class="mb-4">
                                <h6 class="mb-3">Categories</h6>
                                @if ($categories->count())
                                    <ul class="list-unstyled fruite-categorie">
                                        @foreach ($categories as $cat)
                                            <li>
                                                <div class="d-flex justify-content-between fruite-name align-items-center">
                                                    <a href="{{ request()->fullUrlWithQuery(['category' => $cat->id]) }}">
                                                        <i class="fas fa-leaf me-2"></i>{{ $cat->name }}
                                                    </a>
                                                    <span class="text-secondary">{{ $cat->products_count }}</span>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-muted">No categories found.</p>
                                @endif
                                @if (request('category'))
                                    <a href="{{ route('shop') }}" class="btn btn-sm btn-outline-secondary mt-3">Clear
                                        filter</a>
                                @endif
                            </div>
                            <div class="mb-4">
                                <h6 class="mb-3">Price range</h6>
                                <input type="range" class="form-range" min="0" max="500" value="0"
                                    id="priceRange">
                                <div class="d-flex justify-content-between mt-2">
                                    <small>0</small>
                                    <small>500+</small>
                                </div>
                            </div>
                            <div class="mb-4">
                                <h6 class="mb-3">Featured items</h6>
                                @foreach ($featuredProducts as $product)
                                    <div class="d-flex mb-3 align-items-center">
                                        <img src="{{ asset('storage/' . $product->thumbnail) }}" class="rounded"
                                            style="width: 70px; height: 70px; object-fit: cover;"
                                            alt="{{ $product->name }}">
                                        <div class="ms-3">
                                            <h6 class="mb-1">{{ Str::limit($product->name, 24) }}</h6>
                                            <small
                                                class="text-secondary">₹{{ number_format($product->sale_price, 2) }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="bg-light rounded p-4 text-center">
                                <h5>Need help?</h5>
                                <p class="text-muted mb-3">Our team is here to help you pick the best fresh produce.</p>
                                <a href="{{ route('contact') }}" class="btn btn-outline-primary rounded-pill">Contact
                                    Us</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div
                        class="d-flex flex-column flex-md-row align-items-start align-items-md-center justify-content-between mb-4 gap-3">
                        <div>
                            <p class="mb-1 text-secondary">{{ $products->count() }} products available</p>
                            <h2 class="h4 mb-0">Organic Grocery Store</h2>
                        </div>
                        <form action="{{ route('shop') }}" method="GET" class="d-flex align-items-center gap-2">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <input type="hidden" name="category" value="{{ request('category') }}">
                            <label class="mb-0 text-secondary">Sort by</label>
                            <select name="sort" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="" {{ request('sort') === null ? 'selected' : '' }}>Latest</option>
                                <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Price low
                                    to high</option>
                                <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price
                                    high to low</option>
                                <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Name</option>
                            </select>
                        </form>
                    </div>

                    <div class="row g-4">
                        @forelse ($products as $product)
                            <div class="col-md-6 col-xl-4">
                                <div class="card product-card h-100 border-0 shadow-sm overflow-hidden">
                                    <div class="position-relative product-image">
                                        <a href="{{ route('product.details', $product->slug) }}">
                                            <img src="{{ asset('storage/' . $product->thumbnail) }}" class="card-img-top"
                                                alt="{{ $product->name }}" style="height: 240px; object-fit: cover;">
                                        </a>
                                        <span
                                            class="badge bg-secondary position-absolute top-0 start-0 m-3">{{ $product->category->name ?? 'No Category' }}</span>
                                        <form action="{{ route('wishlist.add', $product->id) }}" method="POST"
                                            class="position-absolute top-0 end-0 m-3">
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-light rounded-circle shadow-sm p-2 wishlist-btn"
                                                title="Add to wishlist">
                                                <i class="fa-solid fa-heart text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="card-body d-flex flex-column">
                                        <a href="{{ route('product.details', $product->slug) }}"
                                            class="text-decoration-none text-dark">
                                            <h5 class="card-title">{{ $product->name }}</h5>
                                        </a>
                                        <p class="text-muted small mb-3">{{ Str::limit($product->description, 100) }}</p>
                                        <div class="mt-auto">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <div>
                                                    <span class="text-primary fs-5 fw-bold">
                                                        ₹{{ number_format($product->sale_price, 2) }}
                                                    </span>
                                                    <span class="text-muted">/ kg</span>
                                                </div>
                                            </div>
                                            @if ($product->stock > 0)
                                                <span class="badge bg-success mb-2">
                                                    In Stock ({{ $product->stock }})
                                                </span>
                                            @else
                                                <span class="badge bg-danger mb-2">
                                                    Out Of Stock
                                                </span>
                                            @endif
                                            <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                                @csrf
                                                @if ($product->stock > 0)
                                                    <button type="submit"
                                                        class="btn btn-outline-primary w-100 rounded-pill py-2">
                                                        <i class="fa fa-shopping-bag me-2"></i>
                                                        Add to Cart
                                                    </button>
                                                @else
                                                    <button type="button" class="btn btn-danger w-100 rounded-pill py-2"
                                                        disabled>
                                                        Out Of Stock
                                                    </button>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <p class="text-secondary mb-0">No products found. Try a different search or category.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="d-flex justify-content-center mt-5">
                        <div class="pagination">
                            <a href="#" class="rounded">&laquo;</a>
                            <a href="#" class="active rounded">1</a>
                            <a href="#" class="rounded">2</a>
                            <a href="#" class="rounded">3</a>
                            <a href="#" class="rounded">4</a>
                            <a href="#" class="rounded">5</a>
                            <a href="#" class="rounded">&raquo;</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Content End -->
@endsection
