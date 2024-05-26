<?php
include('connection.php');
$st= $conn->prepare("SELECT * from products where product_category='shoes' limit 4");
$st->execute();
$s_product= $st->get_result();
?>
