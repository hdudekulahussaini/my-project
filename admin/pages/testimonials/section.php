<?php include "../../../config.php"; ?>

<?php
// GET DATA (ONLY 1 ROW)
$result = mysqli_query($conn, "SELECT * FROM testimonial_section LIMIT 1");
$data = mysqli_fetch_assoc($result);

// SAVE OR UPDATE
if(isset($_POST['save'])){

    $title = $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $description = $_POST['description'];

    if($data){
        // UPDATE
        mysqli_query($conn, "UPDATE testimonial_section SET
            title='$title',
            subtitle='$subtitle',
            description='$description'
            WHERE id=".$data['id']);
    } else {
        // INSERT FIRST TIME
        mysqli_query($conn, "INSERT INTO testimonial_section(title,subtitle,description)
        VALUES('$title','$subtitle','$description')");
    }

    header("Location: index.php");
    exit;
}
?>

<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>

<div class="col-9 container mt-4">
    <h3 class="mb-3">Edit Testimonial Section</h3>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" 
                   value="<?= $data['title'] ?? '' ?>" 
                   class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Subtitle</label>
            <input type="text" name="subtitle" 
                   value="<?= $data['subtitle'] ?? '' ?>" 
                   class="form-control">
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"><?= $data['description'] ?? '' ?></textarea>
        </div>
        <button name="save" class="btn btn-primary">
            Save Section
        </button>
    </form>
</div>

<?php include "../../footer.php"; ?>