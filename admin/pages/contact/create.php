<?php include "../../../config.php"; ?>

<?php
if (isset($_POST['save'])) {

    $name    = mysqli_real_escape_string($conn, $_POST['name']);
    $email   = mysqli_real_escape_string($conn, $_POST['email']);
    $phone   = mysqli_real_escape_string($conn, $_POST['phone']);
    $service = mysqli_real_escape_string($conn, $_POST['service']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    mysqli_query($conn, "INSERT INTO contacts(name,email,phone,service,message)
    VALUES('$name','$email','$phone','$service','$message')");

    header("Location: index.php");
    exit();
}
?>
<?php include "../../header.php"; ?>
<?php include "../../sidebar.php"; ?>
<div class="col-9 main-content">
    <form method="POST" class="container mt-4">
        <input type="text" name="name" class="form-control mb-2" placeholder="Full Name" required>
        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
        <input type="text" name="phone" class="form-control mb-2" placeholder="Phone">
        <input type="text" name="service" class="form-control mb-2" placeholder="Service">
        <textarea name="message" class="form-control mb-2" placeholder="Message" required></textarea>
        <button name="save" class="btn btn-success">Save</button>
    </form>
</div>

<?php include "../../footer.php"; ?>