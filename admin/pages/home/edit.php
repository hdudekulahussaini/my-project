<?php
include "../../../config.php";

// GET ID
if(isset($_GET['id'])){
    $id = intval($_GET['id']);

    $result = mysqli_query($conn, "SELECT * FROM hero_section WHERE id=$id");

    if(mysqli_num_rows($result) > 0){
        $data = mysqli_fetch_assoc($result);
    }else{
        echo "No Data Found!";
        exit();
    }

}else{
    echo "Invalid ID!";
    exit();
}

// UPDATE
if(isset($_POST['update'])){
    $title = $_POST['title'];
    $desc  = $_POST['description'];

    mysqli_query($conn, "UPDATE hero_section 
                         SET title='$title', description='$desc' 
                         WHERE id=$id");

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

                    <h4 class="text-center mb-4">Edit Hero Section</h4>

                    <form method="POST">

                        <input type="text"
                               name="title"
                               value="<?php echo $data['title']; ?>"
                               class="form-control mb-3"
                               required>

                        <textarea name="description"
                                  class="form-control mb-3"
                                  required><?php echo $data['description']; ?></textarea>

                        <button name="update" class="btn btn-primary w-100">
                            Update
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<?php include "../../footer.php"; ?>
