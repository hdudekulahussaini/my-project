@extends('layouts.frontend.app')

@section('content')
    <div class="container-fluid page-header py-5">

        <h1 class="text-center text-white display-6">

            My Orders

        </h1>

        <ol class="breadcrumb justify-content-center mb-0">

            <li class="breadcrumb-item">

                <a href="{{ route('index') }}">

                    Home

                </a>

            </li>

            <li class="breadcrumb-item active text-white">

                Orders

            </li>

        </ol>

    </div>


    <div class="container py-5">

        @if (session('success'))
            <div class="alert alert-success rounded-3 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="row g-4 mb-4">
            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-3 bg-primary text-white rounded-circle p-3">
                                <i class="fas fa-shopping-bag fa-lg"></i>
                            </div>
                            <div>
                                <small class="text-uppercase text-muted">Total orders</small>
                                <h4 class="mb-0">{{ $orders->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-3 bg-warning text-dark rounded-circle p-3">
                                <i class="fas fa-clock fa-lg"></i>
                            </div>
                            <div>
                                <small class="text-uppercase text-muted">Pending</small>
                                <h4 class="mb-0">{{ $orders->where('status', 'pending')->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-3 bg-info text-white rounded-circle p-3">
                                <i class="fas fa-truck fa-lg"></i>
                            </div>
                            <div>
                                <small class="text-uppercase text-muted">Shipping</small>
                                <h4 class="mb-0">{{ $orders->where('status', 'shipped')->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="me-3 bg-success text-white rounded-circle p-3">
                                <i class="fas fa-check-circle fa-lg"></i>
                            </div>
                            <div>
                                <small class="text-uppercase text-muted">Delivered</small>
                                <h4 class="mb-0">{{ $orders->where('status', 'delivered')->count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-bottom-0 py-4">
                <div class="d-flex justify-content-between align-items-center flex-column flex-md-row gap-3">
                    <div>
                        <h4 class="mb-1">Order history</h4>
                        <p class="mb-0 text-muted">Review all your placed orders with status updates and order totals.</p>
                    </div>
                    <span class="badge bg-primary py-2 px-3">Latest update: {{ now()->format('d M Y') }}</span>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Phone</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr class="border-top">
                                    <td class="fw-semibold">#{{ $order->id }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->phone }}</td>
                                    <td class="text-success">₹{{ number_format($order->total, 2) }}</td>
                                    <td>
                                        @php
                                            $statusClasses = [
                                                'pending' => 'bg-warning text-dark',
                                                'processing' => 'bg-info text-white',
                                                'shipped' => 'bg-primary text-white',
                                                'delivered' => 'bg-success text-white',
                                            ];
                                        @endphp
                                        <span
                                            class="badge {{ $statusClasses[$order->status] ?? 'bg-secondary text-white' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-box-open fa-2x mb-3"></i>
                                            <p class="mb-1">No orders found yet.</p>
                                            <p class="small">Browse the shop and place your first order today.</p>
                                        </div>
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
