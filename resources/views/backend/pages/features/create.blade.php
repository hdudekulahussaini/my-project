@extends('layouts.backend.app')

@section('content')
    <div class="container-fluid">

        <div class="card shadow">
            <div class="card-header">
                <h4>Add Feature</h4>
            </div>

            <div class="card-body">

                <form action="{{ route('features.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label>Icon</label>
                        <input type="text" name="icon" class="form-control" placeholder="fas fa-car-side">
                    </div>

                    <div class="mb-3">
                        <label>Title</label>
                        <input type="text" name="title" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label>Description</label>
                        <textarea name="description" class="form-control" rows="4"></textarea>
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Save Feature
                    </button>

                </form>

            </div>
        </div>

    </div>
@endsection
