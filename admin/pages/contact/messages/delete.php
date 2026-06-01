<?php include "../../../../config.php"; ?>

<?php
$id = $_GET['id'];
mysqli_query($conn,"DELETE FROM contact_messages WHERE id=$id");

header("Location:index.php");