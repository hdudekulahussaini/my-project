@extends('layouts.backend.app')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Features</h2>

            <a href="{{ route('features.create') }}" class="btn btn-primary">
                Add Feature
            </a>
        </div>

        <div class="card shadow">
            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Icon</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th width="180">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($features as $feature)
                                <tr>
                                    <td>{{ $feature->id }}</td>

                                    <td>
                                        <i class="{{ $feature->icon }}"></i>
                                    </td>

                                    <td>{{ $feature->title }}</td>

                                    <td>{{ $feature->description }}</td>

                                    <td>
                                        @if ($feature->status)
                                            <span class="badge bg-success">
                                                Active
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('features.edit', $feature->id) }}" class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <form action="{{ route('features.destroy', $feature->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger btn-sm">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                            @empty

                                <tr>
                                    <td colspan="6" class="text-center">
                                        No Features Found
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
