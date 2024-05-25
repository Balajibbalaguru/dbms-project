<?php
session_start();
if(!empty($_SESSION['cart'])&& isset($_POST['checkout'])){
       
}
else{
  header("location: index.php");
}
?>
 <?php include('./layouts/header.php');?>      
    <section class="my-1 py-1">
        <div class="container text-center mt-3 pt-5">
                <h1>Check Out</h1>
            <hr class="mx-auto">
        </div>
        <div class="mx-auto container">
            <form action="./server/place_order.php" method="POST" id="checkout-form">
                <div class="form-group checkout-sm-ele">
                    <label for="">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                   </div>
               <div class="form-group checkout-sm-ele">
                <label for="">Email</label>
                <input type="email" class="form-control" id="checkout-email" name="email" placeholder="Email" required>
               </div>
               <div class="form-group checkout-sm-ele">
                <label for="">Phone</label>
                <input type="tel" class="form-control" id="checkout-password" name="phone" placeholder="Password" required>
               </div>
               <div class="form-group checkout-sm-ele">
                <label for="">City</label>
                <input type="text" class="form-control" id="checkout-city" name="city" placeholder="Confirm Password" required>
               </div>
               <div class="form-group checkout-lg-ele">
                <label for="">Address</label>
                <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Email" required>
               </div>
               <div class="form-group checkout-btn-container">
                <p>
                  Total amount:Rs.<?php echo $_SESSION['total'];?>
                </p>
                <input type="submit" class="btn" id="checkout-btn" value="place order" name="place_order">
               </div>
            </form>
        </div>
      </section>
<?php include('./layouts/footer.php');?>