@extends('layouts.backend.app')
@section('content')
<div class="order-page">
<div class="container-fluid py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Order Details</h2>
            <p class="text-muted mb-0">View complete order information</p>
        </div>

        <a href="{{ route('orders.index') }}" class="btn btn-dark rounded-pill px-4">
            <i class="fa fa-arrow-left me-1"></i> Back
        </a>
    </div>

    <div class="card order-card">

        <div class="order-header d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-1">Order #{{ $order->id }}</h4>
                <small>Transaction: {{ $order->transaction_id ?? 'N/A' }}</small>
            </div>

            <div class="text-end">
                <span class="badge bg-light text-dark px-3 py-2">
                    {{ ucfirst($order->status ?? 'Pending') }}
                </span>
                <h4 class="mt-2 mb-0">
                    ₹{{ number_format($order->total ?? 0, 2) }}
                </h4>
            </div>
        </div>

        <div class="card-body p-4">

            <div class="row g-4">

                <div class="col-lg-6">
                    <div class="info-box">
                        <h5 class="info-title">
                            <i class="fa fa-user me-2 text-primary"></i>
                            Customer Information
                        </h5>

                        <div class="info-row">
                            <span class="info-label">Name</span>
                            <span class="info-value">{{ $order->user->name ?? $order->name ?? 'Guest' }}</span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Email</span>
                            <span class="info-value">{{ $order->user->email ?? $order->email ?? 'N/A' }}</span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Phone</span>
                            <span class="info-value">{{ $order->phone ?? 'N/A' }}</span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Order ID</span>
                            <span class="info-value">#{{ $order->id }}</span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="info-box">
                        <h5 class="info-title">
                            <i class="fa fa-credit-card me-2 text-success"></i>
                            Payment Information
                        </h5>

                        <div class="info-row">
                            <span class="info-label">Payment Method</span>
                            <span class="info-value">{{ ucfirst($order->payment_method ?? 'N/A') }}</span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Payment Status</span>
                            <span class="info-value">
                                <span class="badge bg-success">
                                    {{ ucfirst($order->payment_status ?? 'Pending') }}
                                </span>
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Transaction ID</span>
                            <span class="info-value">{{ $order->transaction_id ?? 'N/A' }}</span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Total Amount</span>
                            <span class="info-value text-success">
                                ₹{{ number_format($order->total ?? 0, 2) }}
                            </span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="row g-4 mt-1">

                <div class="col-lg-12">
                    <div class="info-box">
                        <h5 class="info-title">
                            <i class="fa fa-map-marker-alt me-2 text-danger"></i>
                            Shipping Address
                        </h5>

                        <div class="info-row">
                            <span class="info-label">Name</span>
                            <span class="info-value">{{ $order->name ?? $order->user->name ?? 'N/A' }}</span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Email</span>
                            <span class="info-value">{{ $order->email ?? $order->user->email ?? 'N/A' }}</span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Phone</span>
                            <span class="info-value">{{ $order->phone ?? 'N/A' }}</span>
                        </div>

                        <div class="info-row">
                            <span class="info-label">Address</span>
                            <span class="info-value">{{ $order->address ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

            </div>

            <div class="info-box mt-4">
                <h5 class="info-title">
                    <i class="fa fa-box me-2 text-warning"></i>
                    Order Items
                </h5>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th width="120">Quantity</th>
                                <th width="150">Price</th>
                                <th width="150">Subtotal</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($order->items as $item)
                                <tr>
                                    <td>
                                        <strong>{{ $item->product->name ?? 'Product Deleted' }}</strong>
                                    </td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>₹{{ number_format($item->price ?? 0, 2) }}</td>
                                    <td>
                                        <strong>
                                            ₹{{ number_format(($item->price ?? 0) * ($item->quantity ?? 1), 2) }}
                                        </strong>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted py-4">
                                        No items found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="total-box mt-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Grand Total</h5>
                    <h3 class="mb-0 text-success">
                        ₹{{ number_format($order->total ?? 0, 2) }}
                    </h3>
                </div>
            </div>

        </div>
    </div>

</div>
</div>
@endsection