<?php
session_start();
if(isset($_POST['order_pay'])){
    $os=$_POST['order_status'];
    $otp=$_POST['total_order'];
}
?>
<?php include('./layouts/header.php'); ?>
    <section class="my-1 py-1">
        <div class="container text-center mt-3 pt-5">
                <h1>Payment</h1>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container text-center">
           <?php if(isset($_SESSION['total']) && $_SESSION['total']!=0){?>
           <p>Total Payment: Rs.<?php  echo $_SESSION['total'];?></p>
           <input type="submit" value="Pay Now" class="btn btn-danger">

          <?php } else if(isset($_POST['total'])&& $_POST['order_status'] =='Not Paid') {?>
            <p>Total payment:Rs.<?php echo $_POST['total_order_price'];?></p>
            <input type="submit" value="Pay Now" class="btn btn-danger">
        <?php } else{?>
            <p>you don't have any orders</p>
        <?php }?>
        </div>
      </section>
 <?php include('./layouts/footer.php'); ?>