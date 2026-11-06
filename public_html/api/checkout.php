<?php

session_start();
$connection = include('../../src/database.php');
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

if ($method === 'POST') {
    if (!$_SESSION['logged_in'] === true) {
        echo json_encode(['succes' => false, 'reason' => 'Not logged in']);
        return;
    }

    $user_id = $input['customerId'];

    $cart = $input['cart'];
    $cartEncoded = json_encode($cart);
    $totalAmount = $input['totalAmount'];
    // TODO CHECK IF TOTAL AMOUNT IS CORRECT IN PHP?
    $calcTotal = 0;
    $shippingCosts = $input['shippingCosts'];
    $paymentMethod = $input['paymentMethod'];

    $sql = "INSERT INTO orders(customer_id, items, total_amount, shipping_costs, payment_method) 
    VALUES ($user_id, '$cartEncoded', $totalAmount, $shippingCosts, '$paymentMethod')";
    error_log($sql);
    mysqli_query($connection, $sql);
    $orderId = mysqli_insert_id($connection);

    foreach ($cart as $item) {
        $item = json_decode($item, true);
        $productId = $item['id'];
        $size = $item['size'];
        $amount = $item['amount'];

        // UPDATE PRODUCTS TABLE
        $sql = "SELECT * FROM products WHERE id = $productId";
        $result = mysqli_query($connection, $sql);
        // CHECK IF ID EXISTS
        if (mysqli_num_rows($result) > 0) {
            $products = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $products[] = $row;
            }
            $product = $products[0];
            // UPDATE CALCTOTAL
            $calcTotal += ($product['product_price'] * $amount);
            $sizeAmount = json_decode($product['size_amount'], true);

            // CHECK IF SIZE EXISTS FOR ITEM
            if (array_key_exists($size, $sizeAmount)) {
                // CHECK IF WANTED AMOUNT <= DB AMOUNT 
                if ($amount <= $sizeAmount[$size]) {
                    $sizeAmount[$size] -= $amount;
                    $newSizeAmountJSON = json_encode($sizeAmount);
                    $sqlQuery = "UPDATE `products` SET `size_amount` = '$newSizeAmountJSON' WHERE `products`.`id` = $productId";
                    mysqli_query($connection, $sqlQuery);
                    error_log($sqlQuery);
                } else {
                    $sql = "UPDATE `orders` SET `status` = 'ERROR $productId at size $size has not enough in stock' WHERE `orders`.`order_id` = $orderId";
                    mysqli_query($connection, $sql);
                    echo json_encode(['succes' => false, 'reason' => "$productId at size $size has not enough in stock"]);
                    return;
                }
            } else {
                $sql = "UPDATE `orders` SET `status` = 'ERROR $productId size $size does not exist' WHERE `orders`.`order_id` = $orderId";
                mysqli_query($connection, $sql);
                echo json_encode(['succes' => false, 'reason' => 'Size does not exist']);
                return;
            }
        }
    }

    if ((float)$totalAmount === (float)$calcTotal) {
        $sql = "UPDATE `orders` SET `status` = 'SUCCES' WHERE `orders`.`order_id` = $orderId";
        mysqli_query($connection, $sql);
        echo json_encode(['succes' => true]);
    } else {
        $sql = "UPDATE `orders` SET `status` = 'ERROR TOTAL AMOUNT DOES NOT MATCH DB' WHERE `orders`.`order_id` = $orderId";
        mysqli_query($connection, $sql);
        echo json_encode(['succes' => false, 'reason' => 'Total amount does not match database prices.']);
    }

    mysqli_close($connection);
}
