<?php include "../../../../config.php"; ?>

<?php
$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM studio_hours WHERE id=$id");

header("Location:index.php");