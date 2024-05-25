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
  $od = $st->get_result(); // Changed get_results() to get_result()
} else {
  header("location: account.php");
  exit;
}
?>
 <?php include('./layouts/header.php');?>    
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
        <?php 
        if($os=="Not Paid"){?>
         <form action="" stye="float:right;">
            <input type="submit" value="Pay Now" class="btn btn-primary">
         </form>
        <?php }?>
   </section>
<?php include('./layouts/footer.php');?>
