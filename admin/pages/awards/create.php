<?php include "../../../config.php"; ?>
<?php
if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $organization = $_POST['organization'];
    $year = $_POST['year'];
    mysqli_query($conn, "INSERT INTO awards_cards(title, organization, year)
    VALUES('$title','$organization','$year')");
    header("Location: index.php");
}
?>
<?php include "../../header.php"; ?>
<?php include "../../sidebar.php";?>
<div class="col-9 container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <!-- HEADER -->
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="mb-0">Add Award</h5>
                </div>
                <!-- BODY -->
                <div class="card-body">
                    <form method="POST">
                        <!-- TITLE -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Award Title</label>
                            <input type="text" name="title" class="form-control" placeholder="Enter award title" required>
                        </div>
                        <!-- ORGANIZATION -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Organization</label>
                            <input type="text" name="organization" class="form-control" placeholder="Enter organization" required>
                        </div>
                        <!-- YEAR -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Year</label>
                            <input type="text" name="year" class="form-control" placeholder="2025" required>
                        </div>
                        <!-- BUTTONS -->
                        <div class="d-flex justify-content-between">

                            <a href="index.php" class="btn btn-secondary">
                                ← Back
                            </a>
                            <button type="submit" name="submit" class="btn btn-success">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "../../footer.php"; ?>