<?php include "../../../config.php"; ?>
<?php
if (isset($_POST['save'])) {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $btn1_text = mysqli_real_escape_string($conn, $_POST['btn1_text']);
    $btn1_link = mysqli_real_escape_string($conn, $_POST['btn1_link']);
    $btn2_text = mysqli_real_escape_string($conn, $_POST['btn2_text']);
    $btn2_link = mysqli_real_escape_string($conn, $_POST['btn2_link']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $insert = mysqli_query($conn, "INSERT INTO consultation_cta
    (title, description, btn1_text, btn1_link, btn2_text, btn2_link, status)
    VALUES
    ('$title', '$description', '$btn1_text', '$btn1_link', '$btn2_text', '$btn2_link', '$status')");

    if ($insert) {
        header("Location: index.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Insert failed: " . mysqli_error($conn) . "</div>";
    }
}
?>
<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>
<div class="col-9 container mt-4">
    <h3 class="mb-3">Add Consultation CTA</h3>

    <div class="card shadow p-4">
        <form method="POST">

            <label>Title</label>
            <input type="text" name="title" class="form-control mb-3" value="Ready to Transform Your Space?" required>

            <label>Description</label>
            <textarea name="description" class="form-control mb-3" rows="4" required>Schedule a complimentary consultation and let us bring your vision to life. Every extraordinary space begins with a conversation.</textarea>

            <label>Button 1 Text</label>
            <input type="text" name="btn1_text" class="form-control mb-3" value="Book Consultation" required>

            <label>Button 1 Link</label>
            <input type="text" name="btn1_link" class="form-control mb-3" value="#" required>

            <label>Button 2 Text</label>
            <input type="text" name="btn2_text" class="form-control mb-3" value="View Portfolio" required>

            <label>Button 2 Link</label>
            <input type="text" name="btn2_link" class="form-control mb-3" value="#" required>

            <label>Status</label>
            <select name="status" class="form-control mb-3">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>

            <button type="submit" name="save" class="btn btn-success">Save</button>
            <a href="index.php" class="btn btn-secondary">Back</a>

        </form>
    </div>
</div>

<?php include "../../footer.php"; ?>