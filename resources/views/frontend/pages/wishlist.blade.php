@extends('layouts.frontend.app')

@section('content')

<div class="container py-5" style="margin-top:120px;">

    <h2 class="mb-4 fw-bold">My Wishlist</h2>

    <div class="row">
        @forelse ($wishlists as $wishlist)
            <div class="col-md-4 mb-4">
                <div class="card shadow border-0">
                    <img src="{{ asset('storage/' . $wishlist->product->thumbnail) }}"
                        class="card-img-top"
                        style="height:250px;object-fit:cover;">

                    <div class="card-body">
                        <h5 class="fw-bold">{{ $wishlist->product->name }}</h5>
                        <p class="text-muted">
                            {{ $wishlist->product->category->name ?? 'Wishlist item' }}
                        </p>
                        <h4 class="text-success">₹{{ $wishlist->product->sale_price }}</h4>

                        <div class="d-grid gap-2 mt-3">
                            <form action="{{ route('wishlist.move.to.cart', $wishlist->id) }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="btn btn-warning">
                                    <i class="fa fa-shopping-cart"></i>
                                    Add To Cart
                                </button>
                            </form>

                            <form action="{{ route('wishlist.delete', $wishlist->id) }}" method="POST" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                    Remove
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">Your wishlist is empty. Browse products and add favorites.</div>
            </div>
        @endforelse
    </div>

</div>

@endsection