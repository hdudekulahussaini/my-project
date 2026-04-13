<?php include "../../../config.php"; ?>

<?php
// CHECK ID
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    echo "Invalid ID";
    exit();
}

// FETCH DATA
$result = mysqli_query($conn, "SELECT * FROM services_section WHERE id=$id");

if (mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
} else {
    echo "No data found";
    exit();
}

// UPDATE
if (isset($_POST['update'])) {
    $subtitle = $_POST['subtitle'];
    $title = $_POST['title'];
    $desc = $_POST['description'];

    mysqli_query($conn, "UPDATE services_section SET 
        subtitle='$subtitle',
        title='$title',
        description='$desc'
        WHERE id=$id");

    header("Location: index.php");
    exit();
}
?>
<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>

<div class="col-9 container mt-4">
<form method="POST">

    <!-- SUBTITLE -->
    <div class="mb-3">
        <label class="form-label fw-bold">Subtitle</label>
        <input type="text" 
               name="subtitle" 
               value="<?php echo $data['subtitle']; ?>" 
               class="form-control"
               placeholder="Enter subtitle (e.g. Our Work)"
               required>
    </div>
    <!-- TITLE -->
    <div class="mb-3">
        <label class="form-label fw-bold">Title</label>
        <input type="text" 
               name="title" 
               value="<?php echo $data['title']; ?>" 
               class="form-control"
               placeholder="Enter main title (e.g. Featured Projects)"
               required>
    </div>
    <!-- DESCRIPTION -->
    <div class="mb-3">
        <label class="form-label fw-bold">Description</label>
        <textarea name="description" 
                  class="form-control"
                  rows="4"
                  placeholder="Enter description"
                  required><?php echo $data['description']; ?></textarea>
    </div>
    <!-- BUTTON -->
    <button name="update" class="btn btn-success w-100">
        Update Section
    </button>
</form>
</div>
