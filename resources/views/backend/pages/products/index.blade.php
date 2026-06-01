@extends('layouts.backend.app')

@section('content')

    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="fw-bold">
                    Products Management
                </h2>

                <p class="text-muted">
                    Manage your store products
                </p>
            </div>

            <a href="{{ route('products.create') }}" class="btn btn-primary">

                <i class="fa fa-plus me-2"></i>

                Add Product

            </a>

        </div>

        <div class="card border-0 shadow">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table align-middle">

                        <thead class="table-dark">

                            <tr>

                                <th>ID</th>

                                <th>Thumbnail</th>

                                <th>Gallery</th>

                                <th>Category</th>

                                <th>Product</th>

                                <th>Sale Price</th>

                                <th>Original Price</th>

                                <th>Weight</th>

                                <th>Status</th>

                                <th>Action</th>

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
                                            <img src="{{ asset('storage/' . $product->thumbnail) }}" width="70"
                                                height="70" style="object-fit:cover;border-radius:10px;">
                                        @else
                                            No Image
                                        @endif

                                    </td>

                                    <td>

                                        <div class="d-flex gap-1 flex-wrap">

                                            @if ($product->gallery)
                                                @foreach (json_decode($product->gallery, true) ?? [] as $gallery)
                                                    <img src="{{ asset('storage/' . $gallery) }}" width="45"
                                                        height="45" style="object-fit:cover;border-radius:6px;">
                                                @endforeach
                                            @endif

                                        </div>

                                    </td>

                                    <td>

                                        <span class="badge bg-primary">

                                            {{ $product->category->name ?? 'No Category' }}

                                        </span>

                                    </td>

                                    <td>

                                        <strong>

                                            {{ $product->name }}

                                        </strong>

                                    </td>

                                    <td>

                                        <span class="text-success fw-bold">

                                            ₹{{ number_format($product->sale_price, 2) }}

                                        </span>

                                    </td>

                                    <td>

                                        <span class="text-danger">

                                            <del>

                                                ₹{{ number_format($product->original_price, 2) }}

                                            </del>

                                        </span>

                                    </td>

                                    <td>

                                        {{ $product->weight }}

                                    </td>

                                    <td>

                                        <span class="badge bg-success">

                                            Active

                                        </span>

                                    </td>

                                    <td>

                                        <div class="d-flex gap-2">

                                            <a href="{{ route('products.edit', $product->id) }}"
                                                class="btn btn-warning btn-sm">

                                                <i class="fa fa-edit"></i>

                                            </a>

                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST">

                                                @csrf

                                                @method('DELETE')

                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Delete Product?')">

                                                    <i class="fa fa-trash"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="10" class="text-center text-muted">

                                        No Products Found

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
