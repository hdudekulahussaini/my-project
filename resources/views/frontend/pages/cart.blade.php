@extends('layouts.frontend.app')
@section('content')
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Cart</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">Cart</li>
        </ol>
    </div>
    <!-- Single Page Header End -->
    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach ($carts as $cart)
                            @php
                                $subtotal = $cart->product->sale_price * $cart->quantity;
                                $total += $subtotal;
                            @endphp
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $cart->product->thumbnail) }}" width="80">
                                </td>
                                <td>
                                    {{ $cart->product->name }}
                                </td>
                                <td>
                                    ₹{{ $cart->product->sale_price }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <form action="{{ route('cart.decrease', $cart->id) }}" method="POST"
                                            class="m-0">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">-</button>
                                        </form>

                                        <span class="px-2">{{ $cart->quantity }}</span>

                                        <form action="{{ route('cart.increase', $cart->id) }}" method="POST"
                                            class="m-0">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">+</button>
                                        </form>
                                    </div>
                                </td>
                                <td>
                                    ₹{{ $subtotal }}
                                </td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <form action="{{ route('cart.move.to.wishlist', $cart->id) }}" method="POST"
                                            class="m-0">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-warning">Wishlist</button>
                                        </form>
                                        <form action="{{ route('cart.delete', $cart->id) }}" method="POST" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">X</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-5">
                <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Coupon Code">
                <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply
                    Coupon</button>
            </div>
            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0">₹{{ number_format($total, 2) }}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Shipping</h5>
                                <div class="">
                                    <p class="mb-0"> ₹{{ number_format($total + 50, 2) }}</p>
                                </div>
                            </div>
                            <p class="mb-0 text-end">Shipping to Ukraine.</p>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4">₹{{ number_format($total + 50, 2) }}</p>
                        </div>
                        <a href="{{ route('checkout') }}"
                            class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4">
                            Proceed Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->
@endsection
