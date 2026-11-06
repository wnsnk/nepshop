<?php

session_start();

$_SESSION['logged_in'] = false;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>uitgelogd!</title>
    <?php include('../src/templates/bootstrap.html'); ?>
</head>

<body data-bs-theme="dark">
    <?php include('../src/templates/header.php'); ?>
    <div class="container">
        <h1>Succesvol uitgelogd</h1>
        <p>Je wordt zo teruggestuurd...</p>
        <?php header('Location: /')  ?>
    </div>
    <?php include('../src/templates/footer.html') ?>
</body>

</html>