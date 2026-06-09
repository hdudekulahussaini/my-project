<div class="topbar bg-white shadow-sm rounded-4 px-4 py-3 mb-4 d-flex justify-content-between align-items-center">

    <div>
        <h4 class="mb-1 fw-bold text-dark">
            Welcome back, Admin 👋
        </h4>
        <small class="text-muted">
            Manage your products, orders, customers and store performance.
        </small>
    </div>

    <div class="d-flex align-items-center gap-3">
        <div class="position-relative">
            <button type="button" class="btn btn-light rounded-circle shadow-sm"
                style="width:42px;height:42px;">
                <i class="fa fa-bell text-warning"></i>
            </button>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                3
            </span>
        </div>

        <a href="{{ route('index') }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">
            <i class="fa fa-store me-1"></i>
            View Store
        </a>

        <form action="{{ route('logout') }}" method="POST" class="mb-0">
            @csrf
            <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3">
                <i class="fa fa-sign-out-alt me-1"></i>
                Logout
            </button>
        </form>

        <div class="d-flex align-items-center gap-2 border-start ps-3">
            <span class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center shadow"
                style="width:46px;height:46px;">
                <i class="fa fa-user-shield"></i>
            </span>

            <div class="text-end">
                <div class="fw-bold">
                    {{ Auth::user()->name ?? 'Admin' }}
                </div>
                <small class="text-muted">
                    Administrator
                </small>
            </div>
        </div>

    </div>
</div>