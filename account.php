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
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="text-center mt-3 p-1">
                    <p class="text-danger"><?php if(isset($_GET['register_success'])) {echo $_GET['register_success'];}?></p>
                    <p class="text-success"><?php if(isset($_GET['login_success'])) {echo $_GET['login_success'];}?></p>
                    <h3 class="font-weight-bold">Account Info</h3>
                    <br>
                    <div class="account-info">
                        <p><strong>Name:</strong> <?php if(isset($_SESSION['user_name'])){ echo $_SESSION['user_name'];}?></p>
                        <p><strong>Email:</strong> <?php if(isset($_SESSION['user_name'])){  echo $_SESSION['user_email'];}?></p>
                        <p><a href="#orders" id="order-btn" class="btn btn-primary">Your Orders</a></p>
                        <p><a href="account.php?loggout=1" id="logout-btn" class="btn btn-danger">Logout</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <form action="account.php" id="account-form" method="POST">
                    <p class="text-danger"><?php if(isset($_GET['error'])) {echo $_GET['error'];}?></p>
                    <p class="text-primary"><?php if(isset($_GET['message'])){ echo $_GET['message'];}?></p>
                    <h3 class="mb-4">Change Password</h3>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" id="pass" class="form-control" placeholder="Password" name="pass" required>
                    </div>
                    <div class="form-group">
                        <label for="cpass">Confirm Password</label>
                        <input type="password" id="cpass" class="form-control" placeholder="Confirm Password" name="cpass" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="change_pass" value="Change Password">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section class="orders my-5">
    <div class="container">
        <div class="text-center mt-2">
            <h2 class="font-weight-bold">Your Orders</h2>
            <br>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Cost</th>
                        <th>Order Status</th>
                        <th>Order Date</th>
                        <th>Order Info</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($r=$orders->fetch_assoc()){ ?>
                        <tr>
                            <td><?php echo $r['order_id'];?></td>
                            <td>Rs. <?php echo $r['order_cost'];?></td>
                            <td><?php echo $r['order_status'];?></td>
                            <td><?php echo date("F j, Y, g:i a", strtotime($r['order_date']));?></td>
                            <td>
                                <form action="order_details.php" method="POST">
                                    <input type="hidden" value="<?php echo $r['order_status']; ?>" name="order_status">
                                    <input type="hidden" value="<?php echo $r['order_id'];?>" name="order_id">
                                    <button type="submit" class="btn btn-primary" name="order_details">Details</button>
                                </form>
                            </td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php include('./layouts/footer.php');?>
