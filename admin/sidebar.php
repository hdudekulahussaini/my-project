<?php
$current_folder = basename(dirname($_SERVER['PHP_SELF']));
$current_page = basename($_SERVER['PHP_SELF']);
?>
<div class="row">
    <div class="bg-dark text-white p-3 shadow sidebar">
        <h4 class="text-center mb-4 border-bottom pb-2">Admin Panel</h4>
        <ul class="nav flex-column">
            <!-- Dashboard -->
            <li class="nav-item mb-2">
                <a href="/admin/index.php"
                    class="nav-link text-white <?php if ($current_page == 'index.php' && $current_folder == 'admin') echo 'active'; ?>">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
            <!-- Hero -->
            <li class="nav-item mb-2">
                <a href="/admin/pages/home/index.php"
                    class="nav-link text-white <?php if ($current_folder == 'home') echo 'active'; ?>">
                    <i class="bi bi-house me-2"></i> Hero Section
                </a>
            </li>
            <!-- Counter -->
            <li class="nav-item mb-2">
                <a href="/admin/pages/counter/index.php"
                    class="nav-link text-white <?php if ($current_folder == 'counter') echo 'active'; ?>">
                    <i class="bi bi-bar-chart-line me-2"></i> Counter
                </a>
            </li>
            <!-- Services -->
            <li class="nav-item mb-2">
                <a href="/admin/pages/services/index.php"
                    class="nav-link text-white <?php if ($current_folder == 'services') echo 'active'; ?>">
                    <i class="bi bi-bar-chart-line me-2"></i> Services
                </a>
            </li>
            <!-- Process -->
            <li class="nav-item mb-2">
                <a href="/admin/pages/process/index.php"
                    class="nav-link text-white <?php if ($current_folder == 'process') echo 'active'; ?>">
                    <i class="bi bi-diagram-3 me-2"></i> Process
                </a>
            </li>
            <!-- Projects -->
            <li class="nav-item mb-2">
                <a href="/admin/pages/projects/index.php"
                    class="nav-link text-white <?php if ($current_folder == 'projects') echo 'active'; ?>">
                    <i class="bi bi-folder me-2"></i> Projects
                </a>
            </li>
            <!-- Testimonials -->
            <li class="nav-item mb-2">
                <a href="/admin/pages/testimonials/index.php"
                    class="nav-link text-white <?php if ($current_folder == 'testimonials') echo 'active'; ?>">
                    <i class="bi bi-chat-dots me-2"></i> Testimonials
                </a>
            </li>
            <!-- Awards -->
            <li class="nav-item mb-2">
                <a href="/admin/pages/awards/index.php"
                    class="nav-link text-white <?php if ($current_folder == 'awards') echo 'active'; ?>">
                    <i class="bi bi-trophy me-2"></i> Awards
                </a>
            </li>
            <!-- FAQ -->
            <li class="nav-item mb-2">
                <a href="/admin/pages/faq/index.php"
                    class="nav-link text-white <?php if ($current_folder == 'faq') echo 'active'; ?>">
                    <i class="bi bi-question-circle me-2"></i> FAQ
                </a>
            </li>
            <!-- Contact Dropdown -->
            <li class="nav-item mb-2">
                <a class="nav-link text-white d-flex justify-content-between align-items-center"
                    data-bs-toggle="collapse"
                    href="#contactMenu"
                    role="button">
                    <span>
                        <i class="bi bi-telephone me-2"></i> Contact
                    </span>
                    <i class="bi bi-chevron-down"></i>
                </a>
                <div class="collapse <?php if ($current_folder == 'contact') echo 'show'; ?>" id="contactMenu">
                    <ul class="nav flex-column ms-3 mt-2">
                        <!-- Contact -->
                        <li class="nav-item mb-2">
                            <a href="/admin/pages/contact/index.php"
                                class="nav-link text-white <?php if ($current_folder == 'contact') echo 'active'; ?>">
                                <i class="bi bi-telephone me-2"></i> Contact
                            </a>
                        </li>
                        <!-- Studio -->
                        <li class="nav-item mb-1">
                            <a href="/admin/pages/contact/studio_hours/index.php"
                                class="nav-link text-white <?php if ($current_page == 'studio.php') echo 'active'; ?>">
                                <i class="bi bi-building me-2"></i> Studio
                            </a>
                        </li>
                        <!-- Message -->
                        <li class="nav-item">
                            <a href="/admin/pages/contact/messages/index.php"
                                class="nav-link text-white <?php if ($current_page == 'message.php') echo 'active'; ?>">
                                <i class="bi bi-envelope me-2"></i> Message
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!-- Consultation -->
            <li class="nav-item mb-2">
                <a href="/admin/pages/consultation_cta/index.php"
                    class="nav-link text-white <?php if ($current_folder == 'consultation_cta') echo 'active'; ?>">
                    <i class="bi bi-calendar-check me-2"></i> Consultation
                </a>
            </li>
            <!-- Footer -->
            <li class="nav-item mb-2">
                <a href="/admin/pages/footer/index.php"
                    class="nav-link text-white <?php if ($current_folder == 'footer') echo 'active'; ?>">
                    <i class="bi bi-layout-text-window-reverse me-2"></i> Footer
                </a>
            </li>
            <li>
                <a class="dropdown-item py-2 text-danger fw-bold rounded" href="/admin/logout.php">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </a>
            </li>
        </ul>
    </div>
    <script>
history.scrollRestoration = "manual";
</script>