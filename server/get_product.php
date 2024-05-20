<?php
include('connection.php');
$st=$conn->prepare('SELECT * from products limit 4');
$st->execute();
$f_product=$st->get_result();
?>