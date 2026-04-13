<?php include "../../../config.php"; ?>

<?php
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM process_section WHERE id=$id"));

if(isset($_POST['update'])){
    mysqli_query($conn,"UPDATE process_section SET
    subtitle='{$_POST['subtitle']}',
    title='{$_POST['title']}',
    description='{$_POST['description']}'
    WHERE id=$id");

    header("Location:index.php");
}
?>

<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>

<div class="col-9 p-4">

<h4>Edit Process Section</h4>

<form method="POST">

<label>Subtitle</label>
<input name="subtitle" value="<?= $data['subtitle'] ?>" class="form-control mb-2">

<label>Title</label>
<input name="title" value="<?= $data['title'] ?>" class="form-control mb-2">

<label>Description</label>
<textarea name="description" class="form-control mb-2"><?= $data['description'] ?></textarea>

<button name="update" class="btn btn-success">Update</button>

</form>

</div>

<?php include "../../footer.php"; ?>