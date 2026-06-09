<!-- Spinner Start -->
<div id="spinner"
    class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" role="status"></div>
</div>
<!-- Spinner End -->

<!-- Navbar start -->
<div class="container-fluid fixed-top">
    <div class="container topbar bg-primary d-none d-lg-block">
        <div class="d-flex justify-content-between">
            <div class="top-info ps-2">
                <small class="me-3">
                    <i class="fas fa-map-marker-alt me-2 text-secondary"></i>
                    <a href="#" class="text-white">123 Street, New York</a>
                </small>

                <small class="me-3">
                    <i class="fas fa-envelope me-2 text-secondary"></i>
                    <a href="#" class="text-white">Email@Example.com</a>
                </small>
            </div>

            <div class="top-link pe-2">
                <a href="#" class="text-white">
                    <small class="text-white mx-2">Privacy Policy</small>/
                </a>
                <a href="#" class="text-white">
                    <small class="text-white mx-2">Terms of Use</small>/
                </a>
                <a href="#" class="text-white">
                    <small class="text-white ms-2">Sales and Refunds</small>
                </a>
            </div>
        </div>
    </div>

    <div class="container px-0">
        <nav class="navbar navbar-light bg-white navbar-expand-xl">
            <a href="{{ route('index') }}" class="navbar-brand">
                <h1 class="text-primary display-6">Fruitables</h1>
            </a>

            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>

            <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{ route('index') }}" class="nav-item nav-link active">Home</a>
                    <a href="{{ route('shop') }}" class="nav-item nav-link">Shop</a>
                    <a href="{{ route('cart') }}" class="nav-item nav-link">Shop Cart</a>
                    <a href="{{ route('wishlist') }}" class="nav-item nav-link">Wishlist</a>
                    <a href="{{ route('contact') }}" class="nav-item nav-link">Contact</a>
                </div>

                <div class="d-flex m-3 me-0">
                    <button
                        class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4"
                        data-bs-toggle="modal" data-bs-target="#searchModal">
                        <i class="fas fa-search text-primary"></i>
                    </button>

                    <a href="{{ route('cart') }}" class="position-relative me-4 my-auto">
                        <i class="fa fa-shopping-cart fa-2x text-primary"></i>
                        <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                            style="top:-5px;left:15px;height:20px;min-width:20px;">
                            {{ Auth::check() ? \App\Models\Cart::where('user_id', Auth::id())->count() : 0 }}
                        </span>
                    </a>

                    <a href="{{ route('wishlist') }}" class="position-relative me-4 my-auto">
                        <i class="fa fa-heart fa-2x text-danger"></i>
                        <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
                            style="top:-5px;left:15px;height:20px;min-width:20px;">
                            {{ Auth::check() ? \App\Models\Wishlist::where('user_id', Auth::id())->count() : 0 }}
                        </span>
                    </a>

                    @guest
                        <a href="{{ route('login') }}"
                            class="d-flex align-items-center text-dark text-decoration-none my-auto">
                            <i class="fas fa-sign-in-alt fa-2x me-2"></i>
                            <span>Sign In</span>
                        </a>
                    @endguest

                    @auth
                        <div class="dropdown my-auto">
                            <a href="#" class="dropdown-toggle text-dark text-decoration-none d-flex align-items-center"
                                data-bs-toggle="dropdown">
                                <i class="fas fa-user fa-2x me-2"></i>
                                <div>
                                    <div>{{ Auth::user()->name }}</div>
                                    <small class="text-muted">Sign Out</small>
                                </div>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">
                                @if (Auth::user()->user_type == 'admin')
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            Admin Dashboard
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a class="dropdown-item" href="{{ route('user.dashboard') }}">
                                            User Dashboard
                                        </a>
                                    </li>
                                @endif

                                <li>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}">
                                        <i class="fas fa-sign-out-alt me-2"></i>Sign Out
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endauth
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->

<!-- Modal Search Start -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content rounded-0">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Search Products</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body d-flex align-items-start justify-content-center pt-5">
                <div class="w-75">

                    <div class="input-group">
                        <input type="text"
                            id="liveSearchInput"
                            class="form-control p-3"
                            placeholder="Search product name...">

                        <span class="input-group-text p-3">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>

                    <div id="liveSearchResults"
                        class="bg-white shadow rounded mt-2"
                        style="max-height:400px; overflow-y:auto;">
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- Modal Search End -->

<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('liveSearchInput');
    const resultsBox = document.getElementById('liveSearchResults');

    searchInput.addEventListener('keyup', function () {

        let search = this.value.trim();

        if (search.length < 1) {
            resultsBox.innerHTML = '';
            return;
        }

        fetch("{{ route('live.search') }}?search=" + encodeURIComponent(search))
            .then(response => response.json())
            .then(products => {

                let html = '';

                if (products.length > 0) {
                    products.forEach(product => {

                        let image = product.thumbnail
                            ? "{{ asset('uploads/products') }}/" + product.thumbnail
                            : "{{ asset('frontend/img/no-image.png') }}";

                        html += `
                            <a href="/product/${product.slug}"
                               class="d-flex align-items-center p-3 border-bottom text-decoration-none text-dark">

                                <img src="${image}"
                                     onerror="this.src='{{ asset('frontend/img/no-image.png') }}'"
                                     style="width:60px;height:60px;object-fit:cover;"
                                     class="rounded me-3">

                                <div>
                                    <h6 class="mb-1">${product.name}</h6>
                                    <strong class="text-primary">₹${product.sale_price}</strong>
                                </div>
                            </a>
                        `;
                    });
                } else {
                    html = `
                        <div class="p-3 text-center text-muted">
                            No products found
                        </div>
                    `;
                }

                resultsBox.innerHTML = html;
            });

    });

});
</script>
