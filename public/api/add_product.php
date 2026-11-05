<?php

use function PHPSTORM_META\type;

if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
    $connection = include('../../src/database.php');
} else {
    $connection = include('../src/database.php');
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['productName'];
    $description = $_POST['description'];
    $imgUrl = $_POST['imgUrl'];
    $sizeAmount = $_POST['sizeAmount'];
    $price = $_POST['price'];
    error_log('-------------------------------------');
    error_log($name);
    error_log($description);
    error_log($imgUrl);
    error_log($sizeAmount);
    error_log(gettype($sizeAmount));
    error_log($price);
    error_log('-------------------------------------');


    $sql = "INSERT INTO products(product_name, product_description, img_url, size_amount, product_price) 
            VALUES ('$name', '$description', '$imgUrl', '$sizeAmount', $price)";
    $query = mysqli_query($connection, $sql);
    if ($query) {
        error_log('yay');
        echo json_encode(['succes' => true]);
    } else {
        error_log('nay');
        echo json_encode(['succes' => false]);
        // response status 500?
    }

    mysqli_close($connection);
}
