@extends('layouts.backend.app')

@section('content')
    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold mb-1">Products Management</h2>
                <p class="text-muted mb-0">Manage your store products, stock and pricing</p>
            </div>

            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="fa fa-plus me-2"></i>
                Add Product
            </a>
        </div>

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Weight</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>
                                        <span class="badge bg-dark">
                                            #{{ $product->id }}
                                        </span>
                                    </td>

                                    <td>
                                        @if ($product->thumbnail)
                                            <img src="{{ asset('storage/' . $product->thumbnail) }}" width="65"
                                                height="65" class="rounded-3 border" style="object-fit: cover;">
                                        @else
                                            <div class="bg-light border rounded-3 d-flex align-items-center justify-content-center"
                                                style="width:65px;height:65px;">
                                                <i class="fa fa-image text-muted"></i>
                                            </div>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="fw-bold">
                                            {{ $product->name }}
                                        </div>
                                        <small class="text-muted">
                                            {{ $product->slug }}
                                        </small>
                                    </td>

                                    <td>
                                        <span class="badge bg-primary">
                                            {{ $product->category->name ?? 'No Category' }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="fw-bold text-success">
                                            ₹{{ number_format($product->sale_price, 2) }}
                                        </div>

                                        @if ($product->original_price)
                                            <small class="text-danger">
                                                <del>₹{{ number_format($product->original_price, 2) }}</del>
                                            </small>
                                        @endif
                                    </td>

                                    <td>
                                        {{ $product->weight ?? 'KG' }}
                                    </td>

                                    <td>
                                        <strong>{{ $product->stock }}</strong>
                                        <small class="text-muted">KG</small>
                                    </td>

                                    <td>
                                        @if ($product->stock > 10)
                                            <span class="badge bg-success">
                                                In Stock
                                            </span>
                                        @elseif ($product->stock > 0)
                                            <span class="badge bg-warning text-dark">
                                                Low Stock
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                Out Of Stock
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="d-flex gap-2 justify-content-end">
                                            <a href="{{ route('products.edit', $product->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this product?')">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-5 text-muted">
                                        <i class="fa fa-box-open fa-2x mb-2"></i>
                                        <div>No Products Found</div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
