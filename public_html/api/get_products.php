<?php

session_start();
$connection = include('../../src/database.php');
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);


$sql = "SELECT * FROM products";
error_log($sql);
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) > 0) {
    $products = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
    echo json_encode($products);
} else {
    echo json_encode(['succes' => false]);
}

mysqli_close($connection);
