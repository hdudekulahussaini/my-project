<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: #eef2fb;
            color: #1f2937;
            font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            position: fixed;
            background: linear-gradient(180deg, #0f172a 0%, #111827 100%);
            color: #d1d5db;
            box-shadow: 2px 0 24px rgba(15, 23, 42, 0.18);
        }

        .sidebar h4 {
            color: #fff;
            font-size: 0.94rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            margin-bottom: 0;
        }

        .sidebar a {
            color: #cbd5e1;
            text-decoration: none;
            display: block;
            padding: 18px 24px;
            transition: all 0.2s ease;
            border-left: 4px solid transparent;
        }

        .sidebar a:hover,
        .sidebar a.active {
            color: #f8fafc;
            background: rgba(148, 163, 184, 0.14);
            border-color: #3b82f6;
        }

        .main-content {
            margin-left: 260px;
            min-height: 100vh;
        }

        .topbar {
            background: transparent;
            padding: 24px 28px;
            margin-bottom: 1rem;
        }

        .topbar h5 {
            font-size: 1.1rem;
            letter-spacing: 0.01em;
            margin-bottom: 0.25rem;
        }

        .topbar small {
            color: #64748b;
        }

        .topbar .topbar-actions {
            background: #ffffff;
            padding: 12px 16px;
            border-radius: 18px;
            box-shadow: 0 16px 40px rgba(15, 23, 42, 0.08);
        }

        .topbar .topbar-actions .btn {
            min-width: 44px;
            min-height: 44px;
            border-radius: 12px;
        }

        .card {
            border: none;
            border-radius: 1.35rem;
            box-shadow: 0 22px 50px rgba(15, 23, 42, 0.08);
        }

        .card-header {
            background: transparent;
            border: none;
            padding-bottom: 0;
        }

        .card .card-body {
            padding: 1.5rem;
        }

        .dashboard-stat-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .dashboard-stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 28px 70px rgba(15, 23, 42, 0.12);
        }

        .dashboard-stat-card .icon-box {
            width: 58px;
            height: 58px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px;
        }

        .dashboard-stat-card .icon-box i {
            font-size: 1.2rem;
        }

        .badge-soft {
            border-radius: 16px;
            font-weight: 500;
            padding: 0.65rem 0.9rem;
        }

        .list-group-item {
            border: none;
            padding: 18px 24px;
            border-radius: 1rem;
            margin: 0.4rem 1rem 0.4rem 1rem;
            transition: all 0.2s ease;
        }

        .list-group-item:hover {
            background: #f8fafc;
        }

        .table-responsive {
            background: #ffffff;
            border-radius: 1.35rem;
            box-shadow: inset 0 0 0 1px rgba(15, 23, 42, 0.04);
            overflow: hidden;
        }

        .table thead th {
            color: #475569;
            border-bottom: none;
            font-size: 0.88rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .table tbody tr {
            border-bottom: 1px solid rgba(15, 23, 42, 0.06);
        }

        .table tbody tr:last-child {
            border-bottom: none;
        }

        footer {
            background: transparent;
            border-top: 1px solid rgba(148, 163, 184, 0.2);
        }
    </style>
</head>

<body>

    @include('backend.partials.sidebar')

    <div class="main-content">

        @include('backend.partials.header')

        <div class="p-4">
            @yield('content')
        </div>

        @include('backend.partials.footer')

    </div>

</body>

</html>
