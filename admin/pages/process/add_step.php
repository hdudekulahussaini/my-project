<?php include "../../../config.php"; ?>

<?php
if(isset($_POST['save'])){
    mysqli_query($conn, "INSERT INTO process_steps(step_no,title,description)
    VALUES('{$_POST['step_no']}','{$_POST['title']}','{$_POST['description']}')");
    header("Location: index.php");
    exit;
}
?>

<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>

<div class="col-9 container mt-5">
<h3>Add Step</h3>

<form method="POST">

<input name="step_no" class="form-control mb-2" placeholder="Step No">
<input name="title" class="form-control mb-2" placeholder="Title">
<textarea name="description" class="form-control mb-2"></textarea>

<button name="save" class="btn btn-success">Save</button>

</form>
</div>

<?php include "../../footer.php"; ?>