<?php
session_start();
require('../server/connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO admins (admin_name, admin_email, admin_password) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $name, $email, $password);

    if ($stmt->execute()) {
        $_SESSION['admin_registered'] = true;
        header("Location: admin_login.php");
        exit();
    } else {
        $error = "Registration failed";
    }
    $stmt->close();
}
?>

<?php include('head.php'); ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Admin Signup</h2>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="admin_register.php" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
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
                <button type="submit" class="btn btn-primary">Signup</button>
            </form>
        </div>
    </div>
</div>

<?php include('../layouts/admin_footer.php'); ?>
