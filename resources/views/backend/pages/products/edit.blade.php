@extends('layouts.backend.app')

@section('content')
    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">Edit Product</h2>
                <p class="text-muted mb-0">Update product details</p>
            </div>

            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                <i class="fa fa-arrow-left me-2"></i>
                Back
            </a>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">

                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="row g-4">

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Category</label>

                            <select name="category_id" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Product Name</label>

                            <input type="text" name="name" value="{{ $product->name }}" class="form-control"
                                placeholder="Enter product name">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Sale Price</label>

                            <input type="number" name="sale_price" value="{{ $product->sale_price }}" class="form-control"
                                placeholder="Enter sale price">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Original Price</label>

                            <input type="number" name="original_price" value="{{ $product->original_price }}"
                                class="form-control" placeholder="Enter original price">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Color</label>

                            <input type="text" name="color" value="{{ $product->color }}" class="form-control"
                                placeholder="Example: Red">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Weight</label>

                            <input type="text" name="weight" value="{{ $product->weight }}" class="form-control"
                                placeholder="Example: 1 kg">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Current Image</label>

                            <div class="border rounded p-3 text-center bg-light">
                                @if ($product->thumbnail)
                                    <img src="{{ asset('storage/' . $product->thumbnail) }}" width="120" height="120"
                                        style="object-fit:cover;border-radius:12px;">
                                @else
                                    <p class="text-muted mb-0">No image uploaded</p>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">New Thumbnail</label>

                            <input type="file" name="thumbnail" class="form-control">

                            <small class="text-muted">
                                Upload new image only if you want to change existing image.
                            </small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Gallery Images
                            </label>
                            <input type="file" name="gallery[]" class="form-control" multiple>
                            <small class="text-muted">
                                Select multiple product images
                            </small>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Description</label>

                            <textarea name="description" rows="5" class="form-control" placeholder="Enter product description">{{ $product->description }}</textarea>
                        </div>

                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button class="btn btn-success px-4">
                            <i class="fa fa-save me-2"></i>
                            Update Product
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
