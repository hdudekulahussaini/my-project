<?php include "../../../config.php"; ?>

<?php
// Get ID from URL
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $result = mysqli_query($conn, "SELECT * FROM awards_cards WHERE id = $id");
    $row = mysqli_fetch_assoc($result);
}

// Update data
if(isset($_POST['update'])){

    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $organization = trim($_POST['organization']);
    $year = trim($_POST['year']);

    if(!empty($title) && !empty($organization) && !empty($year)){

        $stmt = $conn->prepare("UPDATE awards_cards SET title=?, organization=?, year=? WHERE id=?");
        $stmt->bind_param("sssi", $title, $organization, $year, $id);

        if($stmt->execute()){
            header("Location: index.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "<div class='alert alert-danger'>All fields are required!</div>";
    }
}
?>

<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>
<div class="col-9 container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-header bg-warning text-dark text-center">
                    <h5 class="mb-0">Edit Award</h5>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <!-- TITLE -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Award Title</label>
                            <input type="text" name="title" class="form-control"
                                   value="<?php echo $row['title']; ?>" required>
                        </div>
                        <!-- ORGANIZATION -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Organization</label>
                            <input type="text" name="organization" class="form-control"
                                   value="<?php echo $row['organization']; ?>" required>
                        </div>
                        <!-- YEAR -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Year</label>
                            <input type="text" name="year" class="form-control"
                                   value="<?php echo $row['year']; ?>" required>
                        </div>
                        <!-- BUTTONS -->
                        <div class="d-flex justify-content-between">
                            <a href="index.php" class="btn btn-secondary">← Back</a>
                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "../../footer.php"; ?>