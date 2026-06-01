<?php include "../../../config.php"; ?>

<?php
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM project_section LIMIT 1"));

if (isset($_POST['save'])) {
    mysqli_query($conn, "UPDATE project_section SET
    subtitle='{$_POST['subtitle']}',
    title='{$_POST['title']}',
    description='{$_POST['description']}'
    WHERE id=" . $data['id']);

    header("Location:index.php");
}
?>
<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>
<div class=" col-9 container-fluid mt-5">
    <form method="POST">

        <input
            name="subtitle"
            value="<?php echo $data['subtitle']; ?>"
            placeholder="Enter subtitle"
            class="form-control mb-2">

        <input
            name="title"
            value="<?php echo $data['title']; ?>"
            placeholder="Enter title"
            class="form-control mb-2">

        <textarea
            name="description"
            placeholder="Enter description"
            class="form-control mb-2"><?php echo $data['description']; ?></textarea>

        <button name="save" class="btn btn-success">Update Section</button>

    </form>
</div>
<?php include "../../footer.php"; ?>