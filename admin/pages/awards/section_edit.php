<?php
include "../../../config.php";

// Fetch data safely
$result = mysqli_query($conn, "SELECT * FROM awards_section LIMIT 1");

if (!$result) {
    die("Select Error: " . mysqli_error($conn));
}

$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("No data found in awards_section table");
}

// Update logic
if (isset($_POST['update'])) {
    $subtitle = mysqli_real_escape_string($conn, $_POST['subtitle']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $update_query = "UPDATE awards_section SET
        subtitle='$subtitle',
        title='$title',
        description='$description'
        WHERE id=" . $data['id'];
    if (mysqli_query($conn, $update_query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Update Error: " . mysqli_error($conn);
    }
}
?>

<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>

<div class="col-9">
    <form method="POST" class="container mt-4">

        <input type="text" name="subtitle" value="<?php echo htmlspecialchars($data['subtitle']); ?>" class="form-control mb-2">

        <input type="text" name="title" value="<?php echo htmlspecialchars($data['title']); ?>" class="form-control mb-2">

        <textarea name="description" class="form-control mb-2"><?php echo htmlspecialchars($data['description']); ?></textarea>

        <button type="submit" name="update" class="btn btn-warning">Update</button>

    </form>
</div>