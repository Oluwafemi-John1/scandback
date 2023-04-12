<?php
require "classes/Product.php";
$product = new Product();
$data = $product->getProductData();
 echo json_encode($data);
?>
