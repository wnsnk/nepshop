<?php

session_start();
$connection = include('../../src/database.php');
header('Content-Type: application/json');

$productId = $_GET['product'];
$sql = "SELECT * FROM products WHERE id = '$productId'";
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) > 0) {
    $products = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
    $product = $products[0];
    $name = $product['product_name'];
    $description = $product['product_description'];
    $imgUrl = $product['img_url'];
    $sizes = $product['size_amount'];
    // $sizes = json_decode($sizes, true);
    $price = $product['product_price'];
    echo json_encode([
        'productId' => $productId,
        'productName' => $name,
        'description' => $description,
        'imgUrl' => $imgUrl,
        'sizeAmount' => $sizes,
        'price' => $price
    ]);
} else {
    echo json_encode(['succes' => false]);
}
