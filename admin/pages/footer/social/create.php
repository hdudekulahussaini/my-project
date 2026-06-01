<?php include "../../../../config.php"; ?>

<?php
$error = "";

if (isset($_POST['save'])) {
    $icon = $_POST['icon'];
    $link = $_POST['link'];

    // Check duplicate link
    $check = mysqli_query($conn, "SELECT * FROM social_links WHERE link='$link'");

    if (mysqli_num_rows($check) > 0) {
        $error = "This link already exists!";
    } else {
        mysqli_query($conn, "INSERT INTO social_links(icon,link)
        VALUES('$icon','$link')");

        header("Location:/admin/pages/footer/index.php");
        exit;
    }
}
?>

<?php include "../../../header.php"; ?>
<?php include "../../../sidebar.php"; ?>

<div class="col-9 container mt-5">

    <div class="card shadow-lg p-4">
        <h3 class="mb-4 text-center">Add Social Link</h3>

        <!-- ERROR MESSAGE -->
        <?php if (!empty($error)) { ?>
            <div class="alert alert-danger text-center w-75 mx-auto">
                <?php echo $error; ?>
            </div>
        <?php } ?>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label fw-semibold">Icon</label>
                <input type="text" name="icon" 
                       class="form-control form-control-lg"
                       placeholder="bi-instagram" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Link</label>
                <input type="text" name="link" 
                       class="form-control form-control-lg"
                       placeholder="https://example.com" required>
            </div>

            <div class="text-center mt-4">
                <button type="submit" name="save" class="btn btn-success btn-lg px-5">
                    Save
                </button>
                <a href="/admin/pages/footer/index.php" class="btn btn-secondary btn-lg ms-2">
                    Back
                </a>
            </div>

        </form>
    </div>

</div>

<?php include "../../../footer.php"; ?>