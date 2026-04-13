<?php include "../../../config.php"; ?>


<?php
if (!isset($_GET['id'])) {
    die("ID not found");
}

$id = intval($_GET['id']);
$result = mysqli_query($conn, "SELECT * FROM consultation_cta WHERE id=$id");

if (!$result || mysqli_num_rows($result) == 0) {
    die("Data not found");
}

$data = mysqli_fetch_assoc($result);

if (isset($_POST['update'])) {

    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $btn1_text = mysqli_real_escape_string($conn, $_POST['btn1_text']);
    $btn1_link = mysqli_real_escape_string($conn, $_POST['btn1_link']);
    $btn2_text = mysqli_real_escape_string($conn, $_POST['btn2_text']);
    $btn2_link = mysqli_real_escape_string($conn, $_POST['btn2_link']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $update = mysqli_query($conn, "UPDATE consultation_cta SET
        title='$title',
        description='$description',
        btn1_text='$btn1_text',
        btn1_link='$btn1_link',
        btn2_text='$btn2_text',
        btn2_link='$btn2_link',
        status='$status'
        WHERE id=$id");

    if ($update) {
        header("Location: index.php");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Update failed: " . mysqli_error($conn) . "</div>";
    }
}
?>
<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>
<div class="col-9 container mt-4">
    <h3 class="mb-3">Edit Consultation CTA</h3>

    <div class="card shadow p-4">
        <form method="POST">

            <label>Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($data['title']); ?>" class="form-control mb-3" required>

            <label>Description</label>
            <textarea name="description" class="form-control mb-3" rows="4" required><?php echo htmlspecialchars($data['description']); ?></textarea>

            <label>Button 1 Text</label>
            <input type="text" name="btn1_text" value="<?php echo htmlspecialchars($data['btn1_text']); ?>" class="form-control mb-3" required>

            <label>Button 1 Link</label>
            <input type="text" name="btn1_link" value="<?php echo htmlspecialchars($data['btn1_link']); ?>" class="form-control mb-3" required>

            <label>Button 2 Text</label>
            <input type="text" name="btn2_text" value="<?php echo htmlspecialchars($data['btn2_text']); ?>" class="form-control mb-3" required>

            <label>Button 2 Link</label>
            <input type="text" name="btn2_link" value="<?php echo htmlspecialchars($data['btn2_link']); ?>" class="form-control mb-3" required>

            <label>Status</label>
            <select name="status" class="form-control mb-3">
                <option value="active" <?php if ($data['status'] == 'active') echo 'selected'; ?>>Active</option>
                <option value="inactive" <?php if ($data['status'] == 'inactive') echo 'selected'; ?>>Inactive</option>
            </select>

            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Back</a>

        </form>
    </div>
</div>

<?php include "../../footer.php"; ?>