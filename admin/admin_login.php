<?php
session_start();
require('../server/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT admin_id, admin_email, admin_password FROM admins WHERE admin_email = ?");
    $stmt->bind_param('s', $email);

    if ($stmt->execute()) {
        $stmt->bind_result($admin_id, $admin_email, $admin_password);

        if ($stmt->fetch() && password_verify($password, $admin_password)) {
            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['admin_email'] = $admin_email;
            $_SESSION['admin_logged_in'] = true;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid email or password";
        }
    } else {
        $error = "Something went wrong";
    }
    $stmt->close();
}
?>

<?php include('head.php'); ?>

<div class="container mt-5 py-5">
    <h2 class="text-center mb-4">Admin Login</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="admin_login.php" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
                <?php } ?>
                <button type="submit" class="btn btn-primary w-100">Login</button>
                <div class="form-group text-center my-3">
                <a href="admin_register.php" id="register-url">Don't have an account? Register</a>
            </div>
            </form>
        </div>
    </div>
</div>

<?php include('../layouts/admin_footer.php'); ?>
