<?php include "../../../config.php"; ?>

<?php
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM projects WHERE id=$id"));

if (isset($_POST['update'])) {

    $cat = $_POST['category'];
    $title = $_POST['title'];

    if (!empty($_FILES['image']['name'])) {
        $img = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "../../upload/" . $img);
        // move_uploaded_file($_FILES['image']['tmp_name'], "../../../upload/" . $img);
    } else {
        $img = $data['image'];
    }

    mysqli_query($conn, "UPDATE projects SET
    category='$cat',
    title='$title',
    image='$img'
    WHERE id=$id");

    header("Location:index.php");
}
?>
<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>
<div class=" col-9 container-fluid mt-5">
    <form method="POST" enctype="multipart/form-data">

        <input name="category" value="<?php echo $data['category']; ?>" class="form-control mb-2">

        <input name="title" value="<?php echo $data['title']; ?>" class="form-control mb-2">

        <!-- <img src="../../upload/ echo $data['image']; ?>" width="80"><br> -->
        <img src="../../upload/<?php echo $data['image']; ?>" width="80"><br>

        <input type="file" name="image" class="form-control mb-2">

        <button name="update" class="btn btn-primary">Update</button>

    </form>
</div>
<?php include "../../footer.php"; ?>