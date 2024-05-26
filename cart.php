<?php
session_start();

if(isset($_POST['cart'])){
    // If the cart is already set
    if(isset($_SESSION['cart'])){
        $pro_arr_ids = array_column($_SESSION['cart'], 'product_id');
        
        // Check if the product is already in the cart
        if(in_array($_POST['product_id'], $pro_arr_ids)){
            $pid = $_POST['product_id'];
            foreach ($_SESSION['cart'] as $key => $product) {
                if ($product['product_id'] == $pid) {
                    $_SESSION['cart'][$key]['product_quantity'] += $_POST['product_quantity'];
                }
            }
        } else {
            // Add a new product to the cart
            $pid = $_POST['product_id'];
            $par = array(
                'product_id' => $_POST['product_id'],
                'product_name' => $_POST['product_name'],
                'product_price' => $_POST['product_price'],
                'product_image' => $_POST['product_image'],
                'product_quantity' => $_POST['product_quantity']
            );
            $_SESSION['cart'][$pid] = $par; 
        }
    } else {
        // For the first product
        $pid = $_POST['product_id'];
        $par = array(
            'product_id' => $_POST['product_id'],
            'product_name' => $_POST['product_name'],
            'product_price' => $_POST['product_price'],
            'product_image' => $_POST['product_image'],
            'product_quantity' => $_POST['product_quantity']
        );
        $_SESSION['cart'][$pid] = $par;
    }
} elseif(isset($_POST['remove_product'])){
    $pid = $_POST['product_id'];
    foreach ($_SESSION['cart'] as $key => $product) {
        if ($product['product_id'] == $pid) {
            unset($_SESSION['cart'][$key]);
        }
    }
    // Re-index the array to prevent holes
    $_SESSION['cart'] = array_values($_SESSION['cart']);
} elseif(isset($_POST['edit_quantity'])){
    $pr = $_POST['product_quantity'];
    $pid = $_POST['product_id'];
    foreach ($_SESSION['cart'] as $key => $product) {
        if ($product['product_id'] == $pid) {
            $_SESSION['cart'][$key]['product_quantity'] = $pr;
        }
    }
}

function calcart(){
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach($_SESSION['cart'] as $product){
            $pr = $product['product_price'];
            $q = $product['product_quantity'];
            $total += $pr * $q;
        }
    }
    $_SESSION['total'] = $total;
    return $total;
}

$total = calcart();
?>
<?php include('./layouts/header.php'); ?>
<section class="cart container my-5 py-5">
    <div class="container">
        <h2 class="font-weight-bold text-center">Your Cart</h2>
    <br>
    </div>
    <div class="table-responsive mt-5 pt-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col" class="text-black">Product</th>
                    <th scope="col" class="text-black">Quantity</th>
                    <th scope="col" class="text-black">Subtotal</th>
                    <th scope="col" class="text-black">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $product) { ?>
                        <tr>
                            <td>
                                <div class="product-info d-flex align-items-center">
                                    <img src="assets/<?php echo $product['product_image']; ?>" alt="" class="mr-3" style="max-width: 100px;">
                                    <div>
                                        <p><?php echo $product['product_name']; ?></p>
                                        <small><span>Rs.</span><?php echo $product['product_price']; ?></small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <form action="cart.php" method="POST" class="d-flex align-items-center">
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                    <input type="number" name="product_quantity" value="<?php echo $product['product_quantity']; ?>" min="1" class="adjs">
                                    <input type="submit" class="btn btn-primary btn-sm" value="Edit" name="edit_quantity">
                                </form>
                            </td>
                            <td>
                                <span>Rs.</span>
                                <span class="price"><?php echo $product['product_quantity'] * $product['product_price']; ?></span>
                            </td>
                            <td>
                                <form action="cart.php" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                    <input type="submit" name="remove_product" class="btn btn-danger btn-sm" value="Remove">
                                </form>
                            </td>
                        </tr>
                    <?php }
                } else { ?>
                    <tr>
                        <td colspan="4" class="text-center">Your cart is empty</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) { ?>
        <div class="total text-center mt-4">
            <h4>Total: Rs.<?php echo $total; ?></h4>
        </div>
        <div class="checkout-container text-center mt-3">
             <form action="checkout.php" method="POST">
                <input type="submit" class="btn btn-primary" value="Checkout" name="checkout">
             </form>
        </div>
    <?php } ?>
</section>
<?php include('./layouts/footer.php'); ?>
