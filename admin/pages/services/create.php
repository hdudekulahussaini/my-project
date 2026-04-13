<?php include "../../../config.php"; ?>

<?php
$count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM services"));

if ($count >= 6) {
    echo "<div style='margin:100px;'>Only 6 cards allowed</div>";
    exit;
}

if (isset($_POST['submit'])) {
    $icon = $_POST['icon'];
    $title = $_POST['title'];
    $desc = $_POST['description'];

    mysqli_query($conn, "INSERT INTO services(icon,title,description)
    VALUES('$icon','$title','$desc')");

    header("Location: index.php");
    exit;
}
?>
<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>

<div class="col-9 container mt-4">
<form method="POST">
    <input name="icon" 
           placeholder="Icon" 
           class="form-control mb-2" 
           required>
    <input name="title" 
           placeholder="Title" 
           class="form-control mb-2" 
           required>
    <textarea name="description" 
              placeholder="Description" 
              class="form-control mb-2" 
              required></textarea>
    <button name="submit" class="btn btn-success">Save</button>
</form>

</div>
<?php include "../../footer.php"; ?>