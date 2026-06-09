@extends('layouts.frontend.app')

@section('content')
    <div class="container" style="margin-top:130px;">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-5">
                <div class="card shadow p-4">
                    <h3 class="text-center mb-4">Admin Login</h3>
                    <form action="{{ route('login.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="login_type" value="admin">

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button class="btn btn-dark w-100" type="submit">Login as Admin</button>
                    </form>
                    <p class="text-center mt-3">
                        Back to user login?
                        <a href="{{ route('login.user') }}">User login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
