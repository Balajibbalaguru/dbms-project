<?php 
include('./server/connection.php');
if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
  $page_no = $_GET['page_no'];
} else {
  $page_no = 1;
}

$st = $conn->prepare("SELECT count(*) as total_records from products");
$st->execute();
$st->bind_result($total_records);
$st->store_result();
$st->fetch();

$total_records_per_page = 4;
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adj = 2;
$total_no_of_pages = ceil($total_records / $total_records_per_page);

$st2 = $conn->prepare("SELECT * FROM products LIMIT ?, ?");
$st2->bind_param("ii", $offset, $total_records_per_page);
$st2->execute();
$products = $st2->get_result();
?>
<?php include('./layouts/header.php');?>
<section id="shop" class="mb-3 my-5 py-5">
  <div class="container">
    <h3 class="text-center">Our Products</h3>
    <br>
    <p class="text-center">Here you can check out our Products</p>
  </div>
  <div class="row mx-auto container">
    <?php while($r = $products->fetch_assoc()){?>
    <div onclick="window.location.href='single.php'" class="product text-center col-lg-3 col-md-4 col-sm-6 col-12">
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
      <button class="buy-now btn btn-primary"><a href="single.php?product_id=<?php echo $r['product_id']; ?>">Buy Now</a></button>
    </div>
    <?php }?>
    <nav aria-label="page navigation example" class="col-12">
      <ul class="pagination justify-content-center mt-5">
        <li class="page-item <?php if($page_no <= 1) echo 'disabled'; ?>">
          <a href="<?php if($page_no <= 1) echo '#'; else echo '?page_no='.($page_no-1); ?>" class="page-link">Previous</a>
        </li>
        <?php for($i = max(1, $page_no - $adj); $i <= min($page_no + $adj, $total_no_of_pages); $i++) { ?>
          <li class="page-item <?php if($page_no == $i) echo 'active'; ?>">
            <a href="?page_no=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
          </li>
        <?php } ?>
        <li class="page-item <?php if($page_no >= $total_no_of_pages) echo 'disabled'; ?>">
          <a href="<?php if($page_no >= $total_no_of_pages) echo '#'; else echo '?page_no='.($page_no+1); ?>" class="page-link">Next</a>
        </li>
      </ul>
    </nav>
  </div>
</section>
<?php include('./layouts/footer.php');?>
