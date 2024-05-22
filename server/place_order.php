<?php 
session_start();
include("connection.php");

if(isset($_POST['place_order'])){

    $n = $_POST['name'];
    $e = $_POST['email'];
    $p = $_POST['phone'];
    $c = $_POST['city'];
    $ad = $_POST['address'];
    $oc = $_SESSION['total'];
    $os = "on_hold";
    $user_id = $_SESSION['user_id'];
    $od = date('Y-m-d H:i:s'); // Use 'Y' for four-digit year

    // Prepare the SQL statement with the correct parameter types
    $st = $conn->prepare("INSERT INTO orders (order_cost, order_status, user_id, user_phone, user_city, user_address, order_date) VALUES(?, ?, ?, ?, ?, ?, ?);");
    $st->bind_param('isissss', $oc, $os, $user_id, $p, $c, $ad, $od);
    $st->execute();

    // Get the last inserted ID
    $o_id = $st->insert_id;
     
    foreach($_SESSION['cart'] as $key => $val){
        $pd=$_SESSION['cart'][$key];
        $pid=$pd['product_id'];
        $pn=$pd['product_name'];
        $pi=$pd['product_image'];
        $pp=$pd['product_price'];
        $pq=$pd['product_quantity'];

        $st1=$conn->prepare("INSERT INTO order_items (order_id,product_id,product_name,product_image,product_price,product_quantity,user_id,order_date) VALUES(?,?,?,?,?,?,?,?)");
        $st1->bind_param('iissiiis',$o_id,$pid,$pn,$pi,$pp,$pq,$user_id,$od);
        $st1->execute();
    }
    

    //unset($_SESSION['cart']);

        header("location: ../payment.php?order_status='order placed successfully'");
}
?>
