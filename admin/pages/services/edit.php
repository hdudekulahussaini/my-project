<?php include "../../../config.php"; ?>

<?php
// CHECK ID
if(isset($_GET['id'])){
    $id = intval($_GET['id']);
} else {
    echo "Invalid ID";
    exit();
}

// FETCH DATA
$result = mysqli_query($conn, "SELECT * FROM services WHERE id=$id");

if(mysqli_num_rows($result) > 0){
    $data = mysqli_fetch_assoc($result);
} else {
    echo "No data found";
    exit();
}

// UPDATE
if(isset($_POST['update'])){
    $icon = $_POST['icon'];
    $title = $_POST['title'];
    $desc = $_POST['description'];

    mysqli_query($conn, "UPDATE services SET 
        icon='$icon',
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

    <!-- ICON -->
    <div class="mb-3">
        <label class="form-label fw-bold">Icon Class</label>
        <input type="text" 
               name="icon" 
               value="<?php echo $data['icon']; ?>" 
               class="form-control"
               placeholder="Enter icon class (e.g. bi bi-house)"
               >
    </div>

    <!-- TITLE -->
    <div class="mb-3">
        <label class="form-label fw-bold">Service Title</label>
        <input type="text" 
               name="title" 
               value="<?php echo $data['title']; ?>" 
               class="form-control"
               placeholder="Enter service title"
               required>
    </div>

    <!-- DESCRIPTION -->
    <div class="mb-3">
        <label class="form-label fw-bold">Description</label>
        <textarea name="description" 
                  class="form-control"
                  rows="4"
                  placeholder="Enter service description"
                  required><?php echo $data['description']; ?></textarea>
    </div>

    <!-- BUTTON -->
    <button name="update" class="btn btn-primary w-100">
        Update Service
    </button>

</form>


</div>
<?php include "../../footer.php"; ?>