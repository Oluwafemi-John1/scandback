<?php

require "classes/Product.php";

// Get the JSON data from the request body
$data = json_decode(file_get_contents("php://input"), true);

// Sanitize the input data
$sku = $_POST['sku'];
$name = $_POST['name'];
$price = $_POST['price'];
$productType = $_POST['productType'];
$size = $_POST['size'];
$weight = $_POST['weight'];
$height = $_POST['height'];
$width = $_POST['width'];
$length = $_POST['length'];
// Create a new product object
$product = new Product();

// Save the product and get the result
// $saved = $product->save($sku, $name, $price, $productType, $size, $weight, $height, $width, $length);

// Send the response as JSON
header("Content-Type: application/json");
echo json_encode($product->save());

?>
