<?php
include('connection.php');
$st= $conn->prepare("SELECT * from products where product_category='cloth' limit 4");
$st->execute();
$c_product= $st->get_result();
?>