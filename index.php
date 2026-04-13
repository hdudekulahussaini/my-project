<?php include "config.php"; ?>

<!DOCTYPE html>
<html>

<head>
    <title>Interior Design</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="/admin/css/style.css">
    <script src="/admin/css/script.js" defer></script>
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-primary  shadow-sm py-3">
        <div class="container">

            <!-- LOGO -->
            <a class="navbar-brand fw-bold fs-4" href="#">
                Atelier <span class="text-muted fw-light">STUDIO</span>
            </a>

            <!-- TOGGLE (Mobile) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- MENU -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav gap-3">

                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold" href="#">About</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold" href="#">Portfolio</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold" href="#">Services</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold" href="#">Pricing</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold" href="#">Blog</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold" href="#">Contact</a>
                    </li>

                </ul>
            </div>

            <!-- RIGHT SIDE -->
            <div class="d-flex align-items-center gap-3">

                <!-- ICON -->
                <i class="bi bi-moon fs-5"></i>

                <!-- BUTTON -->
                <a href="#" class="btn px-4 py-2 rounded-pill text-white fw-semibold"
                    style="background:#a9782a;">
                    Book Consultation
                </a>

            </div>

        </div>
    </nav>
    <!-- HERO -->
    <?php $hero = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM hero_section LIMIT 1")); ?>
    <section class="bg-dark text-white text-center p-5">
        <h1><?php echo $hero['title'] ?? 'Title'; ?></h1>
        <p><?php echo $hero['description'] ?? ''; ?></p>
    </section>
    <!-- COUNTER SECTION -->
    <section style="background:#f5f5f5; padding:60px 0;">
        <div class="container text-center">

            <div class="row">

                <?php
                $counter = mysqli_query($conn, "SELECT * FROM counters");

                while ($row = mysqli_fetch_assoc($counter)) {
                ?>

                    <div class="col-md-3 col-6 mb-4">

                        <h1 style="font-size:48px; font-weight:700; color:#1c1c1c;">
                            <?php echo $row['number']; ?>
                        </h1>

                        <p style="letter-spacing:2px; font-size:13px; color:#777;">
                            <?php echo strtoupper($row['title']); ?>
                        </p>

                    </div>

                <?php } ?>

            </div>

        </div>
    </section>
    <!-- SERVICES -->
    <?php
    $section = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM services_section LIMIT 1"));
    $services = mysqli_query($conn, "SELECT * FROM services");
    ?>
    <div class="container py-5">
        <!-- SECTION -->
        <div class="text-center mb-5">
            <span class="badge bg-warning text-dark mb-2">
                <?php echo $section['subtitle']; ?>
            </span>
            <h2 class="fw-bold">
                <?php echo $section['title']; ?>
            </h2>
            <p class="text-muted">
                <?php echo $section['description']; ?>
            </p>
        </div>
        <!-- SERVICES -->
        <div class="row g-4">
            <?php while ($row = mysqli_fetch_assoc($services)) { ?>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm p-3">

                        <div class="mb-3">
                            <span class="bg-warning-subtle p-3 rounded">
                                <i class="<?php echo $row['icon']; ?> fs-4 text-warning"></i>
                            </span>
                        </div>
                        <h5 class="fw-bold">
                            <?php echo $row['title']; ?>
                        </h5>
                        <p class="text-muted">
                            <?php echo $row['description']; ?>
                        </p>
                        <a href="#" class="text-warning text-decoration-none">
                            Learn more →
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- PROJECTS -->
    <?php
    $section = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM project_section LIMIT 1"));
    $projects = mysqli_query($conn, "SELECT * FROM projects LIMIT 6");
    $data = [];
    while ($row = mysqli_fetch_assoc($projects)) {
        $data[] = $row;
    }
    ?>
    <div class="container py-5 bg-light">

        <!-- SECTION -->
        <div class="text-center mb-5">
            <span class="badge bg-warning text-dark mb-2">
                <?php echo $section['subtitle']; ?>
            </span>

            <h2 class="fw-bold"><?php echo $section['title']; ?></h2>
            <p class="text-muted"><?php echo $section['description']; ?></p>
        </div>

        <div class="row g-4">

            <!-- LEFT COLUMN (3 SMALL) -->
            <div class="col-md-4 d-flex flex-column gap-4">

                <?php for ($i = 0; $i < 3; $i++) { ?>
                    <div class="position-relative rounded overflow-hidden">
                        <img src="admin/upload/<?php echo $data[$i]['image']; ?>"
                            class="w-100"
                            style="height:250px; object-fit:cover;">

                        <div class="position-absolute bottom-0 start-0 w-100 p-3"
                            style="background:linear-gradient(to top,rgba(0,0,0,0.7),transparent);">

                            <small class="text-warning">
                                <?php echo $data[$i]['category']; ?>
                            </small>

                            <h6 class="text-white m-0 fw-bold">
                                <?php echo $data[$i]['title']; ?>
                            </h6>

                        </div>
                    </div>
                <?php } ?>

            </div>

            <!-- MIDDLE COLUMN (1 SMALL + 1 BIG) -->
            <div class="col-md-4 d-flex flex-column gap-4">

                <!-- SMALL -->
                <?php $row = $data[3]; ?>
                <div class="position-relative rounded overflow-hidden">
                    <img src="admin/upload/<?php echo $row['image']; ?>"
                        class="w-100"
                        style="height:250px; object-fit:cover;">

                    <div class="position-absolute bottom-0 start-0 w-100 p-3"
                        style="background:linear-gradient(to top,rgba(0,0,0,0.7),transparent);">

                        <small class="text-warning">
                            <?php echo $row['category']; ?>
                        </small>

                        <h6 class="text-white m-0 fw-bold">
                            <?php echo $row['title']; ?>
                        </h6>

                    </div>
                </div>

                <!-- BIG -->
                <?php $row = $data[4]; ?>
                <div class="position-relative rounded overflow-hidden">
                    <img src="admin/upload/<?php echo $row['image']; ?>"
                        class="w-100"
                        style="height:520px; object-fit:cover;">

                    <div class="position-absolute bottom-0 start-0 w-100 p-3"
                        style="background:linear-gradient(to top,rgba(0,0,0,0.7),transparent);">

                        <small class="text-warning">
                            <?php echo $row['category']; ?>
                        </small>

                        <h6 class="text-white m-0 fw-bold">
                            <?php echo $row['title']; ?>
                        </h6>

                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN (1 BIG) -->
            <div class="col-md-4">

                <?php $row = $data[5]; ?>

                <div class="position-relative rounded overflow-hidden">
                    <img src="admin/upload/<?php echo $row['image']; ?>"
                        class="w-100"
                        style="height:790px; object-fit:cover;">

                    <div class="position-absolute bottom-0 start-0 w-100 p-4"
                        style="background:linear-gradient(to top,rgba(0,0,0,0.7),transparent);">

                        <small class="text-warning fs-6">
                            <?php echo $row['category']; ?>
                        </small>

                        <h5 class="text-white fw-bold m-0">
                            <?php echo $row['title']; ?>
                        </h5>

                    </div>
                </div>

            </div>

        </div>

    </div>
    <!-- PROCESS -->
    <?php
    $section = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM process_section LIMIT 1"));
    $steps = mysqli_query($conn, "SELECT * FROM process_steps ORDER BY id ASC");
    $data = [];
    while ($row = mysqli_fetch_assoc($steps)) {
        $data[] = $row;
    }
    ?>

    <div class="container py-5">

        <!-- TOP SECTION -->
        <div class="text-center mb-5">
            <span class="badge rounded-pill px-3 py-2 mb-3"
                style="background:#f1e6d6; color:#b8892b;">
                <?php echo $section['subtitle']; ?>
            </span>

            <h1 class="fw-bold" style="font-size:48px;">
                <?php echo $section['title']; ?>
            </h1>

            <p class="text-muted w-50 mx-auto">
                <?php echo $section['description']; ?>
            </p>
        </div>

        <!-- TIMELINE -->
        <div class="position-relative">

            <!-- CENTER LINE -->
            <div class="position-absolute top-0 start-50 translate-middle-x"
                style="width:2px; height:100%; background:#ddd;"></div>

            <!-- ROW 1 -->
            <div class="row align-items-center mb-5">

                <!-- LEFT EMPTY -->
                <div class="col-md-6 text-end"></div>

                <!-- RIGHT TEXT -->
                <div class="col-md-6">
                    <h4 class="fw-bold"><?php echo $data[0]['title']; ?></h4>
                    <p class="text-muted"><?php echo $data[0]['description']; ?></p>
                </div>

                <!-- CIRCLE -->
                <div class="position-absolute start-50 translate-middle"
                    style="top:20px;">
                </div>

            </div>

            <!-- ROW 2 -->
            <div class="row align-items-center mb-5">

                <!-- LEFT TEXT -->
                <div class="col-md-6 text-end">
                    <h4 class="fw-bold"><?php echo $data[1]['title']; ?></h4>
                    <p class="text-muted"><?php echo $data[1]['description']; ?></p>
                </div>

                <!-- RIGHT EMPTY -->
                <div class="col-md-6"></div>

                <!-- CIRCLE -->
                <div class="position-absolute start-50 translate-middle"
                    style="top:220px;">
                </div>

            </div>

            <!-- ROW 3 -->
            <div class="row align-items-center mb-5">

                <!-- LEFT EMPTY -->
                <div class="col-md-6 text-end"></div>

                <!-- RIGHT TEXT -->
                <div class="col-md-6">
                    <h4 class="fw-bold"><?php echo $data[2]['title']; ?></h4>
                    <p class="text-muted"><?php echo $data[2]['description']; ?></p>
                </div>

                <!-- CIRCLE -->
                <div class="position-absolute start-50 translate-middle"
                    style="top:420px;">
                </div>

            </div>

            <!-- ROW 4 -->
            <div class="row align-items-center">

                <!-- LEFT TEXT -->
                <div class="col-md-6 text-end">
                    <h4 class="fw-bold"><?php echo $data[3]['title']; ?></h4>
                    <p class="text-muted"><?php echo $data[3]['description']; ?></p>
                </div>

                <!-- RIGHT EMPTY -->
                <div class="col-md-6"></div>

                <!-- CIRCLE -->
                <div class="position-absolute start-50 translate-middle"
                    style="top:620px;">
                </div>

            </div>

        </div>
        <!-- TESTIMONIAL CARDS -->
        <?php
        $section = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM testimonial_section LIMIT 1"));
        $data = mysqli_query($conn, "SELECT * FROM testimonials ORDER BY id DESC");
        ?>
        <section class="testimonial-section">
            <div class="container text-center mb-5">

                <span class="badge-title">
                    <?= $section['subtitle'] ?? 'Client Stories'; ?>
                </span>

                <h2 class="main-title">
                    <?= $section['title'] ?? 'What Our Clients Say'; ?>
                </h2>

                <p class="main-desc">
                    <?= $section['description'] ?? 'Hear from our happy clients.'; ?>
                </p>

            </div>
            <div class="container position-relative">

                <div class="swiper mySwiper">

                    <div class="swiper-wrapper">

                        <?php while ($row = mysqli_fetch_assoc($data)) { ?>

                            <div class="swiper-slide">
                                <div class="testimonial-card">

                                    <!-- STARS -->
                                    <div class="stars mb-3">
                                        <?php
                                        for ($i = 1; $i <= 5; $i++) {
                                            echo $i <= $row['rating']
                                                ? '<span class="star active">★</span>'
                                                : '<span class="star">★</span>';
                                        }
                                        ?>
                                    </div>

                                    <!-- TEXT -->
                                    <p class="testimonial-text">
                                        "<?= $row['message']; ?>"
                                    </p>

                                    <hr>

                                    <!-- NAME -->
                                    <h6 class="client-name"><?= $row['name']; ?></h6>

                                    <!-- ROLE -->
                                    <small class="client-role"><?= $row['role']; ?></small>

                                </div>
                            </div>

                        <?php } ?>

                    </div>

                    <!-- DOTS -->
                    <div class="swiper-pagination"></div>

                    <!-- ARROWS -->
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>

                </div>

            </div>
        </section>
        <!-- AWARDS -->
        <?php
        $section = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM awards_section LIMIT 1"));
        $cards = mysqli_query($conn, "SELECT * FROM awards_cards ORDER BY id DESC");
        ?>
        <section class="py-5 bg-light">
            <div class="container text-center mb-5">
                <!-- SUBTITLE -->
                <span class="badge rounded-pill px-3 py-2 mb-3 text-dark" style="background:#e8d3a9;">
                    <?= $section['subtitle'] ?? 'Recognition'; ?>
                </span>
                <!-- TITLE -->
                <h2 class="fw-bold mb-3">
                    <?= $section['title'] ?? 'Awards & Accolades'; ?>
                </h2>
                <!-- DESCRIPTION -->
                <p class="main-desc">
                    <?= $section['description']; ?>
                </p>
            </div>
            <div class="container">
                <div class="row g-4">
                    <?php while ($row = mysqli_fetch_assoc($cards)) { ?>
                        <div class="col-md-4">
                            <div class="card border-0 shadow-sm h-100 p-3">
                                <div class="d-flex align-items-center">
                                    <!-- ICON -->
                                    <div class="me-3 rounded p-3" style="background:#e8d3a9;">
                                        ✦
                                    </div>
                                    <div>
                                        <!-- TITLE -->
                                        <h6 class="fw-bold mb-1">
                                            <?= $row['title']; ?>
                                        </h6>
                                        <!-- ORGANIZATION -->
                                        <small class="text-muted d-block mb-2">
                                            <?= $row['organization']; ?>
                                        </small>
                                        <!-- YEAR -->
                                        <span class="badge bg-secondary">
                                            <?= $row['year']; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
        <!-- FAQ -->
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        // FETCH SECTION DATA
        $section = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM faq_section LIMIT 1"));

        // FETCH FAQ DATA
        $faqs = mysqli_query($conn, "SELECT * FROM faqs");
        ?>
        </head>
        <section class="faq-section">
            <div class="container">

                <!-- SUBTITLE -->
                <span class="badge bg-light text-dark px-3 py-2 mb-2">
                    <?= htmlspecialchars($section['subtitle']) ?>
                </span>

                <!-- TITLE -->
                <h1 class="faq-title">
                    <?= htmlspecialchars($section['title']) ?>
                </h1>

                <!-- DESCRIPTION -->
                <p class="faq-desc">
                    <?= htmlspecialchars($section['description']) ?>
                </p>

                <!-- ACCORDION -->
                <div class="accordion" id="faqAccordion">

                    <?php $i = 1;
                    while ($row = mysqli_fetch_assoc($faqs)) { ?>

                        <div class="accordion-item">

                            <button class="accordion-button collapsed"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq<?= $i ?>">

                                <?= htmlspecialchars($row['question']) ?>
                            </button>

                            <div id="faq<?= $i ?>" class="accordion-collapse collapse"
                                data-bs-parent="#faqAccordion">

                                <div class="accordion-body">
                                    <div class="faq-answer-box">
                                        <p><?= htmlspecialchars($row['answer']) ?></p>
                                    </div>
                                </div>

                            </div>

                        </div>

                    <?php $i++;
                    } ?>

                </div>

            </div>
        </section>


        <!-- CONTACT -->
        <?php
        // GET SECTION DATA
        $section = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM contact_section LIMIT 1"));

        // GET STUDIO HOURS
        $hours = mysqli_query($conn, "SELECT * FROM studio_hours");

        // SAVE FORM
        if (isset($_POST['save'])) {

            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $phone = mysqli_real_escape_string($conn, $_POST['phone']);
            $service = mysqli_real_escape_string($conn, $_POST['service']);
            $message = mysqli_real_escape_string($conn, $_POST['message']);

            mysqli_query($conn, "INSERT INTO contact_messages(name,email,phone,service,message)
VALUES('$name','$email','$phone','$service','$message')");

            $success = true;
        }
        ?>

        <div class="container py-5">
            <!-- TOP TEXT -->
            <div class="text-center mb-5">
                <span class="badge-custom">
                    <?= htmlspecialchars($section['subtitle']) ?>
                </span>
                <h2 class="section-title mt-3">
                    <?= htmlspecialchars($section['title']) ?>
                </h2>
                <p>
                    <?= htmlspecialchars($section['description']) ?>
                </p>
            </div>
            <div class="row">
                <!-- LEFT FORM -->
                <div class="col-md-7">
                    <form method="POST">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Full Name</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Service</label>
                                <select name="service" class="form-select">

                                    <option value="">Select a service...</option>
                                    <option>Residential Design</option>
                                    <option>Commercial Design</option>
                                    <option>Hospitality Design</option>
                                    <option>Color Consulting</option>
                                    <option>Space Planning</option>
                                    <option>Renovation Management</option>
                                    <option>Interior Design</option>
                                    <option>Renovation</option>
                                    <option>Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label>Message</label>
                            <textarea name="message" class="form-control" required></textarea>
                        </div>
                        <button name="save" class="btn btn-custom">
                            Send Message →
                        </button>
                    </form>
                    <!-- SUCCESS MESSAGE -->
                    <?php if (!empty($success)) { ?>
                        <div class="alert alert-success mt-3">
                            Message Sent Successfully!
                        </div>
                    <?php } ?>
                </div>
                <!-- RIGHT SIDE -->
                <?php
                $footer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM footer_content LIMIT 1"));
                ?>

                <div class="col-md-5">
                    <div class="info-box">
                        <div class="icon-box">📞</div>
                        <div>
                            <strong>Phone</strong><br>
                            <?= htmlspecialchars($footer['phone']) ?>
                        </div>
                    </div>
                    <div class="info-box">
                        <div class="icon-box">✉️</div>
                        <div>
                            <strong>Email</strong><br>
                            <?= htmlspecialchars($footer['email']) ?>
                        </div>
                    </div>
                    <div class="info-box">
                        <div class="icon-box">📍</div>
                        <div>
                            <strong>Studio</strong><br>
                            <?= htmlspecialchars($footer['address']) ?>
                        </div>
                    </div>
                </div>
                <!-- STUDIO HOURS -->
                <div class="hours-box mt-4">
                    <h6>Studio Hours</h6>
                    <?php while ($row = mysqli_fetch_assoc($hours)) { ?>
                        <div class="d-flex justify-content-between">
                            <span><?= htmlspecialchars($row['day']) ?></span>
                            <span>
                                <?= htmlspecialchars($row['open_time']) ?> -
                                <?= htmlspecialchars($row['close_time']) ?>
                            </span>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    $footer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM footer_content LIMIT 1"));
    $socials = mysqli_query($conn, "SELECT * FROM social_links");
    ?>
    <?php
include "config.php";

$cta = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM consultation_cta WHERE status='active' LIMIT 1"));
?>

<?php if ($cta) { ?>
<section class="cta-section d-flex align-items-center justify-content-center text-center">

    <div class="container">
        <h1 class="cta-title">
            <?php echo $cta['title']; ?>
        </h1>

        <p class="cta-desc">
            <?php echo $cta['description']; ?>
        </p>

        <div class="cta-buttons mt-4">
            <a href="<?php echo $cta['btn1_link']; ?>" class="btn btn-main">
                <?php echo $cta['btn1_text']; ?> →
            </a>

            <a href="<?php echo $cta['btn2_link']; ?>" class="btn btn-outline-light ms-3">
                <?php echo $cta['btn2_text']; ?>
            </a>
        </div>
    </div>

</section>
<?php } ?>
    
    <footer class="last-section">
        <div class="container-fluid py-5">
            <div class="row">

                <!-- LEFT SIDE -->
                <div class="col-md-4">
                    <h4 class="text-white">
                        <?= $footer['logo_text'] ?>
                        <span class="text-muted"><?= $footer['subtitle'] ?></span>
                    </h4>

                    <p class="text-light mt-3">
                        <?= $footer['description'] ?>
                    </p>

                    <p class="text-light">📞 <?= $footer['phone'] ?></p>
                    <p class="text-light">✉️ <?= $footer['email'] ?></p>
                    <p class="text-light">📍 <?= $footer['address'] ?></p>

                    <!-- SOCIAL -->
                    <div class="d-flex gap-2 mt-3">
                        <?php while ($row = mysqli_fetch_assoc($socials)) { ?>
                            <a href="<?= $row['link'] ?>" target="_blank" class="social-icon">
                                <i class="bi <?= $row['icon'] ?>"></i>
                            </a>
                        <?php } ?>
                    </div>
                </div>

                <!-- SERVICES -->
                <div class="col-md-3">
                    <h6 class="text-white">SERVICES</h6>
                    <ul class="list-unstyled">
                        <li>Residential Design</li>
                        <li>Commercial Design</li>
                        <li>Hospitality Design</li>
                        <li>Renovation Management</li>
                    </ul>
                </div>

                <!-- RESOURCES -->
                <div class="col-md-3">
                    <h6 class="text-white">RESOURCES</h6>
                    <ul class="list-unstyled">
                        <li>Portfolio</li>
                        <li>Design Blog</li>
                        <li>Style Guide</li>
                        <li>Pricing</li>
                    </ul>
                </div>

                <!-- COMPANY -->
                <div class="col-md-2">
                    <h6 class="text-white">COMPANY</h6>
                    <ul class="list-unstyled">
                        <li>About</li>
                        <li>Contact</li>
                        <li>Careers</li>
                        <li>Press</li>
                    </ul>
                </div>

            </div>
        </div>
    </footer>
    