<?php session_start(); ?>

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Maru+Gothic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<header
    class="d-flex container flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
    <div class="col-md-3 mb-2 mb-md-0"> <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none zen-maru-gothic-regular">
            <h1>nepshop</h1>
        </a> </div>
    <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="/" class="nav-link px-2 link-secondary">Home</a></li>
        <li><a href="/products.php" class="nav-link px-2">Producten</a></li>
        <li><a href="/FAQs.php" class="nav-link px-2">FAQs</a></li>
        <li><a href="/about.php" class="nav-link px-2">Over ons</a></li>

    </ul>

    <div class="col-md-auto  text-end">
        <?php
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
            if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
                echo '<a href="/admin/dashboard.php" type="button" class="btn btn-primary me-2">Admin Dashboard</a>';
            }
            echo '<a href="/log-out.php" type="button" class="btn btn-outline-primary me-2">Uitloggen</a>';
        } else {
            echo '<a href="/log-in.php" type="button" class="btn btn-outline-primary me-2">Inloggen</a>';
            echo '<a href="/register.php" type="button" class="btn btn-primary">Registreren</a>';
        }
        ?>
        <a href="/cart.php" type='button' id="cartBtn" class="btn btn-primary theme-success" type="button" data-astro-cid-suf5bgbc="">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
            </svg> Winkelwagen
        </a>

    </div>

</header>