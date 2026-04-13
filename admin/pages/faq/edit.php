<?php include "../../../config.php"; ?>

<?php
if (!isset($_GET['id'])) {
    echo "ID missing";
    exit();
}

$id = intval($_GET['id']);

$res = mysqli_query($conn, "SELECT * FROM faqs WHERE id=$id");

if (mysqli_num_rows($res) == 0) {
    echo "No data";
    exit();
}

$data = mysqli_fetch_assoc($res);

if (isset($_POST['update'])) {
    mysqli_query($conn, "UPDATE faqs SET
    question='{$_POST['question']}',
    answer='{$_POST['answer']}'
    WHERE id=$id");

    header("Location:index.php");
    exit();
}
?>
<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>
<div class="col-9 container mt-5">
    <form method="POST">
        <input name="question" value="<?= $data['question'] ?>" class="form-control mb-2">
        <textarea name="answer" class="form-control mb-2"><?= $data['answer'] ?></textarea>
        <button name="update" class="btn btn-warning">Update</button>
    </form>
</div>
<?php include "../../footer.php"; ?>