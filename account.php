<?php
session_start();
include('./server/connection.php');
if(isset($_SESSION['logged_in'])==false){
  header('location: login.php');
}
if(isset($_GET['loggout'])){
         if(isset($_SESSION['logged_in'])){
          unset($_SESSION['logged_in']);
          unset($_SESSION['user_email']);
          unset($_SESSION['logged_name']);
          header("location: login.php");
          exit();
         }
}

if(isset($_POST['change_pass'])){
  $pass=$_POST['pass'];
  $cpass=$_POST['cpass'];
  if ($pass != $cpass) {
    header("Location: account.php?error=Passwords do not match");
    exit();
}

// Check if password length is at least 6 characters
 else if(strlen($pass) < 6) {
    header("Location: account.php?error=Password should contain at least 6 characters");
    exit();
}
else{
  $st=$conn->prepare("UPDATE users Set user_password=? where user_email=?");
  $ue=$_SESSION['user_email'];
  $st->bind_param('ss',password_hash($pass, PASSWORD_DEFAULT),$ue);
  if($st->execute()){
    header('location: account.php?message=password updated successfully');
  }
  else{
    header("location: account.php?error=password can't be channged");
  }
}
}
if(isset($_SESSION['logged_in'])){
  $uid=$_SESSION['user_id'];
  $st= $conn->prepare("SELECT * from orders where user_id=?");
  $st->bind_param('s',$uid);
$st->execute();
$orders= $st->get_result();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>User Account</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top bg-light py-2 shadow">
        <div class="container">
           <div>
            <img src="./assets/logo.jpg" alt="">
            <a class="navbar-brand" href="#">Navbar</a>
           </div>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse nav-btns" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Shop</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact Us</a>
              </li>
              <li class="nav-item">
                <i class="fa-solid fa-shopping-cart"></i>
                <i class="fa-solid fa-user"></i>
              </li>
            <ul>
          </div>
        </div>
    </nav>
    <section class="my-5 py-5">
         <div class="row container mx-auto">
            <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
            <p class="text-center" style="color:red;"><?php if(isset($_GET['register_success'])) {echo $_GET['register_success'];}?></p>
            <p class="text-center" style="color:green;"><?php if(isset($_GET['login_success'])) {echo $_GET['login_success'];}?></p>
                <h3 class="font-weight-bold">Account info</h3>
                <hr class="mx-auto">
                <div class="account-info">

                    <p>Name <span><?php if(isset($_SESSION['user_name'])){ echo $_SESSION['user_name'];}?></span></p>
                    <p>Email <span><?php if(isset($_SESSION['user_name'])){  echo $_SESSION['user_email'];}?></span></p>
                    <p><a href="#orders" id="order-btn">Your Orders</a></p>
                    <p><a href="account.php?loggout=1" id="logout-btn">Logout</a></p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-md-12">
                <form action="account.php" id="account-form" method="POST">
                  <p class="text-center" style="color:red;"><?php if(isset($_GET['error'])) {echo $_GET['error'];}?></p>
                  <p class="text-center" style="color: blue"><?php if(isset($_GET['message'])){ echo $_GET['message'];}?></p>
                    <h3>Change Password</h3>
                    <hr>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" id="pass" placeholder="Password" name="pass"  required>
                    </div>
                    <div class="form-group">
                        <label for="cpass">Confirm Password</label>
                        <input type="password" id="cpass" placeholder="Confirm Password" name="cpass"  required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn change-btn" name="change_pass" value="Change Password">
                    </div>
                </form>
            </div>
         </div>
    </section>
    <section class="orders container my-2 py-5">
        <div class="container mt-2">
          <h2 class="font-weight-bolde text-center">Your Orders</h2>
          <hr>
        </div>
        <table class="mt-5 pt-5">
         <tr>
             <th>Order ID</th>
             <th>Order Cost</th>
             <th>Order Status</th>
             <th>Order Date</th>
             <th>Order Info</th>
         </tr>
         <?php while($r=$orders->fetch_assoc()){ ?>
         <tr>
             <td>
             <span><?php echo $r['order_id'];?></span>
             </td>
             <td>
              <span><?php echo $r['order_cost'];?></span>
             </td>
             <td>
              <span><?php echo $r['order_status'];?></span>
             </td>
             <td>
                <span><?php echo $r['order_date'];?></span>
             </td>
             <td>
              <form action="order_details.php" method="POST">
              <input type="hidden" value="<?php echo $r['order_id'];?>" name="order_id">
                <input type="submit" value="details" class="btn order-details-btn" name="order_details">
              </form>
             </td>
         </tr>
         <?php }?>
        </table>
   </section>
    <footer class="mt-5 p-3">
        <div class="row container mx-auto">
           <div class="col-lg-3 col-md-6 col-sm-12">
              <img src="./assets/logo.jpg" alt="">
              <p class="pt-3 text">We provide the best product for the most affordable prices</p>
           </div>
           <div class="footer-one col-lg-3 col-md-6 col-sm-12">
             <h5 class="pb-2">Featured</h5>
             <ul class="">
               <li><a href="">Men</a></li>
               <li><a href="">Women</a></li>
               <li><a href="">Boys</a></li>
               <li><a href="">Girls</a></li>
               <li><a href="">New Arrivals</a></li>
               <li><a href="">Clothes</a></li>
             </ul>
          </div>
          <div class="footer-one col-lg-3 col-md-6 col-sm-12">
           <div class="pb-2 text">Contact Us</div>
           <div>
             <h6>Address</h6>
             <p class="text">kamarajar Nagar,Tenkasi.</p>
           </div>
           <div>
             <h6>Phone</h6>
             <p class="text">+91 044-562-2244</p>
           </div>
           <div>
             <h6>Email</h6>
             <p class="text">info@support.com</p>
           </div>
          </div>
          <div class="footer-one col-lg-3 col-md-6 col-sm-12">
             <h5 class="pb-2">Instagram</h5>
             <div class="row">
               <img src="./assets/footer1.jpg" alt="" class="img-fluid w-25 h-100 m-2">
               <img src="./assets/footer2.jpg" alt="" class="img-fluid w-25 h-100 m-2">
               <img src="./assets/footer3.jpg" alt="" class="img-fluid w-25 h-100 m-2">
               <img src="./assets/footer4.jpg" alt="" class="img-fluid w-25 h-100 m-2">
               <img src="./assets/footer5.jpg" alt="" class="img-fluid w-25 h-100 m-2">
             </div>
          </div>
        </div>
        <div class="copyright mt-5">
          <div class="row container mx-auto">
           <div class="col-lg-3 col-md-6 col-sm-12">
             <img src="./assets/pay.jpg" alt="">
           </div>
           <div class="col-lg-3 col-md-6 col-sm-12 text-nowrap mb-4 me-4">
             <p class="text">eCommerce &copy; 2024 All Right Reserved</p>
           </div>
           <div class="col-lg-3 col-md-6 col-sm-12">
             <a href="#"><i class="fab fa-facebook"></i></a>
             <a href="#"><i class="fab fa-instagram"></i></a>
             <a href="#"><i class="fab fa-twitter"></i></a>
           </div>
          </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>