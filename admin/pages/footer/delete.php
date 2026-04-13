<?php include "../../../../config.php"; ?>

<?php
$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM social_links WHERE id=$id");

header("Location:../index.php");