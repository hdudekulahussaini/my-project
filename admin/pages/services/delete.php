<?php include "../../../config.php"; ?>

<?php
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM services WHERE id=$id");

header("Location: index.php");
?>