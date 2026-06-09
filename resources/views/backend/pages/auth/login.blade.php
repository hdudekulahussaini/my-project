@extends('layouts.frontend.app')

@section('content')
    <style>
        body {
            background: #f5f5f5;
        }

        .login-card {
            border: none;
            border-radius: 10px;
        }

        .login-btn {
            background: #dc3545;
            border: none;
        }

        .login-btn:hover {
            background: #bb2d3b;
        }
    </style>
    <div class="container py-5" style="margin-top:120px;">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-4">
                <div class="card shadow login-card">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4">
                            {{ ucfirst($type) }} Login
                        </h3>
                        <p class="text-center text-muted mb-4">
                            Please enter your credentials to sign in as a {{ $type }}.
                        </p>
                        <form action="{{ route('login.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="login_type" value="{{ $type }}">
                            <div class="mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-danger w-100 login-btn">
                                Login
                            </button>
                        </form>
                        @if ($type == 'user')
                            <p class="text-center mt-3">
                                New User?
                                <a href="{{ route('register') }}">
                                    Register
                                </a>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endsection
