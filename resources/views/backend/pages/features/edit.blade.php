@extends('layouts.backend.app')

@section('content')
    <div class="container-fluid">

        <div class="card shadow">
            <div class="card-header">
                <h4>Edit Feature</h4>
            </div>

            <div class="card-body">

                <form action="{{ route('features.update', $feature->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label>Icon</label>
                        <input type="text" name="icon" class="form-control" value="{{ $feature->icon }}">
                    </div>

                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $feature->title }}">
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ $feature->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ $feature->status == 1 ? 'selected' : '' }}>
                                Active
                            </option>
                            <option value="0" {{ $feature->status == 0 ? 'selected' : '' }}>
                                Inactive
                            </option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Update Feature
                    </button>

                    <a href="{{ route('features.index') }}" class="btn btn-secondary">
                        Back
                    </a>

                </form>

            </div>
        </div>

    </div>
@endsection
