@extends('layouts.frontend.app')

@section('content')
    <div class="container py-5" style="margin-top:120px;">

        <div class="row g-4">

            {{-- Sidebar --}}
            <div class="col-lg-3">

                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body text-center p-4">

                        <div class="mx-auto bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mb-3"
                            style="width:80px;height:80px;font-size:30px;">
                            <i class="fas fa-user"></i>
                        </div>

                        <h5 class="fw-bold mb-1">{{ Auth::user()->name }}</h5>
                        <p class="text-muted small mb-0">{{ Auth::user()->email }}</p>

                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="list-group list-group-flush">

                        <a href="{{ route('orders') }}" class="list-group-item list-group-item-action py-3">
                            <i class="fas fa-shopping-bag text-primary me-2"></i>
                            My Orders
                        </a>

                        <a href="{{ route('wishlist') }}" class="list-group-item list-group-item-action py-3">
                            <i class="fas fa-heart text-danger me-2"></i>
                            Wishlist
                        </a>

                        <a href="{{ route('cart') }}" class="list-group-item list-group-item-action py-3">
                            <i class="fas fa-shopping-cart text-success me-2"></i>
                            My Cart
                        </a>

                        <a href="#" class="list-group-item list-group-item-action py-3 active">
                            <i class="fas fa-user me-2"></i>
                            Profile Information
                        </a>

                        <a href="{{ route('logout') }}" class="list-group-item list-group-item-action py-3 text-danger">
                            <i class="fas fa-sign-out-alt me-2"></i>
                            Logout
                        </a>

                    </div>
                </div>

            </div>

            {{-- Main Content --}}
            <div class="col-lg-9">

                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div>
                                <h3 class="fw-bold mb-1">My Account</h3>
                                <p class="text-muted mb-0">Manage your profile and account details</p>
                            </div>

                            <a href="{{ route('shop') }}" class="btn btn-primary rounded-pill px-4">
                                Continue Shopping
                            </a>
                        </div>

                        <div class="row g-4 mb-4">

                            <div class="col-md-4">
                                <div class="card border-0 bg-light rounded-4 h-100">
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                            style="width:55px;height:55px;">
                                            <i class="fas fa-shopping-bag"></i>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-1">Total Orders</p>
                                            <h4 class="fw-bold mb-0">{{ $ordersCount }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card border-0 bg-light rounded-4 h-100">
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center"
                                            style="width:55px;height:55px;">
                                            <i class="fas fa-heart"></i>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-1">Wishlist Items</p>
                                            <h4 class="fw-bold mb-0">{{ $wishlistCount }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="card border-0 bg-light rounded-4 h-100">
                                    <div class="card-body d-flex align-items-center gap-3">
                                        <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center"
                                            style="width:55px;height:55px;">
                                            <i class="fas fa-shopping-cart"></i>
                                        </div>
                                        <div>
                                            <p class="text-muted mb-1">Cart Items</p>
                                            <h4 class="fw-bold mb-0">{{ $cartCount }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <h5 class="fw-bold mb-3">Personal Information</h5>

                        <div class="card border-0 bg-light rounded-4">
                            <div class="card-body p-4">

                                <div class="row mb-3">
                                    <div class="col-md-4 text-muted">Full Name</div>
                                    <div class="col-md-8 fw-semibold">{{ Auth::user()->name }}</div>
                                </div>

                                <hr>

                                <div class="row mb-3">
                                    <div class="col-md-4 text-muted">Email Address</div>
                                    <div class="col-md-8 fw-semibold">{{ Auth::user()->email }}</div>
                                </div>

                                <hr>

                                <div class="row mb-3">
                                    <div class="col-md-4 text-muted">Phone Number</div>
                                    <div class="col-md-8 fw-semibold">
                                        {{ Auth::user()->phone ?? 'Not Added' }}
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-4 text-muted">Account Type</div>
                                    <div class="col-md-8 fw-semibold text-capitalize">
                                        {{ Auth::user()->user_type ?? 'User' }}
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
