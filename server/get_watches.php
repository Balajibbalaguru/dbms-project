<?php
include('connection.php');
$st= $conn->prepare("SELECT * from products where product_category='watches' limit 4");
$st->execute();
$w_product= $st->get_result();
?>
