<?php
header("Content-Type: application/json");

// Require the necessary files
require "classes/Product.php";

// Define the endpoints and the corresponding actions
$endpoints = [
    '/getProduct' => [
        'method' => 'GET',
        'function' => function () {
            $product = new Product("", "", "", "");
            $data = $product->getProductData();
            echo json_encode($data);
        }
    ],
    '/createProduct' => [
        'method' => 'POST',
        'function' => function () {
            $input = json_decode(file_get_contents("php://input"), true);

            if (isset($input['sku'], $input['name'], $input['price'], $input['productType'])) {
                // Sanitize and validate input data
                $sku = filter_var($input['sku'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $name = filter_var($input['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $price = filter_var($input['price'], FILTER_VALIDATE_FLOAT);
                $productType = filter_var($input['productType'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if ($sku !== false && $name !== false && $price !== false && $productType !== false) {
                    // Optional fields
                    $size = filter_var($input['size'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $weight = filter_var($input['weight'] ?? '', FILTER_VALIDATE_FLOAT);
                    $height = filter_var($input['height'] ?? '', FILTER_VALIDATE_FLOAT);
                    $width = filter_var($input['width'] ?? '', FILTER_VALIDATE_FLOAT);
                    $length = filter_var($input['length'] ?? '', FILTER_VALIDATE_FLOAT);
                    if ($input['productType'] == 'DVD') {
                        $newProduct = new DVD($sku, $name, $price, $productType, $size);
                    } elseif ($input['productType'] == 'Book') {
                        $newProduct = new Book($sku, $name, $price, $productType, $weight);
                    } elseif ($input['productType'] == 'Furniture') {
                        $newProduct = new Furniture($sku, $name, $price, $productType, $height, $width, $length);
                    } else {
                        // Handle invalid product type
                        echo json_encode(['success' => false, 'message' => 'Invalid product Type']);
                    }
                    // Create a new product instance and save it
                    $saved = $newProduct->save($sku, $name, $price, $productType, $size, $weight, $height, $width, $length);

                    echo json_encode($saved);
                    return;
                }
            }

            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid input data']);
        }
    ],
    '/deleteProduct' => [
        'method' => 'POST',
        'function' => function () {
            $input = json_decode(file_get_contents("php://input"), true);

            if (isset($input['sku'])) {
                $skus = (array) $input['sku'];
                $response = [];

                foreach ($skus as $sku) {
                    $product = new Product($sku, '', '', '');
                    $deletedProduct = $product->deleteProduct();
                    $response[] = $deletedProduct;
                }

                echo json_encode($response);
                return;
            }

            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid input data']);
        }
    ]
];

// Get the requested URI
$requestUri = $_SERVER['REQUEST_URI'];

// Split the URI into an array using the delimiter '/'
$uriParts = explode('/', $requestUri);

// Get the last element of the array
$requestUri ='/'.end($uriParts);

// Get the request method
$method = $_SERVER['REQUEST_METHOD'];

// Check if the endpoint and the method are valid
if (isset($endpoints[$requestUri])) {
    $data = $endpoints[$requestUri];
    if ($method === $data['method']) {
        $data['function']();
        return;
    }
}

?>
