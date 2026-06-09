@extends('layouts.frontend.app')

@section('content')
<div class="container py-5" style="margin-top:120px;">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">My Orders</h2>
            <p class="text-muted mb-0">Track your orders and payment details</p>
        </div>

        <a href="{{ route('shop') }}" class="btn btn-primary rounded-pill px-4">
            Continue Shopping
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success rounded-4 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4 mb-4">

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                        style="width:55px;height:55px;">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div>
                        <small class="text-muted">Total Orders</small>
                        <h4 class="fw-bold mb-0">{{ $orders->count() }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-warning text-dark rounded-circle d-flex align-items-center justify-content-center"
                        style="width:55px;height:55px;">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <small class="text-muted">Pending</small>
                        <h4 class="fw-bold mb-0">
                            {{ $orders->filter(fn($order) => strtolower($order->status ?? '') === 'pending')->count() }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-info text-white rounded-circle d-flex align-items-center justify-content-center"
                        style="width:55px;height:55px;">
                        <i class="fas fa-truck"></i>
                    </div>
                    <div>
                        <small class="text-muted">Shipped</small>
                        <h4 class="fw-bold mb-0">
                            {{ $orders->filter(fn($order) => strtolower($order->status ?? '') === 'shipped')->count() }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center"
                        style="width:55px;height:55px;">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div>
                        <small class="text-muted">Delivered</small>
                        <h4 class="fw-bold mb-0">
                            {{ $orders->filter(fn($order) => strtolower($order->status ?? '') === 'delivered')->count() }}
                        </h4>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-header bg-white border-0 p-4">
            <h4 class="fw-bold mb-1">Order History</h4>
            <p class="text-muted mb-0">View your recent purchases and order status</p>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Order</th>
                            <th>Customer</th>
                            <th>Phone</th>
                            <th>Total</th>
                            <th>Payment</th>
                            <th>Order Status</th>
                            <th>Payment Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($orders as $order)
                            @php
                                $orderStatus = strtolower($order->status ?? 'pending');
                                $paymentStatus = strtolower($order->payment_status ?? 'pending');

                                $statusClasses = [
                                    'pending' => 'bg-warning text-dark',
                                    'processing' => 'bg-info text-white',
                                    'shipped' => 'bg-primary text-white',
                                    'delivered' => 'bg-success text-white',
                                    'cancelled' => 'bg-danger text-white',
                                ];

                                $paymentClasses = [
                                    'pending' => 'bg-warning text-dark',
                                    'paid' => 'bg-success text-white',
                                    'failed' => 'bg-danger text-white',
                                    'unpaid' => 'bg-secondary text-white',
                                ];
                            @endphp

                            <tr>
                                <td class="ps-4 fw-bold">#{{ $order->id }}</td>
                                <td>{{ $order->user->name ?? Auth::user()->name }}</td>
                                <td>{{ $order->address->phone ?? $order->phone ?? 'N/A' }}</td>
                                <td class="fw-bold text-success">
                                    ₹{{ number_format($order->total_amount ?? $order->total ?? 0, 2) }}
                                </td>
                                <td>{{ strtoupper($order->payment_method ?? 'COD') }}</td>

                                <td>
                                    <span class="badge rounded-pill {{ $statusClasses[$orderStatus] ?? 'bg-secondary text-white' }}">
                                        {{ ucfirst($orderStatus) }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge rounded-pill {{ $paymentClasses[$paymentStatus] ?? 'bg-secondary text-white' }}">
                                        {{ ucfirst($paymentStatus) }}
                                    </span>
                                </td>

                                <td>{{ $order->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                    <h5 class="fw-bold">No orders found</h5>
                                    <p class="text-muted">You have not placed any orders yet.</p>

                                    <a href="{{ route('shop') }}" class="btn btn-primary rounded-pill px-4">
                                        Start Shopping
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>
    </div>

</div>
@endsection