<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/admin/css/style.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar fixed-top px-3 shadow" style="background: linear-gradient(45deg,#4e73df,#224abe); height:60px;">
        <span class="navbar-brand text-white fw-bold">
            <i class="bi bi-speedometer2 me-2"></i>HUSSAINI
        </span>
        <div class="dropdown ms-auto">
            <!-- Button Style (different from link style) -->
            <button class="btn d-flex align-items-center dropdown-toggle px-3"
                type="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:white">
                <i class="bi bi-person-circle me-2 fs-5"></i>
                <span class="fw-semibold"><?php echo $_SESSION['user_email']; ?></span>
            </button>
            <!-- Dropdown Menu -->
            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 p-3"
                style="min-width: 250px; border-radius: 15px;">

                <!-- Admin Header -->
                <li class="text-center mb-2">
                    <i class="bi bi-person-circle fs-1 text-primary"></i>
                    <h6 class="mt-2 mb-0"><?php echo $_SESSION['user_email']; ?></h6>
                    <small class="text-muted">Admin Panel</small>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <!-- Menu Items -->
                <li>
                    <a class="dropdown-item py-2 rounded" href="/admin/profile.php">
                        <i class="bi bi-speedometer2 me-2 text-primary"></i> admin proflie
                    </a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <!-- Logout -->
                <li>
                    <a class="dropdown-item py-2 text-danger fw-bold rounded" href="/admin/logout.php">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</body>