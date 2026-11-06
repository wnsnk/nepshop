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
    <title>Add products</title>
    <?php include('../../src/templates/bootstrap.html') ?>
</head>

<body data-bs-theme="dark">
    <?php include('../../src/templates/header.php') ?>
    <div class="container">
        <h1>Nieuw product toevoegen</h1>
        <br>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="mb-3">
                <label for="productName" class="form-label">Naam product</label>
                <input type="text" class="form-control" name="productName" id="productName" maxlength="50">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Product Beschrijving</label>
                <textarea class="form-control" name="description" id="description" maxlength="500"></textarea>
            </div>
            <div class="mb-3">
                <label for="imgUrl" class="form-label">Foto URL</label>
                <input type="url" name="imgUrl" class="form-control" id="imgUrl" maxlength="100">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Prijs</label>
                <input type="number" step="0.01" name="price" class="form-control" id="price">
            </div>
            <div class="mb-3 col">
                <label for="sizeAmount" class="form-label">Maten en voorraad (IN JSON)</label>
                <input type="text" name="sizeAmount" class="form-control" id="sizeAmount" value='{"xxs":0,"xs":0,"s":0,"m":0,"l":0,"xl":0,"xxl":0}'>
            </div>
            <button type="submit" id="submit" class="btn btn-primary">Toevoegen</button>
        </form>
    </div>


    <?php include('../../src/templates/footer.html') ?>
</body>

</html>


<?php

include('api/add_product.php');
