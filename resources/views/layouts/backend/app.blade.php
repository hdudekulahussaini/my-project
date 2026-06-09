<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('backend/css/style.css') }}" rel="stylesheet">
</head>

<body>

    @include('backend.partials.sidebar')

    <div class="main-content">

        @include('backend.partials.header')

        <div class="p-4">

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    <strong>Success!</strong> {{ session('success') }}

                    <button type="button" class="btn-close" data-bs-dismiss="alert">
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
                    <i class="fas fa-times-circle me-2"></i>
                    <strong>Error!</strong> {{ session('error') }}

                    <button type="button" class="btn-close" data-bs-dismiss="alert">
                    </button>
                </div>
            @endif

            @if (session('info'))
                <div class="alert alert-info alert-dismissible fade show shadow-sm border-0" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    <strong>Info!</strong> {{ session('info') }}

                    <button type="button" class="btn-close" data-bs-dismiss="alert">
                    </button>
                </div>
            @endif

        </div>

        @yield('content')
    </div>

    @include('backend.partials.footer')

    </div>
    <script>
        setTimeout(function() {
            let alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                alert.classList.remove('show');
            });
        }, 4000);
    </script>
</body>

</html>
