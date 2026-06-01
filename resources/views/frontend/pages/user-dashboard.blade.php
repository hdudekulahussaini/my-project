@extends('layouts.frontend.app')

@section('content')
    <div class="container py-5" style="margin-top:120px;">

        <div class="row g-4">

            <!-- Left User Menu -->
            <div class="col-lg-3">

                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width:50px;height:50px;">
                            <i class="fas fa-user"></i>
                        </div>

                        <div>
                            <small class="text-muted">Hello,</small>
                            <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="list-group list-group-flush">

                        <a href="{{ route('orders') }}" class="list-group-item list-group-item-action py-3">
                            <i class="fas fa-shopping-bag text-primary me-2"></i>
                            MY ORDERS
                        </a>

                        <a href="{{ route('wishlist') }}" class="list-group-item list-group-item-action py-3">
                            <i class="fas fa-heart text-danger me-2"></i>
                            WISHLIST
                        </a>

                        <a href="{{ route('cart') }}" class="list-group-item list-group-item-action py-3">
                            <i class="fas fa-shopping-cart text-success me-2"></i>
                            MY CART
                        </a>

                        <a href="#" class="list-group-item list-group-item-action py-3">
                            <i class="fas fa-user text-warning me-2"></i>
                            PROFILE INFORMATION
                        </a>

                        <a href="{{ route('logout') }}" class="list-group-item list-group-item-action py-3 text-danger">
                            <i class="fas fa-sign-out-alt me-2"></i>
                            LOGOUT
                        </a>

                    </div>
                </div>

            </div>

            <!-- Right Content -->
            <div class="col-lg-9">

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">

                        <h4 class="fw-bold mb-4">Personal Information</h4>

                        <div class="row mb-4">
                            <div class="col-md-4 mb-3">
                                <div class="card border-0 shadow-sm p-3 text-center">
                                    <div class="text-secondary mb-2">Total Orders</div>
                                    <h3 class="mb-0">{{ $ordersCount }}</h3>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card border-0 shadow-sm p-3 text-center">
                                    <div class="text-secondary mb-2">Wishlist Items</div>
                                    <h3 class="mb-0">{{ $wishlistCount }}</h3>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="card border-0 shadow-sm p-3 text-center">
                                    <div class="text-secondary mb-2">Cart Items</div>
                                    <h3 class="mb-0">{{ $cartCount }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <tbody>
                                    <tr>
                                        <th style="width:220px;">Name</th>
                                        <td>{{ Auth::user()->name }}</td>
                                    </tr>

                                    <tr>
                                        <th>Email</th>
                                        <td>{{ Auth::user()->email }}</td>
                                    </tr>

                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ Auth::user()->phone ?? 'Not Added' }}</td>
                                    </tr>

                                    <tr>
                                        <th>Total Orders</th>
                                        <td>{{ $ordersCount }}</td>
                                    </tr>

                                    <tr>
                                        <th>Wishlist Items</th>
                                        <td>{{ $wishlistCount }}</td>
                                    </tr>

                                    <tr>
                                        <th>Cart Items</th>
                                        <td>{{ $cartCount }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <a href="{{ route('shop') }}" class="btn btn-primary mt-3">
                            Continue Shopping
                        </a>

                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
