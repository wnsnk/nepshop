<?php

session_start();
$connection = include('../../src/database.php');
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);


if ($method == 'POST') {
    $email = $input['email'];
    $password = password_hash($input['password'], PASSWORD_DEFAULT);

    $sql = "SELECT * FROM users WHERE email_address='$email'";
    error_log($sql);
    $query = mysqli_query($connection, $sql);
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        if (password_verify($input['password'], $row['password_'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $row['user_id_'];
            if ($row['is_admin']) {
                $_SESSION['is_admin'] = true;
            }
            echo json_encode(['succes' => true]);
        } else {
            echo json_encode(['succes' => false, 'error' => 'Password does not match.']);
        }
    } else {
        echo json_encode(['succes' => false, 'error' => 'E-mail does not exist in database.']);
    }

    mysqli_close($connection);
}
