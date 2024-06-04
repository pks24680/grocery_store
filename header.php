<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GO GROCERY</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css" />
    <style>
        .navbar {
            background-color: #C3E6CB;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img src="assets/imgs/logo.jpg" alt="Online Grocery Store Logo" style="width: 50px;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">HOME</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownShop" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        SHOP BY CATEGORY
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownShop">
                            <li><a class="dropdown-item" href="frozen.php">FROZEN</a></li>
                            <li class="dropdown-submenu">
        <a class="dropdown-item dropdown-toggle" href="fresh.php">FRESH</a>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="fruitveg.php">Fruits & Vegetables</a></li>
            <li><a class="dropdown-item" href="dairy.php">Dairy</a></li>
            <li><a class="dropdown-item" href="meatfish.php">Meat & Fish</a></li>
        </ul>
    </li>

    <style>
    .dropdown-submenu:hover .dropdown-menu {
        display: block;
}
</style>

                            <li><a class="dropdown-item" href="beverages.php">BEVERAGES</a></li>
                            <li><a class="dropdown-item" href="home.php">HOME</a></li>
                            <li><a class="dropdown-item" href="pet-food.php">PET FOOD</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../about.php">ABOUT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../contact.php">CONTACT US</a>
                    </li>
                </ul>
                <!-- <form class="d-flex" role="search" style="padding-right: 10px;">
                    <input class="form-control me-2" type="search" placeholder="Search Beverages" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">
                        <span class="visually-hidden">Search</span>
                        <img src="assets/imgs/search-icon.jpg" alt="Search" style="width: 20px; height: 20px;">
                    </button>
                </form> -->
                <form class="d-flex" role="search" action="search.php" method="GET" style="padding-right: 10px;">
    <input class="form-control me-2" type="search" name="query" placeholder="Search Store" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">
        <span class="visually-hidden">Search</span>
        <img src="assets/imgs/search-icon.jpg" alt="Search" style="width: 21px; height: 21px;">
    </button>
</form>

                <a class="nav-link" href="cart.php">
                    <img src="./assets/imgs/cart.png" alt="Cart" style="width: 30px; height: 30px;">
                </a>
            </div>
        </div>
    </nav>