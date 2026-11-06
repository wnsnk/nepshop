<?php

session_start();
$connection = include('../src/database.php');
// header('Content-Type: application/json');

$productId = $_GET['product'];
$sql = "SELECT * FROM products WHERE id = '$productId'";
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
    $sizes = json_decode($sizes, true);

    $price = $product['product_price'];
} else {
    echo 'ERROR 404: page does not exist';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $name ?></title>
    <?php include('../src/templates/bootstrap.html') ?>
</head>

<body data-bs-theme="dark">
    <?php include('../src/templates/header.php') ?>
    <div class="container">
        <div id="warnings">

        </div>

        <div class="d-flex justify-content-center">
            <div class="card" style="width: 40vw;">
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <!-- TODO EDIT DB TO ADD MORE THAN 1 IMAGE -->
                            <?php
                            echo "<img src=$imgUrl class='d-block w-100'>"
                            ?>
                        </div>
                        <div class="carousel-item">
                            <?php
                            echo "<img src=$imgUrl class='d-block w-100'>"
                            ?>
                        </div>
                        <div class="carousel-item">
                            <?php
                            echo "<img src=$imgUrl class='d-block w-100'>"
                            ?>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <?php
                echo "<div class='card-body'>";
                echo "<h1 class='card-title' id='productName'> $name </h1>";
                echo "<h2> €<span id='price'>$price</span> </h2>";
                echo "<h3>Product ID: <span id='productId'> $productId </span></h3>";
                echo "<p class='card-text' id='productDescription'> $description </p>";
                ?>
                <div class="row">
                    <div id="radioSizes" class="btn-group col col-md-8" role="group">
                        <?php
                        foreach ($sizes as $size => $amount) {
                            if ($amount > 0) {
                                echo "<input type='radio' name='sizes' class='btn-check' id='$size' > ";
                                echo "<label class='btn btn-outline-primary' for='$size'>$size</label> ";
                            } else {
                                echo "<input type='radio' name='sizes' class='btn-check' id='$size' disabled > ";
                                echo "<label class='btn btn-outline-primary' for='$size'>$size</label> ";
                            }
                        }
                        ?>
                        <select id="amountSelect" class="form-select">
                            <option selected>Kies een maat!</option>

                        </select>

                    </div>
                    <div class="col cold-md-4 float-right">
                        <button id="addToCart" class='btn btn-primary'>Voeg toe aan winkelwagen</a>
                    </div>
                </div>




            </div>
        </div>

    </div>
    <?php include('../src/templates/footer.html') ?>

    <script type="module" src="javascript/product.js"></script>
</body>

</html>
<?php
mysqli_close($connection);
