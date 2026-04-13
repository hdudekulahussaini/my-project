<?php include "header.php"; ?>
<?php include "../config.php"; ?>

<?php
// COUNTS
$user_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users"))['total'];
$project_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM projects"))['total'];
$service_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM services"))['total'];
$process_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM process_steps"))['total'];
?>

<div class="container-fluid">
    <div class="row">

        <!-- SIDEBAR -->
        <?php include "sidebar.php"; ?>

        <!-- MAIN CONTENT -->
        <div class="p-4 dashboard-bg" style="margin-left:260px;">

            <!-- TITLE -->
            <div class="mb-4">
                <h2 class="fw-bold">Dashboard</h2>
                <p class="text-muted">Overview of your website</p>
            </div>

            <!-- CARDS -->
            <div class="row g-4">

                <!-- user -->
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <i class="bi bi-people"></i>
                        <h6>Users</h6>
                        <h2><?= $user_count ?></h2>
                    </div>
                </div>
                <!-- process -->
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <i class="bi bi-diagram-3"></i>
                        <h6>Process</h6>
                        <h2><?= $process_count ?></h2>
                    </div>
                </div>
                <!-- PROJECTS -->
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <i class="bi bi-folder"></i>
                        <h6>Projects</h6>
                        <h2><?= $project_count ?></h2>
                    </div>
                </div>

                <!-- SERVICES -->
                <div class="col-md-3">
                    <div class="dashboard-card">
                        <i class="bi bi-grid"></i>
                        <h6>Services</h6>
                        <h2><?= $service_count ?></h2>
                    </div>
                </div>

            </div>

            <!-- QUICK ACTIONS -->
            <div class="card shadow border-0 mt-5">
                <div class="card-body">
                    <h5 class="fw-bold mb-3">Quick Actions</h5>

                    <div class="row g-3">

                        <div class="col-md-3">
                            <a href="pages/projects/create.php" class="quick-box">
                                <i class="bi bi-plus-circle"></i>
                                <span>Add Project</span>
                            </a>
                        </div>

                        <div class="col-md-3">
                            <a href="pages/services/create.php" class="quick-box">
                                <i class="bi bi-plus-circle"></i>
                                <span>Add Service</span>
                            </a>
                        </div>

                        <div class="col-md-3">
                            <a href="pages/testimonials/create.php" class="quick-box">
                                <i class="bi bi-chat"></i>
                                <span>Add Testimonial</span>
                            </a>
                        </div>

                        <div class="col-md-3">
                            <a href="pages/contact/index.php" class="quick-box">
                                <i class="bi bi-envelope"></i>
                                <span>Messages</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <?php include "footer.php"; ?>
