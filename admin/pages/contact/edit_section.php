<?php include "../../../config.php"; ?>

<?php
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM contact_section LIMIT 1"));

if (isset($_POST['update'])) {
    mysqli_query($conn, "UPDATE contact_section SET
    subtitle='{$_POST['subtitle']}',
    title='{$_POST['title']}',
    description='{$_POST['description']}'
    WHERE id=" . $data['id']);

    header("Location:index.php");
}
?>
<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>
<div class="col-9 container-fluid">

    <form method="POST" class="p-4">

        <label>Subtitle</label>
        <input name="subtitle" value="<?= $data['subtitle'] ?>" class="form-control mb-2">

        <label>Title</label>
        <input name="title" value="<?= $data['title'] ?>" class="form-control mb-2">

        <label>Description</label>
        <textarea name="description" class="form-control mb-2"><?= $data['description'] ?></textarea>

        <button name="update" class="btn btn-success">Update</button>

    </form>
</div>
<?php include "../../footer.php"; ?>