@extends('layouts.frontend.app')

@section('content')
    <div class="cart-wrapper">
        <div class="container">

            <div class="cart-header d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <h2 class="fw-bold mb-2">
                        <i class="fa fa-shopping-cart me-2"></i> My Cart
                    </h2>
                    <p class="mb-0">Review your products before checkout</p>
                </div>

                <a href="{{ route('shop') }}" class="btn btn-light rounded-pill px-4 py-2 fw-bold">
                    <i class="fa fa-store me-2"></i> Continue Shopping
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            @if ($carts->count() > 0)
                @php
                    $total = 0;
                @endphp

                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="cart-card">
                            <div class="table-responsive">
                                <table class="table cart-table mb-0">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Total</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($carts as $cart)
                                            @php
                                                $product = $cart->product;
                                                $stock = $product->stock ?? 0;
                                                $subtotal = $product->sale_price * $cart->quantity;
                                                $total += $subtotal;
                                            @endphp

                                            <tr>
                                                <td>
                                                    <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                                        class="cart-img" alt="{{ $product->name }}">
                                                </td>

                                                <td>
                                                    <div class="product-name">{{ $product->name }}</div>
                                                    <small class="text-muted">
                                                        {{ $product->category->name ?? 'Product' }}
                                                    </small>

                                                    @if ($stock <= 0)
                                                        <div class="text-danger small fw-bold mt-1">
                                                            Out of Stock
                                                        </div>
                                                    @elseif($cart->quantity >= $stock)
                                                        <div class="text-danger small fw-bold mt-1">
                                                            Out of Stock
                                                        </div>
                                                    @else
                                                        <div class="text-success small fw-bold mt-1">
                                                            In Stock
                                                        </div>
                                                    @endif
                                                </td>

                                                <td>
                                                    <span class="price-text">
                                                        ₹{{ number_format($product->sale_price, 2) }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <div class="qty-box">
                                                        <form action="{{ route('cart.decrease', $cart->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" class="qty-btn">-</button>
                                                        </form>

                                                        <span class="qty-number">{{ $cart->quantity }}</span>

                                                        @if ($cart->quantity >= $stock)
                                                            <button type="button" class="qty-btn" disabled
                                                                style="opacity:.5; cursor:not-allowed;">
                                                                +
                                                            </button>
                                                        @else
                                                            <form action="{{ route('cart.increase', $cart->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <button type="submit" class="qty-btn">+</button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                </td>

                                                <td>
                                                    <span class="price-text">
                                                        ₹{{ number_format($subtotal, 2) }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <form action="{{ route('cart.delete', $cart->id) }}" method="POST"
                                                        onsubmit="return confirm('Remove this product from cart?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="remove-btn">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    @php
                        $shipping = 50;
                        $grandTotal = $total + $shipping;
                    @endphp

                    <div class="col-lg-4">
                        <div class="summary-card">
                            <h3 class="fw-bold mb-4">Order Summary</h3>

                            <div class="summary-row">
                                <span>Subtotal</span>
                                <strong>₹{{ number_format($total, 2) }}</strong>
                            </div>

                            <div class="summary-row">
                                <span>Shipping</span>
                                <strong>₹{{ number_format($shipping, 2) }}</strong>
                            </div>

                            <div class="summary-row">
                                <span>Discount</span>
                                <strong>₹0.00</strong>
                            </div>

                            <div class="summary-row summary-total">
                                <span>Total</span>
                                <span>₹{{ number_format($grandTotal, 2) }}</span>
                            </div>

                            <a href="{{ route('checkout') }}" class="btn checkout-btn mt-4">
                                Proceed To Checkout
                            </a>

                            <p class="text-muted text-center mt-3 mb-0">
                                Secure checkout guaranteed
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="empty-cart">
                    <i class="fa fa-shopping-cart"></i>
                    <h3 class="fw-bold">Your cart is empty</h3>
                    <p class="text-muted">Add products to your cart and come back here.</p>

                    <a href="{{ route('shop') }}" class="btn btn-success px-5 py-3 rounded-pill fw-bold">
                        Go To Shop
                    </a>
                </div>
            @endif

        </div>
    </div>
@endsection
