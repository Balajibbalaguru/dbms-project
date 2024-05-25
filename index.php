<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <title>Den</title>
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
                <a class="nav-link" aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="shop.php">Shop</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contactus.php">Contact Us</a>
              </li>
              <li class="nav-item">
                <a href="cart.php"><i class="fa-solid fa-shopping-cart"></i></a>
                <a href="account.php"><i class="fa-solid fa-user"></i></a>
              </li>
            <ul>
          </div>
        </div>
      </nav>
      <section id="home">
        <div class="container">
          <h5>New Arrivals</h5>
          <h1><span>Best Prices</span> This Season</h1>
          <p>Eshop offers the best products for the most affordable prices!</p>
          <button>Shop Now</button>
        </div>
      </section>
      <section id="brand" class="container mt-3 mb-3">
         <div class="row">
           <img src="./assets/brand1.jpg" alt="" class="img-fluid col-lg-3 col-m-6 col-sm-12">
           <img src="./assets/brand2.jpg" alt="" class="img-fluid col-lg-3 col-m-6 col-sm-12">
           <img src="./assets/brand3.jpg" alt="" class="img-fluid col-lg-3 col-m-6 col-sm-12">
           <img src="./assets/brand4.jpg" alt="" class="img-fluid col-lg-3 col-m-6 col-sm-12">
         </div>
      </section>
      <section id="new" class="w-100 container text-center">
        <div class="row p-0 m-0 ">
          <h1>OFFER ZONE</h1>
          <div class="one col-lg-4 col-md-12 col-sm-12 p-0 mt-3">
            <img src="./assets/shoes.png" alt="" class="img-fluid">
            <div class="details">
              <h2 class="head">Extremely Awesome Shoes</h2>
              <button >Shop Now</button>
            </div>
          </div>
          <div class="one col-lg-4 col-md-12 col-sm-12 p-0 mt-3">
            <img src="./assets/jacket.png" alt="" class="img-fluid">
            <div class="details">
              <h2 class="head">Awesome Jacket</h2>
              <button class="">Shop Now</button>
            </div>
          </div>
          <div class="one col-lg-4 col-md-12 col-sm-12 p-0 mt-3">
            <img src="./assets/watch.png" alt="" class="img-fluid">
            <div class="details">
              <h2 class="head">50% OFF Watches</h2>
              <button class="">Shop Now</button>
            </div>
          </div>
        </div>
      </section>
      <section id="featured" class="mb-3">
        <div class="container text-center">
          <h3>Our featured</h3>
          <hr>
          <p>Here you can check out our featured product</p>
        </div>
        <div class="row max-auto container-fluid">
          <?php
          include('./server/get_product.php');
          ?>
          <?php
          while($r=$f_product->fetch_assoc()){
          ?>
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img src="./assets/<?php echo $r['product_image'];?>" alt="" class="img-fluid mb-3">
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name"><?php echo $r['product_name'];?></h5>
            <h4 class="p-price"><?php echo $r['product_price'];?></h4>
            <a href="<?php echo 'single.php?product_id='.$r['product_id']?>"><button class="buy-now">Buy Now</button></a>
          </div>

          <?php }?>
        </div>
      </section>
      <section id="banner" class="my-5 py-5">
          <div class="container">
            <h4>MID SEASON'S SALE</h4>
            <h1>Autumn Collection <br> up to 305 off</h1>
            <button class="mt-4">Shop Now</button>
          </div>
      </section>
      <section id="cloths">
        <div class="container text-center">
          <h3>Dresses & Coats</h3>
          <hr>
          <p>Here you can check out amazing clothes</p>
        </div>
        <div class="row max-auto container-fluid">
          <?php include('./server/get_coats.php');?>
          <?php while($r=$c_product->fetch_assoc()){?>
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img src="./assets/<?php echo $r['product_image'];?>" alt="" class="img-fluid mb-3">
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name"><?php echo $r['product_name'];?></h5>
            <h4 class="p-price"><?php echo $r['product_price'];?></h4>
           <a href="<?php echo 'single.php?product_id='.$r['product_id']?>"><button class="buy-now">Buy Now</button></a> 
          </div>
          <?php }?>
        </div>
      </section>
      <section id="shoes">
        <div class="container text-center">
          <h3>Shoes</h3>
          <hr>
          <p>Here you can check out amazing shoes</p>
        </div>
        <div class="row max-auto container-fluid">
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img src="./assets/shoes.png" alt="" class="img-fluid mb-3">
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">Nike</h5>
            <h4 class="p-price">Rs.1800</h4>
            <button class="buy-now">Buy Now</button>
          </div>
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img src="./assets/watch.png" alt="" class="img-fluid mb-3">
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">Puma</h5>
            <h4 class="p-price">Rs.1800</h4>
            <button class="buy-now">Buy Now</button>
          </div>
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img src="./assets/jacket.png" alt="" class="img-fluid mb-3">
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">Addidas</h5>
            <h4 class="p-price">Rs.1800</h4>
            <button class="buy-now">Buy Now</button>
          </div>
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img src="./assets/jacket.png" alt="" class="img-fluid mb-3">
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">Campus</h5>
            <h4 class="p-price">Rs.1800</h4>
            <button class="buy-now">Buy Now</button>
          </div>
        </div>
      </section>
      <section id="watches">
        <div class="container text-center">
          <h3>Watches</h3>
          <hr>
          <p>Here you can check out amazing watches</p>
        </div>
        <div class="row max-auto container-fluid">
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img src="./assets/shoes.png" alt="" class="img-fluid mb-3">
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">Timex</h5>
            <h4 class="p-price">Rs.1800</h4>
            <button class="buy-now">Buy Now</button>
          </div>
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img src="./assets/watch.png" alt="" class="img-fluid mb-3">
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">Zoop</h5>
            <h4 class="p-price">Rs.1800</h4>
            <button class="buy-now">Buy Now</button>
          </div>
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img src="./assets/jacket.png" alt="" class="img-fluid mb-3">
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">Fossil</h5>
            <h4 class="p-price">Rs.1800</h4>
            <button class="buy-now">Buy Now</button>
          </div>
          <div class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img src="./assets/jacket.png" alt="" class="img-fluid mb-3">
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name">Titan</h5>
            <h4 class="p-price">Rs.1800</h4>
            <button class="buy-now">Buy Now</button>
          </div>
        </div>
      </section>
      <footer class="mt-5 pt-5">
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