<?php include "../../../../config.php"; ?>

<?php
if(!isset($_GET['id'])){
    die("ID missing");
}

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM social_links WHERE id=$id");

header("Location:/admin/pages/footer/index.php");
exit;