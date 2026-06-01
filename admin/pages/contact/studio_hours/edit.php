<?php include "../../../../config.php"; ?>

<?php
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM studio_hours WHERE id=$id"));

if (isset($_POST['update'])) {
    mysqli_query($conn, "UPDATE studio_hours SET
    day='{$_POST['day']}',
    open_time='{$_POST['open']}',
    close_time='{$_POST['close']}'
    WHERE id=$id");

    header("Location:index.php");
}
?>
<?php include "../../../header.php"; ?>
<?php include "../../../sidebar.php"; ?>
<div class="col-9 container mt-5">
    <form method="POST">
        <!-- Day -->
        <div class="mb-3">
            <label class="form-label">Day</label>
            <input type="text" name="day"
                value="<?= $data['day'] ?>"
                class="form-control"
                placeholder="Enter day (e.g. Monday - Friday)">
        </div>
        <!-- Open Time -->
        <div class="mb-3">
            <label class="form-label">Opening Time</label>
            <input type="text" name="open"
                value="<?= $data['open_time'] ?>"
                class="form-control"
                placeholder="Enter opening time (e.g. 9:00 AM)">
        </div>
        <!-- Close Time -->
        <div class="mb-3">
            <label class="form-label">Closing Time</label>
            <input type="text" name="close"
                value="<?= $data['close_time'] ?>"
                class="form-control"
                placeholder="Enter closing time (e.g. 6:00 PM)">
        </div>
        <button name="update" class="btn btn-warning w-100">Update</button>
    </form>
</div>
<?php include "../../../footer.php"; ?>