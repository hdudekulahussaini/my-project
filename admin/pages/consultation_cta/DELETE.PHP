DELETE.PHP
<?php
include "../../../config.php";

if(isset($_GET['id'])){
    $id = intval($_GET['id']);
    mysqli_query($conn, "DELETE FROM consultation_cta WHERE id=$id");
}

header("Location: index.php");
exit();