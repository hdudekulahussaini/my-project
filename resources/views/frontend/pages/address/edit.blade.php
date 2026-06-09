@extends('layouts.frontend.app')

@section('content')
    <div class="container py-5" style="margin-top:120px;">

        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="card shadow-lg border-0 rounded-4">

                    <div class="card-header bg-primary text-white rounded-top-4 py-3">
                        <h3 class="mb-0">
                            <i class="fa fa-map-marker-alt me-2"></i>
                            Edit Delivery Address
                        </h3>
                    </div>

                    <div class="card-body p-4">

                        <form action="{{ route('address.update', $address->id) }}" method="POST">

                            @csrf
                            @method('PUT')

                            <div class="row">

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">
                                        Full Name
                                    </label>
                                    <input type="text" name="name" class="form-control" value="{{ $address->name }}"
                                        required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">
                                        Mobile Number
                                    </label>
                                    <input type="text" name="phone" class="form-control" value="{{ $address->phone }}"
                                        required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-semibold">
                                        email
                                    </label>
                                    <input type="email" name="email" class="form-control" value="{{ $address->email }}"
                                        required>
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="form-label fw-semibold">
                                        Address
                                    </label>
                                    <textarea name="address" rows="3" class="form-control" required>{{ $address->address }}</textarea>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">
                                        City
                                    </label>
                                    <input type="text" name="city" class="form-control" value="{{ $address->city }}"
                                        required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">
                                        State
                                    </label>
                                    <input type="text" name="state" class="form-control" value="{{ $address->state }}"
                                        required>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-semibold">
                                        Pincode
                                    </label>
                                    <input type="text" name="pincode" class="form-control"
                                        value="{{ $address->pincode }}" required>
                                </div>

                                <div class="col-12 mb-4">
                                    <label class="form-label fw-semibold">
                                        Country
                                    </label>
                                    <input type="text" name="country" class="form-control"
                                        value="{{ $address->country }}" required>
                                </div>

                            </div>

                            <div class="d-flex justify-content-end gap-2">

                                <a href="{{ url()->previous() }}" class="btn btn-light border px-4">
                                    Cancel
                                </a>

                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="fa fa-save me-1"></i>
                                    Update Address
                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
