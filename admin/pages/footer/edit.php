<?php include "../../../config.php"; ?>

<?php
// ✅ CHECK ID
if (!isset($_GET['id'])) {
    die("ID missing");
}

$id = $_GET['id'];

// ✅ FETCH DATA
$res = mysqli_query($conn, "SELECT * FROM footer_content WHERE id=$id");
$data = mysqli_fetch_assoc($res);

// ✅ UPDATE
if (isset($_POST['update'])) {

    $logo_text = $_POST['logo_text'];
    $subtitle  = $_POST['subtitle'];
    $description = $_POST['description'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    mysqli_query($conn, "UPDATE footer_content SET
    logo_text='$logo_text',
    subtitle='$subtitle',
    description='$description',
    phone='$phone',
    email='$email',
    address='$address'
    WHERE id=$id");

    header("Location:/admin/pages/footer/index.php");
    exit;
}
?>

<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>

<div class="col-9 container mt-5">

    <div class="card shadow p-4">

        <h4 class="mb-3">Edit Footer Content</h4>

        <form method="POST">

            <!-- LOGO -->
            <label class="fw-bold">Logo Text</label>
            <input type="text" name="logo_text"
                value="<?= $data['logo_text'] ?>"
                class="form-control mb-3"
                placeholder="Enter Logo Text">

            <!-- SUBTITLE -->
            <label class="fw-bold">Subtitle</label>
            <input type="text" name="subtitle"
                value="<?= $data['subtitle'] ?>"
                class="form-control mb-3"
                placeholder="Enter Subtitle">

            <!-- DESCRIPTION -->
            <label class="fw-bold">Description</label>
            <textarea name="description"
                class="form-control mb-3"
                rows="3"
                placeholder="Enter Description"><?= $data['description'] ?></textarea>

            <!-- PHONE -->
            <label class="fw-bold">Phone</label>
            <input type="text" name="phone"
                value="<?= $data['phone'] ?>"
                class="form-control mb-3"
                placeholder="Enter Phone Number">

            <!-- EMAIL -->
            <label class="fw-bold">Email</label>
            <input type="email" name="email"
                value="<?= $data['email'] ?>"
                class="form-control mb-3"
                placeholder="Enter Email">

            <!-- ADDRESS -->
            <label class="fw-bold">Address</label>
            <textarea name="address"
                class="form-control mb-3"
                rows="2"
                placeholder="Enter Address"><?= $data['address'] ?></textarea>

            <!-- BUTTON -->
            <button name="update" class="btn btn-warning w-100">
                Update Footer
            </button>

        </form>

    </div>

</div>

<?php include "../../footer.php"; ?>