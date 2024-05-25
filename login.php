<?php
session_start();

// Include the connection file (assuming it's in the same directory)
require_once('./server/connection.php');
if(isset($_SESSION['logged_in'])==true){
  header("location: account.php");
}
// Check if the login form is submitted (using POST method)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Sanitize user input to prevent SQL injection
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $password = md5($_POST['pass']); // Use a more secure hashing algorithm later

  // Prepared statement to prevent SQL injection
  $stmt = $conn->prepare("SELECT user_id, user_name, user_email FROM users WHERE user_email = ? AND user_password = ?");
  $stmt->bind_param('ss', $email, $password);

  // Execute the prepared statement
  $stmt->execute();

  // Bind results safely
  $stmt->bind_result($user_id, $user_name, $user_email);

  // Check if a user record is found
  if ($stmt->fetch()) {
    // Successful login: Store user data in session
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_name'] = $user_name;
    $_SESSION['user_email'] = $user_email;
    $_SESSION['logged_in'] = true;

    // Redirect to account page with a success message
    header("location: account.php?message=logged+in+successfully");
    exit(); // Stop further script execution
  } else {
    // Failed login: Redirect with an error message
    header("location: login.php?error=invalid+credentials");
    exit();
  }

  // Close the prepared statement
  $stmt->close();
}

// Close the database connection (assuming it's not handled in connection.php)
$conn->close();
?>
 <?php include('./layouts/header.php');?>
      <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <div class="font-weight-bold">
                Login
            </div>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form action="login.php" id="login-form" method="POST">
              <p style="color:red;"><?php if(isset($_GET['error'])){ echo $_GET['error']; }?></p>
               <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control" id="login-email" name="email" placeholder="Email" required>
               </div>
               <div class="form-group">
                <label for="">Password</label>
                <input type="password" class="form-control" id="login-password" name="pass" placeholder="Password" required>
               </div>
               <div class="form-group">
                <input type="submit" class="btn" id="login-btn" value="login" name="login">
               </div>
               <div class="form-group">
                <a href="register.php" id="register-url">Don't have an account? Register</a>
               </div>
            </form>
        </div>
      </section>
<?php include('./layouts/footer.php');?>