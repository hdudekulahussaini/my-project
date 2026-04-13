<?php
session_start();
include "../config.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$id = $_SESSION['user_id'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id=$id"));

if (isset($_POST['update_email'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    mysqli_query($conn, "UPDATE users SET name='$name', email='$email' WHERE id=$id");
    $_SESSION['user_email'] = $email;

    $success = "Profile updated successfully!";
}

if (isset($_POST['update_password'])) {

    $old = $_POST['old_password'];
    $new = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    if (!password_verify($old, $user['password'])) {
        $error = "Old password is incorrect!";
    } elseif ($new != $confirm) {
        $error = "Passwords do not match!";
    } else {
        $new_pass = password_hash($new, PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE users SET password='$new_pass' WHERE id=$id");

        $success = "Password changed successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-body-tertiary">

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <!-- PROFILE CARD -->
            <div class="card shadow border-0 mb-4">
                <div class="card-body text-center">

                    <i class="bi bi-person-circle display-3 text-primary"></i>

                    <h4 class="mt-3 mb-1"><?= htmlspecialchars($user['name']) ?></h4>
                    <p class="text-muted"><?= htmlspecialchars($user['email']) ?></p>

                </div>
            </div>

            <!-- ALERT -->
            <?php if(!empty($success)) { ?>
                <div class="alert alert-success"><?= $success ?></div>
            <?php } ?>

            <?php if(!empty($error)) { ?>
                <div class="alert alert-danger"><?= $error ?></div>
            <?php } ?>

            <div class="row">

                <!-- UPDATE PROFILE -->
                <div class="col-md-6">
                    <div class="card shadow border-0 h-100">
                        <div class="card-header bg-primary text-white">
                            <i class="bi bi-pencil-square me-2"></i> Update Profile
                        </div>

                        <div class="card-body">

                            <form method="POST">

                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="name" 
                                        class="form-control"
                                        value="<?= htmlspecialchars($user['name']) ?>" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" 
                                        class="form-control"
                                        value="<?= htmlspecialchars($user['email']) ?>" required>
                                </div>

                                <button name="update_email" class="btn btn-primary w-100">
                                    Update
                                </button>

                            </form>

                        </div>
                    </div>
                </div>

                <!-- CHANGE PASSWORD -->
                <div class="col-md-6">
                    <div class="card shadow border-0 h-100">
                        <div class="card-header bg-warning text-dark">
                            <i class="bi bi-lock me-2"></i> Change Password
                        </div>

                        <div class="card-body">

                            <form method="POST">

                                <div class="mb-3">
                                    <label class="form-label">Old Password</label>
                                    <input type="password" name="old_password" 
                                        class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">New Password</label>
                                    <input type="password" name="new_password" 
                                        class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Confirm Password</label>
                                    <input type="password" name="confirm_password" 
                                        class="form-control" required>
                                </div>

                                <button name="update_password" class="btn btn-warning w-100">
                                    Change Password
                                </button>

                            </form>

                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
