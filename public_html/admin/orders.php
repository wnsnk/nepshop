<!-- TODO FIX SIZES AND AMOUNTS -->

<?php

use function PHPSTORM_META\type;

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
    <title>Productbeheer</title>
    <?php include('../../src/templates/bootstrap.html') ?>
</head>

<body data-bs-theme="dark">
    <?php include('../../src/templates/header.php') ?>
    <div class="container">
        <h1>Productbeheer</h1>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Klant ID</th>
                    <th scope="col">Order</th>
                    <th scope="col">Totaal (zonder Verzendkosten)</th>
                    <th scope="col">Verzendkosten</th>
                    <th scope="col">Betaalmethode</th>
                    <th scope="col">Status</th>
                    <th scope="col">Datum</th>
                    <th scope="col">Bewerken/Verwijderen</th>
                </tr>
            </thead>
            <tbody id="products"></tbody>

        </table>
    </div>

    <?php include('../../src/templates/footer.html') ?>
</body>
<script type="module" src="javascript/orders.js"></script>

</html>


<?php
