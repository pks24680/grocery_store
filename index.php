<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Grocery Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css" integrity="sha384-BY+fdrpOd3gfeRvTSMT+VUZmA728cfF9Z2G42xpaRkUGu2i3DyzpTURDo5A6CaLK" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/9ad3344363.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css" />
</head>
<body>

    <nav id="navbar" class="navbar navbar-expand-lg fixed-top">
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
                        <a class="nav-link" href="about.php">ABOUT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">CONTACT US</a>
                    </li>
                </ul>
                <form class="d-flex" role="search" action="search.php" method="GET" style="padding-right: 10px;">
    <input class="form-control me-2" type="search" name="query" placeholder="Search Store" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">
        <span class="visually-hidden">Search</span>
        <img src="assets/imgs/search-icon.jpg" alt="Search" style="width: 20px; height: 20px;">
    </button>
</form>
                <a class="nav-link" href="cart.php">
                    <img src="./assets/imgs/cart.png" alt="Cart" style="width: 30px; height: 30px;">
                </a>
            </div>
        </div>
    </nav>

<div id="background-image">
    <section id="home" class="pt-5">
        <div class="container center-content">
            <div class="row align-items-center">
                <div class="col-md-6 text-center">
                    <h1>WELCOME TO GO GROCERY</h1>
                    <p class="lead">GET YOUR FRESH PRODUCE AND ESSENTIALS DELIVERED TO YOUR DOORSTEP.</p>
                    <a href="#" onclick="scrollToAllProducts()" class="btn btn-shopping-success btn-lg mt-4">START SHOPPING</a>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="container mt-5">
<h1 id="all-products" class="text-center">All Products</h1>

        <section id="category">
            <div class="container">
                <div class="row">
                    <?php
                        include('server/config.php');

                        $stmt = $config->prepare("SELECT * FROM products WHERE product_price >= 0 LIMIT 30");
                        $stmt->execute();
                        $all = $stmt->get_result();

                        while ($row = $all->fetch_assoc()) {
                            $button_class = $row['in_stock'] ? 'btn-outline-success' : 'btn-outline-secondary disabled';
                            $button_text = $row['in_stock'] ? 'Add to Cart' : 'Out of Stock';
                            $quantity_disabled = $row['in_stock'] ? '':'disabled';
                    ?>
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <img src="<?php echo $row['product_image']; ?>" class="card-img-top" alt="<?php echo $row['product_name']; ?>">
                                <div class="card-body">
                                <form method="POST" action="cart.php">
                                     <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>" />
                                     <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?>" />
                                     <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>" />
                                     <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>" />
                                    <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                                    <p class="card-text">Details: <?php echo $row['product_description']; ?></p>
                                    <p class="card-text">Price: $<?php echo $row['product_price']; ?></p>
                                    <p class="card-text">Unit: <?php echo $row['product_unit']; ?></p>
                                    <input type="number"  name= "product_quantity" value="1" aria-label="quantitycart" <?php echo $quantity_disabled; ?>/>

                    <button class="btn btn-success" type="submit" name="add_to_cart" <?php if(!$row['in_stock']) echo 'disabled'; ?>>
                    <?php echo $button_text; ?>
             </button>

                                </form>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
        </section>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="assets/js/script.js"></script>
<script>
window.addEventListener('scroll', function() {
    var navbar = document.getElementById('navbar');
    var allProductsSection = document.getElementById('all-products');
    var navbarHeight = navbar.offsetHeight;
    if (window.scrollY >= allProductsSection.offsetTop - navbarHeight) {
        navbar.style.backgroundColor = '#a7d7b2';
    }
    else{
        navbar.style.backgroundColor = 'transparent';
    }
});
</script>

<script>
function scrollToAllProducts() {
    var navbarHeight = document.getElementById('navbar').offsetHeight;
    var allProductsSection = document.getElementById('all-products');
    var offset = 10; 
    var targetScrollPosition = allProductsSection.offsetTop - navbarHeight - offset;
    window.scrollTo({
        top: targetScrollPosition,
        behavior: 'smooth'
    });
}
</script>


</body>
</html>
