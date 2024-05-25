<?php 
include('./server/connection.php');
$st= $conn->prepare("SELECT * from products ");
$st->execute();
$products= $st->get_result();
?>
<?php include('./layouts/header.php');?>
      <section id="shop" class="mb-3 my-5 py-5">
        <div class="container ">
          <h3>Our Products</h3>
          <hr>
          <p>Here you can check out our Products</p>
        </div>
        <div class="row max-auto container">
          <?php while($r=$products->fetch_assoc()){?>
          <div onclick="window.location.href='single.php'" class="product text-center col-lg-3 col-md-4 col-sm-12">
            <img src="./assets/<?php echo $r['product_image']; ?>" alt="" class="img-fluid mb-3">
            <div class="star">
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
              <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name"><?php echo $r['product_name']; ?></h5>
            <h4 class="p-price"><?php echo $r['product_price']; ?></h4>
            <button class="buy-now"><a href="single.php?product_id=<?php  echo $r['product_id']; ?>">Buy Now</a></button>
          </div>
          <?php }?>
          <nav aria-label="page navigation example">
              <ul class="pagination mt-5">
                <li class="page-item"><a href="" class="page-link">Previous</a></li>
                <li class="page-item"><a href="" class="page-link">1</a></li>
                <li class="page-item"><a href="" class="page-link">2</a></li>
                <li class="page-item"><a href="" class="page-link">3</a></li>
                <li class="page-item"><a href="" class="page-link">Next</a></li>
              </ul>
          </nav>
        </div>
      </section>
<?php include('./layouts/footer.php');?>