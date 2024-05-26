<?php
session_start();
if(empty($_SESSION['cart'])){
    header("location: index.php");
    exit;
}
?>
<?php include('./layouts/header.php');?>      
<section class="my-4 p-5">
    <div class="container text-center mt-3">
        <h1>Check Out</h1>

    </div>
    <div class="container">
        <form action="./server/place_order.php" method="POST" id="checkout-form">
            <p class="text-center text-primary"><?php if(isset($_GET['message'])){ echo $_GET['message'];} ?>
            <?php if(isset($_GET['message'])){ ?>
                <a href="login.php" class="btn btn-primary">Login</a>
            <?php }?>
            </p>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <p>Total amount: Rs.<?php echo $_SESSION['total'];?></p>
                <input type="submit" class="btn btn-primary" id="checkout-btn" value="Place Order" name="place_order">
            </div>
        </form>
    </div>
</section>
<?php include('./layouts/footer.php');?>
