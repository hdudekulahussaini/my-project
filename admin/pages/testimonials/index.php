<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>
<?php include "../../../config.php"; ?>

<?php
//  GET SECTION DATA
$section = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM testimonial_section LIMIT 1"));

//  GET TESTIMONIALS
$data = mysqli_query($conn, "SELECT * FROM testimonials ORDER BY id DESC");
?>

<div class="col-9 container-fluid">
    <div class="row">

        <div class="col-md-9 col-lg-10 p-4">

            <!-- HEADER -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold">Testimonials Slider</h3>

                <div>
                    <a href="section.php" class="btn btn-info me-2">
                        Edit Section
                    </a>
                </div>
            </div>

            <!--  SECTION TABLE -->
            <div class="card shadow border-0 mb-4">
                <div class="card-body">

                    <h5 class="fw-bold mb-3">Section Details</h5>

                    <table class="table table-bordered text-center">

                        <tr class="table-dark">
                            <th>Title</th>
                            <th>Subtitle</th>
                            <th>Description</th>
                        </tr>

                        <tr>
                            <td><?= $section['title'] ?? 'No Data' ?></td>
                            <td><?= $section['subtitle'] ?? 'No Data' ?></td>
                            <td><?= $section['description'] ?? 'No Data' ?></td>
                        </tr>

                    </table>

                </div>
            </div>
            <!--  TESTIMONIALS TABLE -->
            <div class="card shadow border-0" style="width: 126%" ;>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="fw-bold mb-3">Testimonials List</h5>
                        <div>
                            <a href="create.php" class="btn btn-success">
                                Add Testimonial
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle text-center">

                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th style="width:40%;">Review</th>
                                    <th>Rating</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php if (mysqli_num_rows($data) > 0) { ?>

                                    <?php while ($row = mysqli_fetch_assoc($data)) { ?>

                                        <tr>
                                            <td><?= $row['id']; ?></td>

                                            <td><?= $row['name']; ?></td>

                                            <td><?= $row['role']; ?></td>

                                            <!-- FIXED TEXT -->
                                            <td class="text-start text-wrap text-break">
                                                <?= $row['message']; ?>
                                            </td>

                                            <td>
                                                <?php
                                                for ($i = 1; $i <= 5; $i++) {
                                                    echo ($i <= $row['rating']) ? "⭐" : "☆";
                                                }
                                                ?>
                                            </td>

                                            <td>
                                                <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>

                                                <a href="delete.php?id=<?= $row['id']; ?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Delete?')">
                                                    Delete
                                                </a>
                                            </td>
                                        </tr>

                                    <?php } ?>

                                <?php } else { ?>

                                    <tr>
                                        <td colspan="6">No Testimonials Found</td>
                                    </tr>

                                <?php } ?>
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>

        </div>

    </div>
</div>

<?php include "../../footer.php"; ?>