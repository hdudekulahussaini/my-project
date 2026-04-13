<?php include "../../../config.php"; ?>

<?php
// CHECK IF DATA EXISTS
$check = mysqli_query($conn, "SELECT * FROM hero_section LIMIT 1");
$dataExists = mysqli_num_rows($check) > 0;

// BLOCK CREATE PAGE IF ALREADY EXISTS
if($dataExists){
    header("Location: index.php");
    exit();
}

// INSERT
if(isset($_POST['save'])){
    $title = $_POST['title'];
    $desc  = $_POST['description'];

    mysqli_query($conn, "INSERT INTO hero_section (title, description)
    VALUES ('$title', '$desc')");

    header("Location: index.php");
    exit();
}
?>

<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>

<div class="col-9 container-fluid">
    <div class="row">
        <div class="col-12 d-flex justify-content-center align-items-center vh-100">
            <div class="card shadow w-50">
                <div class="card-body">

                    <h4 class="text-center mb-4">Add Hero Section</h4>

                    <form method="POST">
                        <input type="text" name="title" class="form-control mb-3" placeholder="Title" required>
                        
                        <textarea name="description" class="form-control mb-3" placeholder="Description" required></textarea>

                        <button name="save" class="btn btn-success w-100">Save</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<?php include "../../footer.php"; ?>
