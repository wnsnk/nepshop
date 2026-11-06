<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <?php include('../src/templates/bootstrap.html') ?>
    <link rel="stylesheet" href="/css/styles.css">
</head>

<body data-bs-theme="dark">
    <?php include('../src/templates/header.php') ?>
    <div class="container" style="width: 70%;">
        <?php include('../src/templates/index_main_carousel.html') ?>
        <?php include('../src/templates/item_carousel.html') ?>
    </div>

    <?php include('../src/templates/footer.html') ?>
</body>

</html>
<?php
