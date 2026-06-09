@extends('layouts.frontend.app')

@section('content')
    <div class="checkout-wrapper">
        <div class="container">

            <div class="checkout-header">
                <h2 class="fw-bold mb-2">
                    <i class="fa fa-credit-card me-2"></i>
                    Checkout
                </h2>
                <p class="mb-0">Complete your order safely and quickly</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger rounded-4 shadow-sm">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Checkout Form -->
            <form id="checkoutForm" action="{{ route('order.store') }}" method="POST">
                @csrf

                <div class="row">
                    <!-- Left Side -->
                    <div class="col-lg-7">
                        <!-- Delivery Address -->
                        <div class="card mb-4 shadow-sm border-0 rounded-4">
                            <div class="card-header bg-white border-0 rounded-top-4 p-4">
                                <h5 class="mb-0 fw-bold">
                                    <i class="fa fa-map-marker-alt me-2 text-primary"></i>
                                    Delivery Address
                                </h5>
                            </div>

                            <div class="card-body p-4">

                                @forelse($addresses as $address)
                                    <label class="address-card border rounded-4 p-3 mb-3 d-block position-relative">
                                        <div class="d-flex gap-3">

                                            <input class="form-check-input mt-1" type="radio" name="address_id"
                                                value="{{ $address->id }}" {{ $loop->first ? 'checked' : '' }} required>

                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <div>
                                                        <h6 class="fw-bold mb-1">
                                                            {{ $address->name }}
                                                        </h6>

                                                        <p class="mb-1 text-muted small">
                                                            {{ $address->address }},
                                                            {{ $address->city }},
                                                            {{ $address->state }},
                                                            {{ $address->country }} -
                                                            {{ $address->pincode }}
                                                        </p>

                                                        <p class="mb-0 small">
                                                            <strong>Phone:</strong> {{ $address->phone }}
                                                            <br>
                                                            <strong>Email:</strong> {{ $address->email }}
                                                        </p>
                                                    </div>

                                                    <div class="d-flex gap-2">
                                                        <a href="{{ route('address.edit', $address->id) }}"
                                                            class="btn btn-outline-primary btn-sm">
                                                            Edit
                                                        </a>

                                                        <button type="submit" form="delete-address-{{ $address->id }}"
                                                            class="btn btn-outline-danger btn-sm"
                                                            onclick="return confirm('Delete this address?')">
                                                            Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                @empty
                                    <div class="alert alert-warning rounded-4">
                                        No address found. Please add delivery address.
                                    </div>
                                @endforelse

                                <a href="{{ route('address.create') }}" class="btn btn-primary rounded-pill px-4">
                                    <i class="fa fa-plus me-2"></i>
                                    Add New Address
                                </a>
                            </div>
                        </div>

                    </div>

                    <!-- Right Side -->
                    <div class="col-lg-5">
                        <div class="order-card">
                            <h3 class="section-title">
                                <i class="fa fa-shopping-bag me-2 text-success"></i>
                                Order Summary
                            </h3>

                            @php
                                $total = 0;
                                $shipping = 50;
                            @endphp

                            @foreach ($carts as $cart)
                                @php
                                    $subtotal = $cart->product->sale_price * $cart->quantity;
                                    $total += $subtotal;
                                @endphp

                                <div class="order-item d-flex align-items-center mb-3">
                                    <img src="{{ asset('storage/' . $cart->product->thumbnail) }}" class="order-img me-3"
                                        alt="{{ $cart->product->name }}">

                                    <div class="flex-grow-1">
                                        <div class="order-name">
                                            {{ $cart->product->name }}
                                        </div>
                                        <small class="text-muted">
                                            Qty: {{ $cart->quantity }}
                                        </small>
                                    </div>

                                    <div class="order-price">
                                        ₹{{ number_format($subtotal, 2) }}
                                    </div>
                                </div>
                            @endforeach

                            @php
                                $grandTotal = $total + $shipping;
                            @endphp

                            <input type="hidden" name="amount" id="amount" value="{{ $grandTotal }}">

                            <div class="mt-4">
                                <div class="summary-row d-flex justify-content-between mb-2">
                                    <span>Subtotal</span>
                                    <strong>₹{{ number_format($total, 2) }}</strong>
                                </div>

                                <div class="summary-row d-flex justify-content-between mb-2">
                                    <span>Shipping</span>
                                    <strong>₹{{ number_format($shipping, 2) }}</strong>
                                </div>

                                <div class="summary-row summary-total d-flex justify-content-between">
                                    <span>Total</span>
                                    <strong>₹{{ number_format($grandTotal, 2) }}</strong>
                                </div>
                            </div>

                            <h5 class="fw-bold mt-4 mb-3">
                                Payment Method
                            </h5>

                            <div class="payment-box mb-2">
                                <input type="radio" name="payment_method" value="cod" id="cod" checked>
                                <label for="cod" class="ms-2">
                                    Cash On Delivery
                                </label>
                            </div>

                            <div class="payment-box mb-2">
                                <input type="radio" name="payment_method" value="razorpay" id="razorpay">
                                <label for="razorpay" class="ms-2">
                                    Razorpay (UPI / Card / Net Banking)
                                </label>
                            </div>

                            <div class="payment-box mb-2">
                                <input type="radio" name="payment_method" value="bank" id="bank">
                                <label for="bank" class="ms-2">
                                    Direct Bank Transfer
                                </label>
                            </div>

                            <div class="payment-box mb-3">
                                <input type="radio" name="payment_method" value="paypal" id="paypal">
                                <label for="paypal" class="ms-2">
                                    PayPal
                                </label>
                            </div>

                            <button type="button" class="place-order-btn mt-3">
                                Place Order
                            </button>

                            <a href="{{ route('orders') }}" class="orders-link d-block mt-3">
                                View My Orders
                            </a>
                        </div>
                    </div>

                </div>
            </form>

            <!-- Delete Address Forms - Outside Checkout Form -->
            @foreach ($addresses as $address)
                <form id="delete-address-{{ $address->id }}" action="{{ route('address.destroy', $address->id) }}"
                    method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach

        </div>
    </div>

    <!-- Address Modal -->
    <div class="modal fade" id="addressModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <form action="{{ route('address.store') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">Add Address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <input type="text" name="name" class="form-control mb-2" placeholder="Full Name" required>

                        <input type="text" name="phone" class="form-control mb-2" placeholder="Phone" required>

                        <textarea name="address" class="form-control mb-2" placeholder="Address" required></textarea>

                        <input type="text" name="city" class="form-control mb-2" placeholder="City" required>

                        <input type="text" name="state" class="form-control mb-2" placeholder="State" required>

                        <input type="text" name="country" class="form-control mb-2" placeholder="Country" required>

                        <input type="text" name="pincode" class="form-control mb-2" placeholder="Pincode" required>

                        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">
                            Save Address
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('.place-order-btn').addEventListener('click', function(e) {
            e.preventDefault();

            let selectedPayment = document.querySelector('input[name="payment_method"]:checked');

            if (!selectedPayment) {
                alert('Please select payment method');
                return;
            }

            let paymentMethod = selectedPayment.value;
            let form = document.querySelector('#checkoutForm');

            if (paymentMethod === 'cod') {
                form.submit();
                return;
            }

            if (paymentMethod === 'razorpay') {

                let amount = Number(document.getElementById('amount').value);

                if (!amount || amount <= 0) {
                    alert('Invalid amount');
                    return;
                }

                let options = {
                    key: "{{ config('services.razorpay.key') }}",
                    amount: amount * 100,
                    currency: "INR",
                    name: "Your Store Name",
                    description: "Order Payment",

                    handler: function(response) {
                        let input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'razorpay_payment_id';
                        input.value = response.razorpay_payment_id;
                        form.appendChild(input);

                        form.submit();
                    },

                    modal: {
                        ondismiss: function() {
                            alert('Payment popup closed');
                        }
                    },

                    theme: {
                        color: "#0d6efd"
                    }
                };

                let rzp = new Razorpay(options);

                rzp.on('payment.failed', function(response) {
                    alert(
                        'Payment Failed\n' +
                        response.error.description
                    );
                });

                rzp.open();
            }
        });
    </script>
@endsection
