<?php
require "classes/Product.php";
$product = new Product("","","","");
$data = $product->getProductData();
// print_r($data['result']);

// print_r($getAllProducts['result']);
 echo json_encode($data);
?>