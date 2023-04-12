<?php

require "classes/Product.php";

// Get the JSON data from the request body
$data = json_decode(file_get_contents("php://input"), true);

// Sanitize the input data
$sku = filter_var($data['sku'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$name = filter_var($data['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$price = filter_var($data['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$productType = filter_var($data['productType'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$size = filter_var($data['size'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$weight = filter_var($data['weight'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$height = filter_var($data['height'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$width = filter_var($data['width'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
$length = filter_var($data['length'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

// Create a new product object
$product = new Product($sku, $name, $price, $productType);

// Save the product and get the result
$saved = $product->save($sku, $name, $price, $productType, $size, $weight, $height, $width, $length);

// Send the response as JSON
header("Content-Type: application/json");
echo json_encode($data);

?>
