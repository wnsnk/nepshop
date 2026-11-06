<?php

session_start();
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] && isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {;
} else {
    header('Location: /');
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php include('../../src/templates/bootstrap.html') ?>
</head>

<body data-bs-theme="dark">
    <?php include('../../src/templates/header.php') ?>
    <div class="container">
        <h1>Admin Dashboard</h1>
        <div class="row">
            <div class="col">
                <a href="/admin/add-product.php" class="btn btn-primary btn-lg">Producten Toevoegen</a>
            </div>
            <div class="col">
                <a href="/admin/edit-products.php" class="btn btn-primary btn-lg">Productbeheer</a>
            </div>
            <div class="col">
                <a href="/admin/.php" class="btn btn-primary btn-lg">Orderbeheer</a>
            </div>

        </div>
    </div>



    <?php include('../../src/templates/footer.html') ?>

</body>

</html>