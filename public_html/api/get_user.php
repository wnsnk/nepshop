<?php
// HOW TO MAKE THIS SAFE????
session_start();
$connection = include('../../src/database.php');
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

if ($method == 'POST') {
    $id = $input['user_id'];

    $sql = "SELECT * FROM users WHERE user_id_=$id";
    $query = mysqli_query($connection, $sql);
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        echo json_encode([
            'user_id' => $row['user_id_'],
            'email_address' => $row['email_address'],
            'postcode' => $row['postcode'],
            'house_number' => $row['house_number'],
            'street_name' => $row['street_name'],
            'city' => $row['city'],
        ]);
    }
} else {
    echo json_encode(['succes' => false, 'error' => 'NO USER FOUND']);
}

mysqli_close($connection);
