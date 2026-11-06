<?php

$connection = include('../../src/database.php');
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);


if ($method == 'POST') {
    $email = $input['email'];
    $password = password_hash($input['password'], PASSWORD_DEFAULT);
    $postcode = $input['postcode'];
    $houseNumber = $input['house_number'];
    $streetName = $input['street_name'];
    $city = $input['city'];


    $sql = "INSERT INTO users(email_address, password_, postcode, house_number, street_name, city, is_admin) 
    VALUES ('$email', '$password', '$postcode', '$houseNumber', '$streetName', '$city', 0)";

    $query = mysqli_query($connection, $sql);
    if ($query) {
        echo json_encode(['succes' => true]);
    } else {
        echo json_encode(['succes' => false]);
        // response status 500?
    }

    mysqli_close($connection);
}
