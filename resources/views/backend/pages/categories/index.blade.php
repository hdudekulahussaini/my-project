@extends('layouts.backend.app')

@section('content')
    <div class="container-fluid py-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="fw-bold mb-1">
                    Categories Management
                </h2>

                <p class="text-muted">
                    Manage all product categories
                </p>

            </div>

            <a href="{{ route('categories.create') }}" class="btn btn-primary">

                <i class="fa fa-plus me-2"></i>

                Add Category

            </a>

        </div>

        @if (session('success'))
            <div class="alert alert-success shadow-sm">

                <i class="fa fa-check-circle me-2"></i>

                {{ session('success') }}

            </div>
        @endif

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table align-middle">

                        <thead class="table-dark">

                            <tr>

                                <th>ID</th>

                                <th>Image</th>

                                <th>Name</th>

                                <th>Slug</th>

                                <th>Status</th>

                                <th>Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($categories as $category)
                                <tr>

                                    <td>

                                        <span class="badge bg-dark">

                                            #{{ $category->id }}

                                        </span>

                                    </td>

                                    <td>

                                        @if ($category->image)
                                            <img src="{{ asset('storage/' . $category->image) }}" width="70"
                                                height="70"
                                                style="
                            object-fit:cover;
                            border-radius:12px;">
                                        @else
                                            <div class="bg-light d-flex align-items-center justify-content-center"
                                                style="
                            width:70px;
                            height:70px;
                            border-radius:12px;">

                                                <i class="fa fa-image text-secondary"></i>

                                            </div>
                                        @endif

                                    </td>

                                    <td>

                                        <strong>

                                            {{ $category->name }}

                                        </strong>

                                    </td>

                                    <td>

                                        <span class="text-muted">

                                            {{ $category->slug }}

                                        </span>

                                    </td>

                                    <td>

                                        <span class="badge bg-success">

                                            Active

                                        </span>

                                    </td>

                                    <td>

                                        <div class="d-flex gap-2">
                                            <a href="{{ route('categories.edit', $category->id) }}"
                                                class="btn btn-warning btn-sm">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">

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

                                    <td colspan="6" class="text-center py-5">

                                        <i class="fa fa-folder-open fa-3x text-secondary mb-3"></i>

                                        <p class="text-muted">

                                            No Categories Found

                                        </p>

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
