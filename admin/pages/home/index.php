<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>
<?php include "../../../config.php"; ?>

<?php
// CHECK DATA
$check = mysqli_query($conn, "SELECT * FROM hero_section LIMIT 1");
$dataExists = mysqli_num_rows($check) > 0;
?>

<div class="col-9 container-fluid">
    <div class="row">

        <div class="col-12 mt-5">

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="fw-bold">Hero Section List</h3>

                <!-- SHOW ONLY IF NO DATA -->
                <?php if (!$dataExists): ?>
                    <a href="create.php" class="btn btn-primary">
                        Add New
                    </a>
                <?php endif; ?>
            </div>

            <div class="card shadow">
                <div class="card-body">

                    <table class="table table-bordered text-center">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>

                        <?php
                        $result = mysqli_query($conn, "SELECT * FROM hero_section");

                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['title']; ?></td>
                                    <td><?php echo $row['description']; ?></td>
                                    <td>
                                        <a href="edit.php?id=<?php echo $row['id']; ?>"
                                            class="btn btn-warning btn-sm">
                                            Edit
                                        </a>

                                        <a href="delete.php?id=<?php echo $row['id']; ?>"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete?')">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php }
                        } else { ?>
                            <tr>
                                <td colspan="4">No Data</td>
                            </tr>
                        <?php } ?>

                    </table>

                </div>
            </div>

        </div>
    </div>
</div>

<?php include "../../footer.php"; ?>
```