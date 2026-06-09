@extends('layouts.frontend.app')

@section('content')
    <div class="container py-5" style="margin-top:120px;">
        <div class="row justify-content-center">
            <div class="col-lg-10">

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="card shadow-sm border-0">
                    <div class="row g-0">

                        <div class="col-md-6">
                            <img src="{{ asset('storage/' . $product->thumbnail) }}"
                                class="img-fluid rounded-start w-100 h-100" alt="{{ $product->name }}"
                                style="object-fit: cover;">
                        </div>

                        <div class="col-md-6">
                            <div class="card-body">

                                <h2 class="card-title">{{ $product->name }}</h2>

                                <p class="mb-2">
                                    Category:
                                    <span class="badge bg-success">
                                        {{ $product->category->name ?? 'Uncategorized' }}
                                    </span>
                                </p>

                                <div class="mb-3">
                                    <span class="h3 text-primary">
                                        ₹{{ number_format($product->sale_price, 2) }}
                                    </span>

                                    @if ($product->original_price)
                                        <del class="text-danger ms-3">
                                            ₹{{ number_format($product->original_price, 2) }}
                                        </del>
                                    @endif
                                </div>

                                <p class="card-text text-muted">
                                    {{ $product->description }}
                                </p>
                                <div class="row gy-2 mb-4">
                                    <div class="col-6">
                                        <div class="small text-uppercase text-secondary">Weight</div>
                                        <div>{{ $product->weight ?? 'N/A' }}</div>
                                    </div>
                                    <div class="col-6">
                                        <div class="small text-uppercase text-secondary">Color</div>
                                        <div>{{ $product->color ?? 'N/A' }}</div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    @if ($product->stock == 0)
                                        <span class="badge bg-danger">
                                            Out Of Stock
                                        </span>
                                    @elseif($product->stock <= 5)
                                        <span class="badge bg-warning text-dark">
                                            Last Few Left
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            In Stock
                                        </span>
                                    @endif
                                </div>

                                @if ($product->stock > 0)
                                    <div class="row g-2 align-items-center mb-4">
                                        <div class="col-auto">
                                            <label class="form-label mb-1">Quantity</label>

                                            <div class="input-group" style="width: 160px;">
                                                <button type="button" class="btn btn-outline-secondary" id="qty-decrease">
                                                    -
                                                </button>

                                                <input type="number" id="quantity" class="form-control text-center"
                                                    value="1" min="1" max="{{ $product->stock }}">

                                                <button type="button" class="btn btn-outline-secondary" id="qty-increase">
                                                    +
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <div class="d-flex flex-column flex-sm-row gap-2">

                                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                                        @csrf

                                        <input type="hidden" name="quantity" id="quantity-input" value="1">

                                        @if ($product->stock > 0)
                                            <button type="submit" class="btn btn-primary px-4">
                                                <i class="fa fa-shopping-bag me-2"></i>
                                                Add to Cart
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-danger px-4" disabled>
                                                Out Of Stock
                                            </button>
                                        @endif
                                    </form>

                                    <form action="{{ route('wishlist.add', $product->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf

                                        <button type="submit" class="btn btn-outline-secondary px-4">
                                            <i class="fa-solid fa-heart me-2"></i>
                                            Add to Wishlist
                                        </button>
                                    </form>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const qtyInput = document.getElementById('quantity');
            const qtyHidden = document.getElementById('quantity-input');
            const increase = document.getElementById('qty-increase');
            const decrease = document.getElementById('qty-decrease');
            const stockMessage = document.getElementById('stock-message');

            if (!qtyInput || !qtyHidden || !increase || !decrease) return;

            const maxStock = parseInt(qtyInput.getAttribute('max'), 10);

            function syncQty() {
                let value = parseInt(qtyInput.value, 10);

                if (isNaN(value) || value < 1) {
                    value = 1;
                }

                if (value > maxStock) {
                    value = maxStock;
                }

                qtyInput.value = value;
                qtyHidden.value = value;

                if (value >= maxStock) {
                    increase.disabled = true;
                    increase.style.opacity = '0.5';
                    increase.style.cursor = 'not-allowed';

                    if (stockMessage) {
                        stockMessage.className = 'text-danger fw-bold';
                        stockMessage.innerText = 'Out Of Stock';
                    }

                } else {

                    increase.disabled = false;
                    increase.style.opacity = '1';
                    increase.style.cursor = 'pointer';

                    if (stockMessage) {
                        stockMessage.className = 'text-success';
                        stockMessage.innerText = 'In Stock';
                    }
                }

                if (value <= 1) {
                    decrease.disabled = true;
                    decrease.style.opacity = '0.5';
                } else {
                    decrease.disabled = false;
                    decrease.style.opacity = '1';
                }
            }

            increase.addEventListener('click', function() {
                qtyInput.value = parseInt(qtyInput.value, 10) + 1;
                syncQty();
            });

            decrease.addEventListener('click', function() {
                qtyInput.value = parseInt(qtyInput.value, 10) - 1;
                syncQty();
            });

            qtyInput.addEventListener('input', syncQty);
            qtyInput.addEventListener('change', syncQty);

            syncQty();
        });
    </script>
@endsection
