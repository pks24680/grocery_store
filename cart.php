<?php include('layouts/header_c.php'); ?>

<?php
function isCartEmpty() {
    return empty($_SESSION['cart']);
}

if (isset($_POST["add_to_cart"])){

    if(isset($_SESSION['cart'])){

        $products_array_ids = array_column($_SESSION['cart'],'product_id');
        if(in_array($_POST['product_id'], $products_array_ids)){

            $_SESSION['cart'][$_POST['product_id']]['product_quantity']++;
            echo '<script>alert("Quantity updated in cart");</script>';
      
    }
    else{
        $product_id = $_POST['product_id'];
            $product_name = $_POST['product_name'];
            $product_price = $_POST['product_price'];
            $product_image = $_POST['product_image'];
            $product_quantity = $_POST['product_quantity'];
     
            $product_array = array(
             'product_id' => $product_id,
             'product_name'=> $product_name,
             'product_price'=> $product_price,
             'product_image'=> $product_image,
             'product_quantity'=> $product_quantity
            );
     
            $_SESSION['cart'][$product_id] = $product_array;
    }
}
    else{
       $product_id = $_POST['product_id'];
       $product_name = $_POST['product_name'];
       $product_price = $_POST['product_price'];
       $product_image = $_POST['product_image'];
       $product_quantity = $_POST['product_quantity'];

       $product_array = array(
        'product_id' => $product_id,
        'product_name'=> $product_name,
        'product_price'=> $product_price,
        'product_image'=> $product_image,
        'product_quantity'=> $product_quantity
       );

       $_SESSION['cart'][$product_id] = $product_array; 

    }

    storeCartInCookie($_SESSION['cart']);

    calcTotal();

    

}

else if(isset($_POST['action']) && $_POST['action'] === 'remove_product'){


    $product_id_to_remove = $_POST['product_id_to_remove'];
    unset($_SESSION['cart'][$product_id_to_remove]);

    storeCartInCookie($_SESSION['cart']);

    calcTotal();
        
}

else if(isset($_POST['edit_quantity'])){

       $product_id = $_POST['product_id'];
       $product_quantity = $_POST['product_quantity'];

       $product_array = $_SESSION['cart'][$product_id];

       $product_array['product_quantity'] = $product_quantity;

       $_SESSION['cart'][$product_id] = $product_array;

       storeCartInCookie($_SESSION['cart']);

       calcTotal();
}

else if(isset($_POST['action']) && $_POST['action'] === 'clear_cart') {
    unset($_SESSION['cart']);
    storeCartInCookie(array());
    $_SESSION['$total'] = 0;
}

else{
    //echo("Couldn't process request");
}
function calcTotal(){

    $total = 0;
    foreach($_SESSION['cart'] as $key => $value){
        $product = $_SESSION['cart'][ $key ];

        $price = $product['product_price'];
        $quantity = $product['product_quantity'];

        $total = $total + ( $price * $quantity );
    }

    $_SESSION['$total'] = $total;

}

$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : getCartFromCookie();

?>

<?php
function storeCartInCookie($cartData) {
    $cartJson = json_encode($cartData);
    setcookie('cart', $cartJson, time() + (86400 * 30), "/");
}

function getCartFromCookie() {
    if(isset($_COOKIE['cart'])) {
        return json_decode($_COOKIE['cart'], true);
    } else {
        return array();
    }
}
$cartItems = getCartFromCookie();

?>



<section class="cart container my-5 py-5">
    <div class="container mt-5">
        <h2>Your Cart</h2>
        <hr>
    </div>
   
    <table class="mt-5 pt-5">
        <tr>
            <th>Product</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>

        <?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){ ?>
            <?php foreach($_SESSION['cart'] as $key => $value){ ?>
                <tr>
                    <td>
                        <div class="product-info">
                            <img src="<?php echo $value['product_image']; ?>"/>
                            <div>
                                <p><?php echo $value['product_name']; ?></p>
                                <small><span>$</span><?php echo $value['product_price']; ?></small>
                                <br>
                                <form method="POST" action="cart.php">
                                    <input type="hidden" name="action" value="remove_product" />
                                    <input type="hidden" name="product_id_to_remove" value="<?php echo $value['product_id']; ?>" />
                                    <input type="submit" class="btn btn-outline-danger" value= "Remove" />
                                </form>
                            </div>
                        </div>
                    </td>
                    <td>
                        <form method="POST" action="cart.php">
                            <input type="submit" name="edit_quantity" value="Edit" class="btn btn-outline-info"/>
                            <input type="number" value="<?php echo $value['product_quantity']; ?>" aria-label="quantity-in-cart" name = "product_quantity"/>
                            <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>" /> 
                        </form>
                    </td>
                    <td>
                        <span>$</span>
                        <span class="product-price"><?php echo $value['product_quantity'] * $value['product_price']; ?></span>
                    </td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="3">
                    <form method="POST" action="cart.php">
                        <input type="hidden" name="action" value="clear_cart" />
                        <button type="submit" class="btn btn-danger">Clear Cart</button>
                    </form>
                </td>
            </tr>
        <?php } else { ?>
            <tr>
                <td colspan="3">Your cart is empty.</td>
            </tr>
        <?php } ?>
    </table>

    <div class="cart-total">
        <table>
            <tr>
                <td>Total</td>
                <?php if(isset($_SESSION['cart'])){ ?>
                <td>$ <?php echo $_SESSION['$total']; ?> </td>
                <?php } ?>
            </tr>

        </table>
    </div>

    <div class="checkout-container">
        <form method="POST" action="checkout.php">
        <input type="submit" class="btn checkout-btn" value="Checkout" name="checkout" >
        </form>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="assets/js/script.js"></script>
<script>
    
    document.addEventListener("DOMContentLoaded", function() {
        var checkoutBtn = document.querySelector('.checkout-btn');

        function updateCheckoutBtnStatus() {
            checkoutBtn.disabled = <?php echo isCartEmpty() ? 'true' : 'false'; ?>;
        }

        updateCheckoutBtnStatus();

        
        window.addEventListener('cartUpdated', function() {
            updateCheckoutBtnStatus();
        });
    });
</script>
</body>
</html>
