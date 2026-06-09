<div class="sidebar bg-dark text-white vh-100">

    <div class="text-center py-4 border-bottom">
        <h3 class="fw-bold text-warning">
            <i class="fa fa-shopping-bag me-2"></i>
            E-Commerce
        </h3>
        <small class="text-light">
            Admin Panel
        </small>
    </div>

    <div class="mt-3">

        <a href="{{ route('admin.dashboard') }}"
            class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-chart-line me-2"></i>
            Dashboard
        </a>

        <a href="{{ route('categories.index') }}"
            class="sidebar-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
            <i class="fas fa-tags me-2"></i>
            Categories
        </a>

        <a href="{{ route('products.index') }}"
            class="sidebar-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
            <i class="fas fa-box-open me-2"></i>
            Products
        </a>

        <a href="{{ route('features.index') }}"
            class="sidebar-link {{ request()->routeIs('features.*') ? 'active' : '' }}">
            <i class="fas fa-star me-2"></i>
            Features
        </a>

        <a href="{{ route('orders.index') }}" class="sidebar-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
            <i class="fas fa-shopping-cart me-2"></i>
            Orders
        </a>
        <a href="#" class="sidebar-link">
            <i class="fas fa-users me-2"></i>
            Customers
        </a>
        <a href="#" class="sidebar-link">
            <i class="fas fa-heart me-2"></i>
            Wishlist
        </a>
        <a href="#" class="sidebar-link">
            <i class="fas fa-cog me-2"></i>
            Settings
        </a>
        <hr class="bg-secondary">
        <a href="{{ route('index') }}" class="sidebar-link">
            <i class="fas fa-globe me-2"></i>
            Visit Website
        </a>
        <form action="{{ route('logout') }}" method="POST" class="mt-2 px-3">
            @csrf
            <button class="btn btn-danger w-100">
                <i class="fas fa-sign-out-alt me-2"></i>
                Logout
            </button>
        </form>
    </div>
</div>
