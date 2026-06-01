@extends('layouts.backend.app')

@section('content')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h2 class="mb-2">Admin Dashboard</h2>
            <p class="text-secondary mb-0">Quick overview of catalog growth, orders and revenue performance.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('categories.index') }}" class="btn btn-outline-primary">Categories</a>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Products</a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card dashboard-stat-card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-start gap-3">
                        <div class="icon-box bg-primary text-white shadow-sm">
                            <i class="fa fa-list"></i>
                        </div>
                        <div>
                            <small class="text-uppercase text-muted">Categories</small>
                            <h3 class="mt-2 mb-0">{{ $categories }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card dashboard-stat-card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-start gap-3">
                        <div class="icon-box bg-success text-white shadow-sm">
                            <i class="fa fa-box"></i>
                        </div>
                        <div>
                            <small class="text-uppercase text-muted">Products</small>
                            <h3 class="mt-2 mb-0">{{ $products }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card dashboard-stat-card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-start gap-3">
                        <div class="icon-box bg-warning text-dark shadow-sm">
                            <i class="fa fa-shopping-cart"></i>
                        </div>
                        <div>
                            <small class="text-uppercase text-muted">Orders</small>
                            <h3 class="mt-2 mb-0">{{ $orders }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-xl-3">
            <div class="card dashboard-stat-card h-100">
                <div class="card-body">
                    <div class="d-flex align-items-start gap-3">
                        <div class="icon-box bg-info text-white shadow-sm">
                            <i class="fa fa-dollar-sign"></i>
                        </div>
                        <div>
                            <small class="text-uppercase text-muted">Revenue</small>
                            <h3 class="mt-2 mb-0">${{ number_format($totalRevenue, 2) }}</h3>
                        </div>
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
                        <h5 class="mb-0">Performance summary</h5>
                        <small class="text-muted">Recent store metrics and pending action items.</small>
                    </div>
                    <span class="badge bg-warning text-dark py-2 px-3">Pending orders: {{ $pendingOrders }}</span>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="rounded-3 p-3 bg-light">
                                <small class="text-uppercase text-muted">Total users</small>
                                <h4 class="mb-0 mt-2">{{ $users }}</h4>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="rounded-3 p-3 bg-light">
                                <small class="text-uppercase text-muted">Average order value</small>
                                <h4 class="mb-0 mt-2">
                                    @if ($orders)
                                        ${{ number_format($totalRevenue / $orders, 2) }}
                                    @else
                                        $0.00
                                    @endif
                                </h4>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="rounded-3 p-3 bg-light">
                                <small class="text-uppercase text-muted">Recent activity</small>
                                <p class="mb-0 mt-2 text-secondary">{{ $recentProducts->count() }} newest products added.
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="rounded-3 p-3 bg-light">
                                <small class="text-uppercase text-muted">Catalog growth</small>
                                <p class="mb-0 mt-2 text-secondary">{{ $recentCategories->count() }} newest categories
                                    created.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Quick actions</h5>
                </div>
                <div class="list-group list-group-flush">
                    <a href="{{ route('categories.index') }}" class="list-group-item list-group-item-action">Manage
                        categories</a>
                    <a href="{{ route('products.index') }}" class="list-group-item list-group-item-action">Manage
                        products</a>
                    <a href="{{ route('index') }}" class="list-group-item list-group-item-action">Visit storefront</a>
                    <a href="{{ route('logout') }}" class="list-group-item list-group-item-action text-danger">Sign out</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mt-4">
        <div class="col-lg-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white border-0">
                    <h5 class="mb-0">Recent categories</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
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
                                    <td class="text-end text-muted">{{ $category->created_at->diffForHumans() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-muted">No categories created yet.</td>
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
                    <h5 class="mb-0">Recent products</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless mb-0">
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
                                        <span
                                            class="badge bg-secondary">{{ $product->category?->name ?? 'Unassigned' }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="text-muted">No products available yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
