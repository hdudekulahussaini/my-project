<div class="sidebar">

    <h4 class="text-center py-4 border-bottom">
        Admin Panel
    </h4>
    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        Dashboard
    </a>
    <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">
        Categories
    </a>
    <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'active' : '' }}">
        Products
    </a>

    <a href="{{ route('index') }}">
        <i class="fa fa-globe me-2"></i>
        Visit Website
    </a>
    <a href="{{ route('logout') }}" class="text-danger">
        <i class="fa fa-sign-out me-2"></i>
        Logout
    </a>

</div>
