<?php include "../../../config.php"; ?>

<?php
$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM faqs WHERE id=$id");

header("Location:index.php");