<?php
include("../../../config.php");

if(isset($_GET['id']) && !empty($_GET['id'])){

    $id = mysqli_real_escape_string($conn, $_GET['id']);

    mysqli_query($conn, "DELETE FROM contact_content WHERE id='$id'");

    header("Location: index.php");
    exit();

} else {
    echo "Invalid ID";
}
?>