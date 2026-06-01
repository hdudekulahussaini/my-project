<?php
include "../../../config.php";

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM counters WHERE id=$id");

header("Location: index.php");
?>