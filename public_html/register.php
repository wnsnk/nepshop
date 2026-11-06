<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreer account</title>
    <?php include('../src/templates/bootstrap.html') ?>
</head>

<body data-bs-theme="dark">

    <?php include('../src/templates/header.php') ?>

    <div class="container" id="warnings"></div>

    <div class="d-flex align-items-center py-4 ">
        <div class="form-sign-in w-50 m-auto">
            <div data-np-autofill-form-type="login" data-np-watching="1">
                <h1 class=>Creëer een account!</h1>
                <div class="form-floating">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" data-np-checked="1" data-np-autofill-field-type="username">
                    <label for="floatingInput">Email adres</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword0" placeholder="Wachtwoord" data-np-checked="1" data-np-autofill-field-type="password">
                    <label for="floatingPassword0">Wachtwoord</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword1" placeholder="Wachtwoord" data-np-checked="1" data-np-autofill-field-type="password">
                    <label for="floatingPassword1">Herhaal je Wachtwoord</label>
                </div>
                <br>
                <h2>Adresgegevens</h2>
                <div class="form-floating">
                    <input type="text" class="form-control" id="postcode" placeholder="Postcode" data-np-checked="1" minlength="6" maxlength="6">
                    <label for="postcode">Postcode</label>
                </div>
                <div class="form-floating row">
                    <div class="col col-md-8">
                        <input type="text" class="form-control" id="houseNumber" placeholder="Huisnummer" data-np-checked="1">
                    </div>
                    <div class="col">
                        <button id="fillAddress" class="btn btn-secondary">Vul adres in.</button>
                    </div>

                </div>

                <div class="form-floating">
                    <input type="text" class="form-control" id="streetName" placeholder="Straatnaam" data-np-checked="1">
                    <label for="streetName">Straatnaam</label>
                </div>
                <div class="form-floating">
                    <input type="text" class="form-control" id="city" placeholder="Stad/dorp" data-np-checked="1">
                    <label for="city">Stad/dorp</label>
                </div>
                <br>
                <button id="registerBtn" class="btn btn-primary w-100 py-2">Registreer</button>
            </div>
        </div>
    </div>
    <?php include('../src/templates/footer.html') ?>

    <script type="module" src="javascript/register.js"></script>
</body>

</html>