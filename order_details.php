<?php
include('./server/connection.php');
if (isset($_POST['order_details']) && isset($_POST['order_id'])) {
  $oid = $_POST['order_id'];
  $st = $conn->prepare("SELECT * FROM order_items WHERE order_id=?");
  $st->bind_param('i', $oid);
  $st->execute();
  $od = $st->get_result(); // Changed get_results() to get_result()
} else {
  header("location: account.php");
  exit;
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
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top bg-light py-0 shadow">
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
                <a class="nav-link" href="#">Contact</a>
              </li>
              <li class="nav-item d-flex">
                <i class="fa-solid fa-shopping-cart"></i>
                <i class="fa-solid fa-user"></i>
              </li>
            </ul>
          </div>
        </div>
    </nav>
    <section class="orders container my-2 py-5">
        <div class="container mt-2">
          <h2 class="font-weight-bolde text-center">Your Orders</h2>
          <hr>
        </div>
        <table class="mt-5 pt-5">
         <tr>
             <th>Product</th>
             <th>Price</th>
             <th>Quantity</th>
         </tr>
         <?php while ($r = $od->fetch_assoc()) { ?>
         <tr>
            <td>
              <div class="product-info">
                <img src="assets/<?php echo $r['product_image']; ?>" alt="">
                <div>
                  <p class="mt-3"><?php echo $r['product_name']; ?></p>
                </div>
              </div>
             </td>
             <td>
             <span><?php echo $r['product_price']; ?></span>
             </td>
             <td>
              <span><?php echo $r['product_quantity']; ?></span>
             </td>
             <td>
              <form action="order_details.php" method="POST">
                <input type="hidden" value="<?php echo $r['order_id']; ?>" name="order_id">
              </form>
             </td>
         </tr>
         <?php } ?>
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
             <p class="text">kamarajar Nagar, Tenkasi.</p>
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
