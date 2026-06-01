<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>
<?php include "../../../config.php"; ?>

<?php
// COUNT SERVICES (cards only)
$count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM services"));
?>

<div class="col-9 container-fluid">

    <!-----------------------SECTION----------------------->
    <?php
    $section = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM services_section LIMIT 1"));
    ?>

    <div class="card mb-4 shadow-sm mt-5">
        <div class="card-header bg-dark text-white d-flex justify-content-between">
            <span>Section Details</span>
            <a href="edit_section.php?id=<?php echo $section['id']; ?>" class="btn btn-warning">
                Edit Section
            </a>
        </div>

        <div class="card-body text-center">
            <h6 class="text-warning"><?php echo $section['subtitle']; ?></h6>
            <h4 class="fw-bold"><?php echo $section['title']; ?></h4>
            <p class="text-muted"><?php echo $section['description']; ?></p>
        </div>
    </div>

    <!-----------------------ADD BUTTON----------------------->
    <?php if ($count < 6) { ?>
        <div class="d-flex justify-content-end mb-3">
            <a href="create.php" class="btn btn-success">
                + Add Service
            </a>
        </div>
    <?php } ?>

    <!-----------------------TABLE----------------------->
    <div class="card shadow">
        <div class="card-header bg-dark text-white">
            Services List
        </div>

        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-bordered table-hover text-center">

                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Icon</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php
                        $result = mysqli_query($conn, "SELECT * FROM services ORDER BY id DESC");

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                                <tr>
                                    <td><?php echo $row['id']; ?></td>

                                    <td>
                                        <i class="<?php echo $row['icon']; ?> fs-4 text-warning"></i>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($row['title']); ?>
                                    </td>

                                    <td style="max-width:300px;">
                                        <?php echo htmlspecialchars($row['description']); ?>
                                    </td>

                                    <td>
                                        <a href="edit.php?id=<?php echo $row['id']; ?>"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <a href="delete.php?id=<?php echo $row['id']; ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete this?')">
                                            Delete
                                        </a>
                                    </td>
                                </tr>

                        <?php
                            }
                        } else {
                        ?>
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