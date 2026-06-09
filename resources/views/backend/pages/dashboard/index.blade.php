@extends('layouts.backend.app')
@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h2 class="mb-2 fw-bold">Admin Dashboard</h2>
            <p class="text-secondary mb-0">
                Quick overview of products, orders, customers and revenue.
            </p>
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('categories.index') }}" class="btn btn-outline-primary">
                <i class="fa fa-tags me-1"></i> Categories
            </a>
            <a href="{{ route('products.index') }}" class="btn btn-primary">
                <i class="fa fa-box me-1"></i> Products
            </a>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-sm-6 col-xl-3">
            <div class="card dashboard-stat-card h-100 shadow-sm border-0">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon-box bg-primary text-white">
                        <i class="fa fa-list"></i>
                    </div>
                    <div>
                        <small class="text-muted">Categories</small>
                        <h3 class="mb-0">{{ $categories }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card dashboard-stat-card h-100 shadow-sm border-0">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon-box bg-success text-white">
                        <i class="fa fa-box"></i>
                    </div>
                    <div>
                        <small class="text-muted">Products</small>
                        <h3 class="mb-0">{{ $products }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card dashboard-stat-card h-100 shadow-sm border-0">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon-box bg-warning text-dark">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <div>
                        <small class="text-muted">Orders</small>
                        <h3 class="mb-0">{{ $orders }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card dashboard-stat-card h-100 shadow-sm border-0">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon-box bg-info text-white">
                        <i class="fa fa-indian-rupee-sign"></i>
                    </div>
                    <div>
                        <small class="text-muted">Revenue</small>
                        <h3 class="mb-0">₹{{ number_format($totalRevenue, 2) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card dashboard-stat-card h-100 shadow-sm border-0">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon-box bg-danger text-white">
                        <i class="fa fa-users"></i>
                    </div>
                    <div>
                        <small class="text-muted">Customers</small>
                        <h3 class="mb-0">{{ $customers }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card dashboard-stat-card h-100 shadow-sm border-0">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="icon-box bg-secondary text-white">
                        <i class="fa fa-heart"></i>
                    </div>
                    <div>
                        <small class="text-muted">Wishlists</small>
                        <h3 class="mb-0">{{ $wishlists }}</h3>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row g-4 mt-4">

        <div class="col-lg-8">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">Performance Summary</h5>
                        <small class="text-muted">Store activity and order performance.</small>
                    </div>
                    <span class="badge bg-warning text-dark">
                        Pending Orders: {{ $pendingOrders }}
                    </span>
                </div>

                <div class="card-body">
                    <div class="row g-3">

                        <div class="col-sm-6">
                            <div class="bg-light rounded-3 p-3">
                                <small class="text-muted">Total Users</small>
                                <h4 class="mt-2 mb-0">{{ $users }}</h4>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="bg-light rounded-3 p-3">
                                <small class="text-muted">Average Order Value</small>
                                <h4 class="mt-2 mb-0">
                                    @if ($orders > 0)
                                        ₹{{ number_format($totalRevenue / $orders, 2) }}
                                    @else
                                        ₹0.00
                                    @endif
                                </h4>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="bg-light rounded-3 p-3">
                                <small class="text-muted">Recent Products</small>
                                <h4 class="mt-2 mb-0">{{ $recentProducts->count() }}</h4>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="bg-light rounded-3 p-3">
                                <small class="text-muted">Recent Categories</small>
                                <h4 class="mt-2 mb-0">{{ $recentCategories->count() }}</h4>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>

                <div class="list-group list-group-flush">
                    <a href="{{ route('categories.index') }}" class="list-group-item list-group-item-action">
                        <i class="fa fa-tags me-2"></i> Manage Categories
                    </a>

                    <a href="{{ route('products.index') }}" class="list-group-item list-group-item-action">
                        <i class="fa fa-box me-2"></i> Manage Products
                    </a>

                    <a href="{{ route('orders.index') }}" class="list-group-item list-group-item-action">
                        <i class="fa fa-shopping-cart me-2"></i> Manage Orders
                    </a>

                    <a href="{{ route('index') }}" class="list-group-item list-group-item-action">
                        <i class="fa fa-globe me-2"></i> Visit Storefront
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="list-group-item list-group-item-action text-danger w-100 text-start">
                            <i class="fa fa-sign-out-alt me-2"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    <div class="row g-4 mt-4">

        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Recent Categories</h5>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th class="text-end">Created</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($recentCategories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td class="text-end text-muted">
                                        {{ $category->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-muted">
                                        No categories created yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Recent Products</h5>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th class="text-end">Category</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($recentProducts as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td class="text-end">
                                        <span class="badge bg-secondary">
                                            {{ $product->category?->name ?? 'Unassigned' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-muted">
                                        No products available yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

    <div class="row g-4 mt-4">

        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Recent Orders</h5>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th class="text-end">Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($recentOrders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->name }}</td>
                                    <td>₹{{ number_format($order->total, 2) }}</td>
                                    <td class="text-end">
                                        <span class="badge bg-{{ $order->status == 'pending' ? 'warning text-dark' : ($order->status == 'completed' ? 'success' : 'secondary') }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-muted">
                                        No orders available yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Recent Customers</h5>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th class="text-end">Joined</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($recentCustomers as $customer)
                                <tr>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td class="text-end text-muted">
                                        {{ $customer->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-muted">
                                        No customers available yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

    <div class="row g-4 mt-4">

        <div class="col-lg-12">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Recent Wishlists</h5>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Added</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($recentWishlists as $wishlist)
                                <tr>
                                    <td>{{ $wishlist->user->name }}</td>
                                    <td>{{ $wishlist->product->name }}</td>
                                    <td class="text-muted">
                                        {{ $wishlist->created_at->diffForHumans() }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-muted">
                                        No wishlists available yet.
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