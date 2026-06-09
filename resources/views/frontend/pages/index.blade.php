@extends('layouts.frontend.app')
@section('content')
    <!-- Hero Start -->
    <div class="container-fluid py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-md-12 col-lg-7">
                    <h4 class="mb-3 text-secondary">100% Organic Foods</h4>
                    <h1 class="mb-5 display-3 text-primary">Organic Veggies & Fruits Foods</h1>
                    <div class="position-relative mx-auto">
                        <input class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" type="number"
                            placeholder="Search">
                        <button type="submit"
                            class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100"
                            style="top: 0; right: 25%;">Submit Now</button>
                    </div>
                </div>
                <div class="col-md-12 col-lg-5">
                    <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            <div class="carousel-item active rounded">
                                <img src="{{ asset('frontend/img/hero-img-1.png') }}"
                                    class="img-fluid w-100 h-100 bg-secondary rounded" alt="First slide">
                                <a href="#" class="btn px-4 py-2 text-white rounded">Fruites</a>
                            </div>
                            <div class="carousel-item rounded">
                                <img src="{{ asset('frontend/img/hero-img-2.jpg') }}" class="img-fluid w-100 h-100 rounded"
                                    alt="Second slide">
                                <a href="#" class="btn px-4 py-2 text-white rounded">Vesitables</a>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselId"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselId"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero End -->

    <!-- Featurs Section Start -->
    <div class="container-fluid featurs py-5">
        <div class="container py-5">
            <div class="row g-4">
                @foreach ($features as $feature)
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="{{ $feature->icon }} fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>{{ $feature->title }}</h5>
                                <p class="mb-0">{{ $feature->description }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Featurs Section End -->

    <!-- Fruits Products Start -->
    <div class="container-fluid fruite py-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-6">
                    <h1>Our Organic Products</h1>
                </div>
            </div>

            <div class="row g-4">
                @foreach ($fruitProducts as $product)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="rounded position-relative product-card border border-secondary">

                            <div class="product-img-box">
                                <a href="{{ route('product.details', $product->slug) }}">
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                        class="img-fluid w-100 rounded-top" alt="{{ $product->name }}">
                                </a>
                            </div>

                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                style="top: 10px; left: 10px;">
                                {{ $product->category->name ?? 'No Category' }}
                            </div>

                            <form action="{{ route('wishlist.add', $product->id) }}" method="POST"
                                class="position-absolute" style="top:10px; right:10px; z-index:10;">
                                @csrf

                                <button type="submit"
                                    class="wishlist-btn {{ in_array($product->id, $wishlistIds) ? 'in-wishlist' : 'not-wishlist' }}">
                                    <i
                                        class="{{ in_array($product->id, $wishlistIds) ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                                </button>
                            </form>

                            <div class="p-4">
                                <a href="{{ route('product.details', $product->slug) }}"
                                    class="text-decoration-none text-dark">
                                    <h4 class="mb-2">{{ $product->name }}</h4>
                                </a>

                                <p class="text-muted mb-3">
                                    {{ Str::limit($product->description, 65) }}
                                </p>

                                <div class="product-footer">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div>
                                            <h5 class="fw-bold text-dark mb-0">
                                                ₹{{ number_format($product->sale_price, 2) }}
                                            </h5>

                                            <small class="text-muted">
                                                {{ $product->weight ?? 'kg' }}
                                            </small>
                                        </div>

                                        <div>
                                            @if ($product->stock == 0)
                                                <span class="badge bg-danger stock-badge">
                                                    Out Of Stock
                                                </span>
                                            @elseif ($product->stock <= 5)
                                                <span class="badge bg-warning text-dark stock-badge">
                                                    Last Few Left
                                                </span>
                                            @else
                                                <span class="badge bg-success stock-badge">
                                                    In Stock
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf

                                        @if ($product->stock > 0)
                                            <button type="submit" class="btn btn-success add-cart-btn">
                                                <i class="fa fa-shopping-bag me-2"></i>
                                                Add To Cart
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-danger add-cart-btn" disabled>
                                                Out Of Stock
                                            </button>
                                        @endif
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Fruits Products End -->


    <!-- Featurs Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <a href="#">
                        <div class="service-item bg-secondary rounded border border-secondary">
                            <img src="{{ asset('frontend/img/featur-1.jpg') }}" class="img-fluid rounded-top w-100"
                                alt="">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-primary text-center p-4 rounded">
                                    <h5 class="text-white">Fresh Apples</h5>
                                    <h3 class="mb-0">20% OFF</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="#">
                        <div class="service-item bg-dark rounded border border-dark">
                            <img src="{{ asset('frontend/img/featur-2.jpg') }}" class="img-fluid rounded-top w-100"
                                alt="">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-light text-center p-4 rounded">
                                    <h5 class="text-primary">Tasty Fruits</h5>
                                    <h3 class="mb-0">Free delivery</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="#">
                        <div class="service-item bg-primary rounded border border-primary">
                            <img src="{{ asset('frontend/img/featur-3.jpg') }}" class="img-fluid rounded-top w-100"
                                alt="">
                            <div class="px-4 rounded-bottom">
                                <div class="service-content bg-secondary text-center p-4 rounded">
                                    <h5 class="text-white">Exotic Vegitable</h5>
                                    <h3 class="mb-0">Discount 30$</h3>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Featurs End -->

    <!-- Vegetable Shop Start -->
    <div class="container-fluid vesitable py-5">
        <div class="container py-5">
            <h1 class="mb-4">Fresh Organic Vegetables</h1>

            <div class="owl-carousel vegetable-carousel justify-content-center">
                @foreach ($vegetableProducts as $product)
                    <div class="border border-primary rounded position-relative vesitable-item product-card">

                        <div class="product-img-box">
                            <a href="{{ route('product.details', $product->slug) }}">
                                @if ($product->thumbnail)
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                        class="img-fluid w-100 rounded-top" alt="{{ $product->name }}">
                                @else
                                    <img src="{{ asset('frontend/img/vegetable-item-6.jpg') }}"
                                        class="img-fluid w-100 rounded-top" alt="No Image">
                                @endif
                            </a>
                        </div>

                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                            style="top: 10px; right: 10px;">
                            {{ $product->category->name ?? 'No Category' }}
                        </div>

                        <form action="{{ route('wishlist.add', $product->id) }}" method="POST"
                            class="position-absolute" style="top:10px; left:10px; z-index:10;">
                            @csrf

                            <button type="submit"
                                class="wishlist-btn {{ in_array($product->id, $wishlistIds) ? 'in-wishlist' : 'not-wishlist' }}">
                                <i
                                    class="{{ in_array($product->id, $wishlistIds) ? 'fa-solid' : 'fa-regular' }} fa-heart"></i>
                            </button>
                        </form>

                        <div class="p-4 rounded-bottom">
                            <a href="{{ route('product.details', $product->slug) }}"
                                class="text-decoration-none text-dark">
                                <h4 class="mb-2">{{ $product->name }}</h4>
                            </a>

                            <p class="text-muted mb-3">
                                {{ Str::limit($product->description, 65) }}
                            </p>

                            <div class="product-footer">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h5 class="fw-bold text-dark mb-0">
                                            ₹{{ number_format($product->sale_price, 2) }}
                                        </h5>

                                        <small class="text-muted">
                                            {{ $product->weight ?? 'kg' }}
                                        </small>
                                    </div>

                                    <div>
                                        @if ($product->stock == 0)
                                            <span class="badge bg-danger stock-badge">
                                                Out Of Stock
                                            </span>
                                        @elseif ($product->stock <= 5)
                                            <span class="badge bg-warning text-dark stock-badge">
                                                Last Few Left
                                            </span>
                                        @else
                                            <span class="badge bg-success stock-badge">
                                                In Stock
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                    @csrf

                                    @if ($product->stock > 0)
                                        <button type="submit" class="btn btn-success add-cart-btn">
                                            <i class="fa fa-shopping-bag me-2"></i>
                                            Add To Cart
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-danger add-cart-btn" disabled>
                                            Out Of Stock
                                        </button>
                                    @endif
                                </form>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Vegetable Shop End -->


    <!-- Banner Section Start-->
    <div class="container-fluid banner bg-secondary my-5">
        <div class="container py-5">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="py-4">
                        <h1 class="display-3 text-white">Fresh Exotic Fruits</h1>
                        <p class="fw-normal display-3 text-dark mb-4">in Our Store</p>
                        <p class="mb-4 text-dark">The generated Lorem Ipsum is therefore always free from repetition
                            injected humour, or non-characteristic words etc.</p>
                        <a href="#"
                            class="banner-btn btn border-2 border-white rounded-pill text-dark py-3 px-5">BUY</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative">
                        <img src="{{ asset('frontend/img/baner-1.png') }}" class="img-fluid w-100 rounded"
                            alt="">
                        <div class="d-flex align-items-center justify-content-center bg-white rounded-circle position-absolute"
                            style="width: 140px; height: 140px; top: 0; left: 0;">
                            <h1 style="font-size: 100px;">1</h1>
                            <div class="d-flex flex-column">
                                <span class="h2 mb-0">50$</span>
                                <span class="h4 text-muted mb-0">kg</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Section End -->


    <!-- Bestsaler Product Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mx-auto mb-5" style="max-width: 700px;">
                <h1 class="display-4">Bestseller Products</h1>
                <p>Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks
                    reasonable.</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-light">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <img src="{{ asset('frontend/img/best-product-1.jpg') }}"
                                    class="img-fluid rounded-circle w-100" alt="">
                            </div>
                            <div class="col-6">
                                <a href="#" class="h5">Organic Tomato</a>
                                <div class="d-flex my-3">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4 class="mb-3">3.12 $</h4>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-light">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <img src="{{ asset('frontend/img/best-product-2.jpg') }}"
                                    class="img-fluid rounded-circle w-100" alt="">
                            </div>
                            <div class="col-6">
                                <a href="#" class="h5">Organic Tomato</a>
                                <div class="d-flex my-3">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4 class="mb-3">3.12 $</h4>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-light">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <img src="{{ asset('frontend/img/best-product-3.jpg') }}"
                                    class="img-fluid rounded-circle w-100" alt="">
                            </div>
                            <div class="col-6">
                                <a href="#" class="h5">Organic Tomato</a>
                                <div class="d-flex my-3">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4 class="mb-3">3.12 $</h4>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-light">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <img src="{{ asset('frontend/img/best-product-4.jpg') }}"
                                    class="img-fluid rounded-circle w-100" alt="">
                            </div>
                            <div class="col-6">
                                <a href="#" class="h5">Organic Tomato</a>
                                <div class="d-flex my-3">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4 class="mb-3">3.12 $</h4>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-light">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <img src="{{ asset('frontend/img/best-product-5.jpg') }}"
                                    class="img-fluid rounded-circle w-100" alt="">
                            </div>
                            <div class="col-6">
                                <a href="#" class="h5">Organic Tomato</a>
                                <div class="d-flex my-3">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4 class="mb-3">3.12 $</h4>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4">
                    <div class="p-4 rounded bg-light">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <img src="{{ asset('frontend/img/best-product-6.jpg') }}"
                                    class="img-fluid rounded-circle w-100" alt="">
                            </div>
                            <div class="col-6">
                                <a href="#" class="h5">Organic Tomato</a>
                                <div class="d-flex my-3">
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star text-primary"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <h4 class="mb-3">3.12 $</h4>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="text-center">
                        <img src="{{ asset('frontend/img/fruite-item-1.jpg') }}" class="img-fluid rounded"
                            alt="">
                        <div class="py-4">
                            <a href="#" class="h5">Organic Tomato</a>
                            <div class="d-flex my-3 justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="mb-3">3.12 $</h4>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                    class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="text-center">
                        <img src="{{ asset('frontend/img/fruite-item-2.jpg') }}" class="img-fluid rounded"
                            alt="">
                        <div class="py-4">
                            <a href="#" class="h5">Organic Tomato</a>
                            <div class="d-flex my-3 justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="mb-3">3.12 $</h4>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                    class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="text-center">
                        <img src="{{ asset('frontend/img/fruite-item-4.jpg') }}" class="img-fluid rounded"
                            alt="">
                        <div class="py-4">
                            <a href="#" class="h5">Organic Tomato</a>
                            <div class="d-flex my-3 justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="mb-3">3.12 $</h4>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                    class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="text-center">
                        <img src="{{ asset('frontend/img/fruite-item-4.jpg') }}" class="img-fluid rounded"
                            alt="">
                        <div class="py-2">
                            <a href="#" class="h5">Organic Tomato</a>
                            <div class="d-flex my-3 justify-content-center">
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star text-primary"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4 class="mb-3">3.12 $</h4>
                            <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i
                                    class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bestsaler Product End -->


    <!-- Fact Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="bg-light p-5 rounded">
                <div class="row g-4 justify-content-center">
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users text-secondary"></i>
                            <h4>satisfied customers</h4>
                            <h1>1963</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users text-secondary"></i>
                            <h4>quality of service</h4>
                            <h1>99%</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users text-secondary"></i>
                            <h4>quality certificates</h4>
                            <h1>33</h1>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-3">
                        <div class="counter bg-white rounded p-5">
                            <i class="fa fa-users text-secondary"></i>
                            <h4>Available Products</h4>
                            <h1>789</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fact Start -->
@endsection
