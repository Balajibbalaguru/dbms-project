 <?php include('./layouts/header.php');?>
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
<?php include('./layouts/footer.php');?>