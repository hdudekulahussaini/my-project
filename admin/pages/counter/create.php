<?php include "../../../config.php"; ?>


<?php
if (isset($_POST['save'])) {
    $title = $_POST['title'];
    $number = $_POST['number'];

    mysqli_query($conn, "INSERT INTO counters(title,number) VALUES('$title','$number')");
    header("Location: index.php");
}
?>
<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>

<div class="col-9 container mt-4">
    <form method="POST">
    <label>Title</label>
    <input type="text" id="title" name="title" class="form-control mb-2" placeholder="Enter title" required>
    <label>Number</label>
    <input type="text" id="number" name="number" class="form-control mb-2" placeholder="Enter number" required>
    <button name="save" class="btn btn-success">Save</button>
</form>
</div>
<?php include "../../footer.php"; ?>