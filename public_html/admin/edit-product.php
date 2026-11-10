<?php

session_start();
$connection = include('../../src/database.php');
// header('Content-Type: application/json');

$productId = $_GET['product'];
$sql = "SELECT * FROM products WHERE id = '$productId'";
error_log($sql);
$result = mysqli_query($connection, $sql);
if (mysqli_num_rows($result) > 0) {
    $products = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
    $product = $products[0];
    $name = $product['product_name'];
    $description = $product['product_description'];
    $imgUrl = $product['img_url'];
    $sizes = $product['size_amount'];
    // $sizes = json_decode($sizes, true);
    error_log($sizes);

    $price = $product['product_price'];
} else {
    header("Location: /admin/edit-products.php?redirect=true");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name ?></title>
    <?php include('../../src/templates/bootstrap.html') ?>
</head>

<body data-bs-theme="dark">
    <?php include('../../src/templates/header.php') ?>
    <div class="container">
        <div id="warnings">

        </div>
        <h1>Bewerken van product: <?php echo $productId ?></h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="productId" value="<?php echo $productId ?>">
            <div class="mb-3">
                <label for="productName" class="form-label">Naam product</label>
                <input type="text" class="form-control" name="productName" id="productName" maxlength="50" value="<?php echo $name ?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Product Beschrijving</label>
                <textarea class="form-control" name="description" id="description" maxlength="500">
                    <?php echo $description ?>
                </textarea>
            </div>
            <div class="mb-3">
                <label for="imgUrl" class="form-label">Foto URL</label>
                <input type="url" name="imgUrl" class="form-control" id="imgUrl" maxlength="100" value="<?php echo $imgUrl ?>">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Prijs</label>
                <input type="number" step="0.01" name="price" class="form-control" id="price" value="<?php echo $price ?>">
            </div>
            <div class="mb-3 col">
                <label for="sizeAmount" class="form-label">Maten en voorraad (IN JSON)</label>
                <textarea class="form-control" name="sizeAmount" id="sizeAmount"><?php echo $sizes; ?></textarea>
            </div>
            <button type="submit" id="submit" class="btn btn-primary">Opslaan</button>
        </form>

    </div>
    <?php include('../../src/templates/footer.html') ?>
</body>

</html>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['productId'];
    $name = $_POST['productName'];
    $description = $_POST['description'];
    $imgUrl = $_POST['imgUrl'];
    $price = $_POST['price'];
    $sizes = $_POST['sizeAmount'];
    $sql = "UPDATE `products` SET `product_name` = '$name', `product_description` = '$description', `img_url` = '$imgUrl', `product_price` = $price, `size_amount` = '$sizes' WHERE `products`.`id` = $productId";
    mysqli_query($connection, $sql);
}
mysqli_close($connection);
