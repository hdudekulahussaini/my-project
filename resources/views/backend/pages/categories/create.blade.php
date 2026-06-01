@extends('layouts.backend.app')
@section('content')
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">
                    Add Category
                </h2>
                <p class="text-muted">
                    Create a new category for your store
                </p>
            </div>
            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                <i class="fa fa-arrow-left me-2"></i>
                Back
            </a>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">
                                Category Name
                            </label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Category Name"
                                required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">
                                Category Image
                            </label>
                            <input type="file" name="image" class="form-control">
                            <small class="text-muted">
                                Upload category image
                            </small>
                        </div>
                        <div class="col-md-12">
                            <div class="border rounded p-4 text-center bg-light">
                                <i class="fa fa-image fa-3x text-secondary mb-3"></i>
                                <p class="mb-0 text-muted">
                                    Image Preview Area
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-primary px-4">
                            <i class="fa fa-save me-2"></i>
                            Save Category
                        </button>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary px-4">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
