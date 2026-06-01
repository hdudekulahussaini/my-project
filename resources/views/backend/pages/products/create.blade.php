@extends('layouts.backend.app')
@section('content')
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">
                    Add Product
                </h2>
                <p class="text-muted">
                    Create a new product for your store
                </p>
            </div>
            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                <i class="fa fa-arrow-left me-2"></i>
                Back
            </a>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Category
                            </label>
                            <select name="category_id" class="form-control">
                                <option value="">
                                    Select Category
                                </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Product Name
                            </label>
                            <input type="text" name="name" class="form-control" placeholder="Enter product name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Thumbnail
                            </label>
                            <input type="file" name="thumbnail" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Gallery Images
                            </label>
                            <input type="file" name="gallery[]" class="form-control" multiple>
                            <small class="text-muted">
                                Select multiple images
                            </small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Color
                            </label>
                            <input type="text" name="color" class="form-control" placeholder="Example: Red">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Sale Price
                            </label>
                            <input type="number" name="sale_price" class="form-control" placeholder="Sale Price">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Original Price
                            </label>
                            <input type="number" name="original_price" class="form-control" placeholder="Original Price">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Weight
                            </label>
                            <input type="text" name="weight" class="form-control" placeholder="1 Kg">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">
                                Description
                            </label>
                            <textarea name="description" rows="5" class="form-control" placeholder="Enter product description"></textarea>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-primary px-4">
                            <i class="fa fa-save me-2"></i>
                            Save Product
                        </button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary px-4">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
