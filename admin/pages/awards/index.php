<?php include "../../header.php"; ?>
<?php include "../../../config.php"; ?>
<?php include "../../sidebar.php"; ?>

<?php
$section = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM awards_section LIMIT 1"));
$cards = mysqli_query($conn, "SELECT * FROM awards_cards ORDER BY id DESC");
?>

<div class="col-9 container-fluid">
    <div class="row">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold">Awards & Accolades</h3>
        </div>

        <!--  SECTION TABLE -->
        <div class="card shadow mb-4">
            <div class="card-header bg-dark text-white">
                Section Details
            </div>

            <div class="card-body">

                <table class="table table-bordered text-center">
                    <tr>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                        <td><?= $section['subtitle']; ?></td>
                        <td><?= $section['title']; ?></td>
                        <td><?= $section['description']; ?></td>
                        <td><a href="section_edit.php" class="btn btn-warning btn-sm">Edit Section</a></td>
                    </tr>
                </table>

            </div>
        </div>

        <!--  AWARDS TABLE -->
        <div class="card shadow ">
            <div class="card-header bg-dark text-white">
                Awards List
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-end mb-3">
                    <a href="create.php" class="btn btn-success btn-sm">+ Add Cards</a>
                </div>
                <table class="table table-hover text-center align-middle table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Organization</th>
                            <th>Year</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php if (mysqli_num_rows($cards) > 0) { ?>

                            <?php while ($row = mysqli_fetch_assoc($cards)) { ?>

                                <tr>

                                    <td><?= $row['id']; ?></td>

                                    <td><?= $row['title']; ?></td>

                                    <td><?= $row['organization']; ?></td>

                                    <td>
                                        <span class="badge bg-warning text-dark">
                                            <?= $row['year']; ?>
                                        </span>
                                    </td>

                                    <td>

                                        <a href="edit.php?id=<?= $row['id']; ?>"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

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
                                <td colspan="5">No Data Found</td>
                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            </div>
        </div>

    </div>
</div>

<?php include "../../footer.php"; ?>