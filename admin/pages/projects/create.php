<?php include "../../../config.php"; ?>

<?php
if (isset($_POST['save'])) {
    $cat = $_POST['category'];
    $title = $_POST['title'];
    $img = $_FILES['image']['name'];

    // FIXED PATH
    move_uploaded_file($_FILES['image']['tmp_name'], "../../upload/" . $img);
    //  move_uploaded_file($_FILES['image']['tmp_name'], "../../upload/" . $img);


    mysqli_query($conn, "INSERT INTO projects(category,title,image)
    VALUES('$cat','$title','$img')");

    header("Location:index.php");
    exit();
}
?>

<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>

<div class="col-9 container-fluid mt-5">
    <form method="POST" enctype="multipart/form-data">

        <input name="category" class="form-control mb-2" placeholder="Category">
        <input name="title" class="form-control mb-2" placeholder="Title">
        <input type="file" name="image" class="form-control mb-2">

        <button name="save" class="btn btn-success">Save</button>

    </form>
</div>

<?php include "../../footer.php"; ?>