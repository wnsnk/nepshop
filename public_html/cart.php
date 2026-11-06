<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winkelwagen</title>
    <?php include('../src/templates/bootstrap.html') ?>
</head>

<body data-bs-theme="dark">
    <?php include('../src/templates/header.php') ?>

    <div class="container">
        <?php if (!$_SESSION['logged_in']) {
            echo '<div class="alert alert-warning" role="alert">Log in om af te rekenen!</div>';
        }
        ?>
        <div class="warnings">


        </div>
        <h1>Winkelwagen</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Artikel</th>
                    <th scope="col">Maat</th>
                    <th scope="col">Hoeveelheid</th>
                    <th scope="col">Prijs</th>
                    <th scope="col">Verwijderen</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
            <tfoot>
                <th scope="col">Totaal:</th>
                <th scope="col" id="totalDiffId"></th>
                <th scope="col"></th>
                <th scope="col" id="totalAmount"></th>
                <th scope="col" id="totalPrice"></th>
                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
                    echo '<th scope="col"><a id="checkout" class="btn btn-danger" href="/checkout.php">Afrekenen</a></th>';
                } else {
                    echo '<th scope="col"><button id="checkout" class="btn btn-danger" disabled>Afrekenen</button></th>';
                }
                ?>

            </tfoot>

        </table>


    </div>

    <?php include('../src/templates/footer.html') ?>
    <script type="module" src="javascript/cart.js"></script>
</body>

</html>