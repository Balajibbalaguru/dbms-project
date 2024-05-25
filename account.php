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
 <?php include('./layouts/header.php');?>    
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
                <input type="hidden" value="<?php echo $r['order_status']; ?>" name="order_status">
              <input type="hidden" value="<?php echo $r['order_id'];?>" name="order_id">
                <input type="submit" value="details" class="btn order-details-btn" name="order_details">
              </form>
             </td>
         </tr>
         <?php }?>
        </table>
   </section>
<?php include('./layouts/footer.php');?>