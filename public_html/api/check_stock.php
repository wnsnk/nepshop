<?php

session_start();
$connection = include('../../src/database.php');
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);


$cart = $input['cart'];
$updatedCart = [];
$cartEdited = false;
error_log('checking each item');
foreach ($cart as $item) {
    $item = json_decode($item, true);
    $productId = $item['id'];
    $size = $item['size'];
    $amount = $item['amount'];
    error_log("$productId, $size, $amount");

    $sql = "SELECT * FROM products WHERE id = $productId";
    $result = mysqli_query($connection, $sql);
    // CHECK IF ID EXISTS
    if (mysqli_num_rows($result) > 0) {
        $products = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $products[] = $row;
        }
        $product = $products[0];
        $sizeAmount = json_decode($product['size_amount'], true);
        // CHECK IF SIZE EXISTS FOR ITEM
        if (array_key_exists($size, $sizeAmount)) {
            // CHECK IF WANTED AMOUNT <= DB AMOUNT 
            if ($amount <= $sizeAmount[$size]) {
                array_push($updatedCart, json_encode($item));
            } else if ($sizeAmount[$size] > 0) {
                $item['amount'] = $sizeAmount[$size];
                array_push($updatedCart, json_encode($item));
                $cartEdited = true;
                error_log('Not enough in stock but updated cart to max');
            } else {
                $cartEdited = true;
                error_log('Nothing in stock removed item');
            }
        } else {
            $cartEdited = true;
            error_log('Size does not exist. removed item');
        }
    } else {
        error_log('id does not exist. removed item');
        $cartEdited = true;
    }
}

if (!$cartEdited) {
    echo json_encode(['succes' => true]);
} else {
    echo json_encode(['succes' => false, 'updated_cart' => $updatedCart]);
}

mysqli_close($connection);
