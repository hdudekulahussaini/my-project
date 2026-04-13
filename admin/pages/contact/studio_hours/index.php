<?php include "../../../../config.php"; ?>
<?php include "../../../header.php"; ?>
<?php include "../../../sidebar.php"; ?>
<div class="col-9 container mt-5">
    <a href="create.php" class="btn btn-success mb-3">Add</a>

    <table class="table table-bordered text-center">
        <tr>
            <th>ID</th>
            <th>Day</th>
            <th>Time</th>
            <th>Action</th>
        </tr>

        <?php
        $res = mysqli_query($conn, "SELECT * FROM studio_hours");
        while ($row = mysqli_fetch_assoc($res)) {
        ?>

            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['day'] ?></td>
                <td><?= $row['open_time'] ?> - <?= $row['close_time'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>

        <?php } ?>
    </table>
</div>
<?php include "../../../footer.php"; ?>
