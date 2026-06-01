```php
<?php
include "../../../config.php";

if(isset($_GET['id'])){
    
    $id = intval($_GET['id']);

    mysqli_query($conn, "DELETE FROM hero_section WHERE id=$id");

    header("Location: index.php");
    exit();
}else{
    echo "Invalid ID!";
}
?>
