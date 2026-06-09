@extends('layouts.backend.app')
@section('content')
    <div class="container-fluid py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">
                    Edit Category
                </h2>
                <p class="text-muted">
                    Update category information
                </p>
            </div>
            <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">
                <i class="fa fa-arrow-left me-2"></i>
                Back
            </a>
        </div>
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">
                                Category Name
                            </label>
                            <input type="text" name="name" value="{{ $category->name }}" class="form-control"
                                placeholder="Enter Category Name" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Slug <small class="text-muted">(auto-generated)</small></label>
                            <input type="text" name="slug" id="slug" value="{{ $category->slug }}" class="form-control" readonly>
                        </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Current Image
                            </label>
                            <div class="border rounded p-3 bg-light text-center">
                                @if ($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" width="150" height="150"
                                        style="object-fit:cover; border-radius:12px;">
                                @else
                                    <p class="text-muted">
                                        No Image Available
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">
                                Upload New Image
                            </label>
                            <input type="file" name="image" class="form-control">
                            <small class="text-muted">
                                Upload only if changing image
                            </small>
                        </div>
                    </div>
                    <div class="mt-4">
                        <button class="btn btn-success px-4">
                            <i class="fa fa-save me-2"></i>
                            Update Category
                        </button>
                        <a href="{{ route('categories.index') }}" class="btn btn-secondary px-4">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.querySelector('input[name="name"]').addEventListener('input', function() {
            const name = this.value;
            const slug = name
                .toLowerCase()
                .trim()
                .replace(/[^\w\s-]/g, '')
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
            document.getElementById('slug').value = slug;
        });
    </script>
@endsection
