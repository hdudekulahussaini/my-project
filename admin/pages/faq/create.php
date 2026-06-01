<?php include "../../../config.php"; ?>

<?php include "../../../config.php"; ?>

<?php
if (isset($_POST['save'])) {
    $q = $_POST['question'];
    $a = $_POST['answer'];

    mysqli_query($conn, "INSERT INTO faqs(question,answer) VALUES('$q','$a')");
    header("Location:index.php");
    exit();
}
?>
<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>
<div class="col-9 container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow border-0">

                <!-- HEADER -->
                <div class="card-header bg-primary text-white text-center">
                    <h5 class="mb-0">Add FAQ</h5>
                </div>

                <!-- BODY -->
                <div class="card-body p-4">

                    <form method="POST">

                        <!-- QUESTION -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Question</label>
                            <input type="text"
                                name="question"
                                class="form-control form-control-lg"
                                placeholder="Enter your question here"
                                required>
                        </div>

                        <!-- ANSWER -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Answer</label>
                            <textarea name="answer"
                                class="form-control"
                                rows="4"
                                placeholder="Write the answer here..."
                                required></textarea>
                        </div>

                        <!-- BUTTON -->
                        <div class="d-flex justify-content-between">

                            <a href="index.php" class="btn btn-secondary">
                                ← Back
                            </a>

                            <button name="save" class="btn btn-success">
                                Save FAQ
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>

</div>
<?php include "../../footer.php"; ?>