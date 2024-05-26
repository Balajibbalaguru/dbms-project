<?php
/*
order-status:
not paid
shipped
delivered
*/
include('./server/connection.php');
if (isset($_POST['order_details']) && isset($_POST['order_id'])) {
  $oid = $_POST['order_id'];
  $os=$_POST['order_status'];
  $st = $conn->prepare("SELECT * FROM order_items WHERE order_id=?");
  $st->bind_param('i', $oid);
  $st->execute();
  $od = $st->get_result();
  $tod= calorder($od); // Changed get_results() to get_result()
} else {
  header("location: account.php");
  exit;
}
function calorder($od){
  $total = 0;
  foreach($od as $r){
    $pp=$r['product_price'];
    $pq=$r['product_quantity'];
    $total+=($pp*$pq);
  }
  return $total;
}
 
?>
<?php include('./layouts/header.php');?>    
<section class="orders container my-5 py-5">
    <div class="container">
        <h2 class="font-weight-bold text-center mb-4">Your Orders</h2>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($od as $r) { ?>
                        <tr>
                            <td>
                                <div class="product-info d-flex align-items-center">
                                    <img src="assets/<?php echo $r['product_image']; ?>" alt="" class="mr-3" style="max-width: 100px;">
                                    <p class="mt-3"><?php echo $r['product_name']; ?></p>
                                </div>
                            </td>
                            <td><?php echo $r['product_price']; ?></td>
                            <td><?php echo $r['product_quantity']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php if($os=="Not Paid"){ ?>
            <div class="text-right">
                <form action="payment.php" method="POST">
                    <input type="hidden" value="<?php echo $tod; ?>" name="total_order_price">
                    <input type="hidden" name="order_status" value="<?php echo $os; ?>">
                    <button type="submit" class="btn btn-primary">Pay Now</button>
                </form>
            </div>
        <?php } ?>
    </div>
</section>
<?php include('./layouts/footer.php');?>
