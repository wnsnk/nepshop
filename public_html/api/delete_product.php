<?php

session_start();
$connection = include('../../src/database.php');
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);
$product_id = $input['id'];
error_log('------------------------------------');
error_log(json_encode($input));

if ($method == 'DELETE') {
    $sql = "DELETE FROM products WHERE `products`.`id` = $product_id";
    error_log($sql);
    $query = mysqli_query($connection, $sql);
}

echo json_encode(['succes' => true]);
