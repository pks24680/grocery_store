<?php include('layouts/header.php'); ?>

    <div class="container mt-5">
        <h1 class="text-center">Fruit & Veg</h1>

        <!-- Category section -->
        <section id="category">
            <div class="container">
            <div class="row">
                    <?php
                        include('server/config.php');

                        $stmt = $config->prepare("SELECT * FROM products WHERE product_category = 'fruit and veg' LIMIT 10");
                        $stmt->execute();
                        $fruitveg = $stmt->get_result();

                        while ($row = $fruitveg->fetch_assoc()) {
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
            </div>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
