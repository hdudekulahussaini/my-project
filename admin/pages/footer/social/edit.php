<?php include "../../../../config.php"; ?>

<?php
if(!isset($_GET['id'])){
    die("ID missing");
}

$id = $_GET['id'];

$res = mysqli_query($conn,"SELECT * FROM social_links WHERE id=$id");
$data = mysqli_fetch_assoc($res);

if(isset($_POST['update'])){
    $icon = $_POST['icon'];
    $link = $_POST['link'];

    mysqli_query($conn,"UPDATE social_links SET
    icon='$icon',
    link='$link'
    WHERE id=$id");

    header("Location:/admin/pages/footer/index.php");
    exit;
}
?>
<?php include "../../../header.php"; ?>
<?php include "../../../sidebar.php"; ?>
<div class="col-9 container mt-5">
<form method="POST">
<input name="icon" value="<?= $data['icon'] ?>"><br><br>
<input name="link" value="<?= $data['link'] ?>"><br><br>

<button name="update">Update</button>
</form>
</div>
<?php include "../../../footer.php"; ?>
