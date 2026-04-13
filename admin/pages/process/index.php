```php
<?php include "../../../config.php"; ?>
<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>

<div class="col-9 p-4">

    <h3 class="mb-3">Process Management</h3>

    <!-- SECTION TABLE -->
    <?php
    $section = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM process_section LIMIT 1"));
    ?>

    <table class="table table-bordered text-center">
        <tr class="table-dark">
            <th>ID</th>
            <th>Title</th>
            <th>subtittle</th>
            <th>Description</th>
            <th>Action</th>
        </tr>

        <?php if($section): ?>
        <tr>
            <td><?= $section['id'] ?></td>
            <td><?= $section['title'] ?></td>
            <td><?= $section['subtitle'] ?></td>
            <td><?= $section['description'] ?></td>
            <td>
                <a href="edit_section.php?id=<?= $section['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
            </td>
        </tr>
        <?php else: ?>
        <tr>
            <td colspan="4">No Section Data</td>
        </tr>
        <?php endif; ?>
    </table>

    <hr>

    <!-- ADD BUTTON -->
    <div class="d-flex justify-content-end mb-3">
        <a href="create.php" class="btn btn-success">Add Step</a>
    </div>

    <!-- STEPS TABLE -->
    <table class="table table-bordered text-center">
        <tr class="table-dark">
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Action</th>
        </tr>

        <?php
        // ORDER BY ID (since step_number removed)
        $res = mysqli_query($conn, "SELECT * FROM process_steps ORDER BY id ASC");

        $step = 1; // auto step number

        if(mysqli_num_rows($res) > 0){
            while ($row = mysqli_fetch_assoc($res)) {
        ?>

            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['title'] ?></td>
                <td><?= $row['description'] ?></td>

                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>

                    <a href="delete.php?id=<?= $row['id'] ?>" 
                       class="btn btn-danger btn-sm"
                       onclick="return confirm('Delete?')">
                       Delete
                    </a>
                </td>
            </tr>

        <?php 
            }
        } else {
        ?>
            <tr>
                <td colspan="5">No Steps Found</td>
            </tr>
        <?php } ?>

    </table>

</div>

<?php include "../../footer.php"; ?>

