<?php include "../../../config.php"; ?>

<?php
if (isset($_POST['submit'])) {

    mysqli_query($conn, "INSERT INTO testimonials(name,role,message,rating)
    VALUES(
        '{$_POST['name']}',
        '{$_POST['role']}',
        '{$_POST['message']}',
        '{$_POST['rating']}'
    )");

    header("Location: index.php");
}
?>

<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>

<div class="col-9 container mt-4">

    <div class="card shadow border-0">
        <div class="card-body p-4">

            <h3 class="mb-4 fw-bold">Add Testimonial</h3>

            <form method="POST">

                <!-- NAME -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Client Name</label>
                    <input 
                        type="text" 
                        name="name" 
                        class="form-control" 
                        placeholder="Enter client name"
                        required
                    >
                </div>

                <!-- ROLE -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Role / Position</label>
                    <input 
                        type="text" 
                        name="role" 
                        class="form-control" 
                        placeholder="e.g. CEO, Developer"
                    >
                </div>

                <!-- MESSAGE -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Testimonial Message</label>
                    <textarea 
                        name="message" 
                        rows="4" 
                        class="form-control" 
                        placeholder="Write customer feedback..."
                        required
                    ></textarea>
                </div>

                <!-- RATING -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Rating</label>
                    <select name="rating" class="form-select">
                        <option value="5">⭐⭐⭐⭐⭐ (Excellent)</option>
                        <option value="4">⭐⭐⭐⭐ (Good)</option>
                        <option value="3">⭐⭐⭐ (Average)</option>
                        <option value="2">⭐⭐ (Poor)</option>
                        <option value="1">⭐ (Bad)</option>
                    </select>
                </div>

                <!-- BUTTON -->
                <div class="text-end">
                    <a href="index.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                    <button name="submit" class="btn btn-success px-4">
                        <i class="bi bi-save"></i> Save Testimonial
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

<?php include "../../footer.php"; ?>