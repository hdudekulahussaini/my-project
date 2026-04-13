<?php include "../../../config.php"; ?>


<?php
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM counters WHERE id=$id"));

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $number = $_POST['number'];

    mysqli_query($conn, "UPDATE counters SET title='$title', number='$number' WHERE id=$id");
    header("Location: index.php");
}
?>
<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>
<div class="col-9 container mt-4">
    <form method="POST">
        <input type="text" name="title" value="<?php echo $data['title']; ?>" class="form-control mb-2">
        <input type="text" name="number" value="<?php echo $data['number']; ?>" class="form-control mb-2">
        <button name="update" class="btn btn-primary">Update</button>
    </form>
</div>
<?php include "../../footer.php"; ?>