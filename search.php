<?php
include('server/config.php');


if(isset($_GET['query'])) {
    $search_query = $_GET['query'];
    
    $stmt = $config->prepare("SELECT * FROM products WHERE product_name LIKE ? OR product_description LIKE ? OR product_category LIKE ?");
    $search_query = '%' . $search_query . '%';
    $stmt->bind_param('sss', $search_query, $search_query, $search_query);
    $stmt->execute();
    $search_results = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <?php include('layouts/header.php'); ?>

    <div class="container mt-5">
        <h1 class="text-center">Search Results</h1>

        <section id="category">
            <div class="container">
                <div class="row">
                <?php if(isset($search_results) && $search_results->num_rows > 0) {
    while ($row = $search_results->fetch_assoc()) { ?>
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
                                    <input type="number" name= "product_quantity" value="1" aria-label="buy-quantity"/>
                                    <button type="submit" class="btn btn-success" name="add_to_cart">Add to Cart</button>

                                </form>
                                </div>
                            </div>
                        </div>
<?php }
} else { ?>
    <div class="col-12">
        <p>No results found.</p>
    </div>
<?php } ?>
                </div>
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
