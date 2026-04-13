<?php include "../../../config.php"; ?>

<?php
$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM testimonials WHERE id=$id"));

if (isset($_POST['update'])) {

    mysqli_query($conn, "UPDATE testimonials SET
        name='{$_POST['name']}',
        role='{$_POST['role']}',
        message='{$_POST['message']}',
        rating='{$_POST['rating']}'
        WHERE id=$id");

    header("Location: index.php");
}
?>

<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>

<div class="col-9 container mt-4">

    <div class="card shadow border-0">
        <div class="card-body p-4">

            <h3 class="mb-4 fw-bold">Edit Testimonial</h3>

            <form method="POST">

                <!-- NAME -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Client Name</label>
                    <input 
                        type="text" 
                        name="name" 
                        value="<?= $data['name'] ?>" 
                        class="form-control" 
                        placeholder="Enter client name"
                    >
                </div>

                <!-- ROLE -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Role / Position</label>
                    <input 
                        type="text" 
                        name="role" 
                        value="<?= $data['role'] ?>" 
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
                    ><?= $data['message'] ?></textarea>
                </div>

                <!-- RATING -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Rating</label>
                    <select name="rating" class="form-select">
                        <option value="5" <?= ($data['rating']==5)?'selected':''; ?>>⭐⭐⭐⭐⭐ (Excellent)</option>
                        <option value="4" <?= ($data['rating']==4)?'selected':''; ?>>⭐⭐⭐⭐ (Good)</option>
                        <option value="3" <?= ($data['rating']==3)?'selected':''; ?>>⭐⭐⭐ (Average)</option>
                        <option value="2" <?= ($data['rating']==2)?'selected':''; ?>>⭐⭐ (Poor)</option>
                        <option value="1" <?= ($data['rating']==1)?'selected':''; ?>>⭐ (Bad)</option>
                    </select>
                </div>

                <!-- BUTTON -->
                <div class="d-flex justify-content-between">

                    <a href="index.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>

                    <button name="update" class="btn btn-warning px-4">
                        <i class="bi bi-pencil-square"></i> Update
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

<?php include "../../footer.php"; ?>