<?php
session_start();
include('./server/connection.php');

if (isset($_POST['register'])) {
    $n = $_POST['name'];
    $e = $_POST['email'];
    $pass = $_POST['pass'];
    $cp = $_POST['cpass'];

    // Check if passwords match
    if ($pass != $cp) {
        header("Location: register.php?error=Passwords do not match");
        exit();
    }

    // Check if password length is at least 6 characters
    if (strlen($pass) < 6) {
        header("Location: register.php?error=Password should contain at least 6 characters");
        exit();
    }

    // Check if user already exists
    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE user_email = ?");
    $stmt->bind_param('s', $e);
    $stmt->execute();
    $stmt->bind_result($num_rows);
    $stmt->fetch();
    $stmt->close();

    if ($num_rows > 0) {
        header("Location: register.php?error=User already exists");
        exit();
    }

    // Insert new user into the database
    $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)");
    $hashed_pass = md5($pass); // MD5 is not recommended for password hashing; use password_hash instead
    $stmt->bind_param('sss', $n, $e, $hashed_pass);

    if ($stmt->execute()) {
        $uid=$st->$insert_id;
        $_SESSION['user_id']=$uid;
        $_SESSION['user_email'] = $e;
        $_SESSION['user_name'] = $n;
        $_SESSION['logged_in'] = true;
        $stmt->close();
        header("Location: account.php?register_sucsess=You registered successfully");
        exit();
    } else {
        $stmt->close();
        header("Location: register.php?error=Could not create an account at the moment");
        exit();
    }
}
else if(isset($_SESSION['logged_in'])){
  header("location: account.php ");
  exit;
}

?>

<?php include('./layouts/header.php');?>
<section class="my-1 py-1">
        <div class="container text-center mt-3 pt-5">
                <h1>Register</h1>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form action="register.php" id="register-form" method="POST">
                <p style="color:red;"><?php if(isset($_GET['error'])){ echo $_GET['error'];}?></p>
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                   </div>
               <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control" id="login-email" name="email" placeholder="Email" required>
               </div>
               <div class="form-group">
                <label for="">Password</label>
                <input type="password" class="form-control" id="login-password" name="pass" placeholder="Password" required>
               </div>
               <div class="form-group">
                <label for="">Confirm Password</label>
                <input type="password" class="form-control" id="login-email" name="cpass" placeholder="Confirm Password" required>
               </div>
               <div class="form-group">
                <input type="submit" class="btn" id="register-btn" value="Register" name="register">
               </div>
               <div class="form-group">
                <a href="login.php" id="register-url">Do you have an account? login</a>
               </div>
            </form>
        </div>
      </section>
<?php include('./layouts/footer.php');?>