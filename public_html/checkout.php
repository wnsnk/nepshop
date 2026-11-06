<?php session_start();
if (!$_SESSION['logged_in']) {
    header('Location: /log-in.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afrekenen</title>
    <?php include('../src/templates/bootstrap.html') ?>
</head>

<body data-bs-theme="dark">
    <?php include('../src/templates/header.php') ?>

    <div class="container">
        <div class="warnings"></div>
        <h1>Controleer gegevens</h1>
        <div class="row">
            <div id="shippingInfo" class="col border rounded">
                <h2>Adresgegevens</h2>
                <h3>Emailadres:</h3>
                <p id="email">EMAIL</p>
                <h3>Klantnummer:</h3>
                <?php
                $user_id = $_SESSION['user_id'];
                echo "<p id='userId'>$user_id</p>";
                ?>
                <h3>Adres</h3>
                <p id="streetNameWithNum">straat 1</p>
                <p id="postcodeAndCity">1234AB AMSTERDAM</p>
            </div>
            <div id="cart" class="col border rounded">
                <h2>Winkelwagen</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Artikel</th>
                            <th scope="col">Maat</th>
                            <th scope="col">Hoeveelheid</th>
                            <th scope="col">Prijs</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th scope="col">Totaal:</th>
                            <th scope="col" id="totalDiffId"></th>
                            <th scope="col"></th>
                            <th scope="col" id="totalAmount"></th>
                            <th scope="col" id="totalPrice"></th>
                        </tr>
                        <tr>
                            <th scope="col">Verzendkosten:</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                            <th scope="col" id="shippingCost"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col border rounded">
                <h2>Selecteer betaalmethode</h2>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="paymentMethod1" value="Mydeal" checked>
                    <label class="form-check-label" for="paymentMethod1">
                        Mydeal
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="paymentMethod2" value="PalPay">
                    <label class="form-check-label" for="paymentMethod2">
                        PalPay
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="paymentMethod" id="paymentMethod3" value="Klorno">
                    <label class="form-check-label" for="paymentMethod3">
                        Klorno
                    </label>
                </div>

            </div>


        </div>
        <br>
        <div class="row">
            <div class="col">
                <h2>Totaal te betalen: €<span id="totalWithShipping"></span></h2>
            </div>
            <div class="col d-flex justify-content-end">
                <button id="checkoutBtn" class="btn btn-danger btn-lg">Afrekenen</button>
            </div>
        </div>
    </div>
    <?php include('../src/templates/footer.html') ?>

    <script type="module" src="javascript/checkout.js"></script>
</body>

</html>