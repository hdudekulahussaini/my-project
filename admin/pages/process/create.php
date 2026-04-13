<?php include "../../../config.php"; ?>

<?php
if (isset($_POST['save'])) {

    $title = $_POST['title'];
    $desc  = $_POST['description'];

    mysqli_query($conn, "INSERT INTO process_steps(title, description)
    VALUES('$title', '$desc')");

    header("Location: index.php");
    exit();
}
?>

<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>

<div class="col-9 p-4">

    <h4>Add Process Step</h4>

    <form method="POST">

        <label>Title</label>
        <input name="title" 
               class="form-control mb-2" 
               placeholder="Enter title"
               required>

        <label>Description</label>
        <textarea name="description" 
                  class="form-control mb-2" 
                  placeholder="Enter description"
                  required></textarea>

        <button name="save" class="btn btn-success">
            Save
        </button>

    </form>

</div>
<?php include "../../footer.php"; ?>

