@extends('layouts.frontend.app')
@section('title','Add Address')
@section('content')
<div class="container py-5" style="margin-top:120px;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0">
                        <i class="fa fa-map-marker-alt me-2"></i>
                        Add New Address
                    </h4>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('address.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text"
                                    name="name"
                                    class="form-control"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone Number</label>
                                <input type="text"
                                    name="phone"
                                    class="form-control"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email"
                                    name="email"
                                    value="{{ auth()->user()->email }}"
                                    class="form-control"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Pincode</label>
                                <input type="text"
                                    name="pincode"
                                    class="form-control"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">City</label>
                                <input type="text"
                                    name="city"
                                    class="form-control"
                                    required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">State</label>
                                <input type="text"
                                    name="state"
                                    class="form-control"
                                    required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Country</label>
                                <input type="text"
                                    name="country"
                                    value="India"
                                    class="form-control"
                                    required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Complete Address</label>
                                <textarea name="address"
                                    rows="4"
                                    class="form-control"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ url()->previous() }}"
                               class="btn btn-secondary">
                                Back
                            </a>
                            <button type="submit"
                                    class="btn btn-primary">
                                Save Address
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection