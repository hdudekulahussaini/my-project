<?php include "../../../../config.php"; ?>

<?php
if (isset($_POST['save'])) {
    mysqli_query($conn, "INSERT INTO studio_hours(day,open_time,close_time)
    VALUES('{$_POST['day']}','{$_POST['open']}','{$_POST['close']}')");

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
                   class="form-control" 
                   placeholder="Enter day (e.g. Monday - Friday)" 
                   required>
        </div>
        <!-- Open Time -->
        <div class="mb-3">
            <label class="form-label">Opening Time</label>
            <input type="text" name="open" 
                   class="form-control" 
                   placeholder="Enter opening time (e.g. 9:00 AM)" 
                   required>
        </div>
        <!-- Close Time -->
        <div class="mb-3">
            <label class="form-label">Closing Time</label>
            <input type="text" name="close" 
                   class="form-control" 
                   placeholder="Enter closing time (e.g. 6:00 PM)" 
                   required>
        </div>
        <button name="save" class="btn btn-success w-100">
            Save
        </button>
    </form>
</div>
<?php include "../../../footer.php"; ?>