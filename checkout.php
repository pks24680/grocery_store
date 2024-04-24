<?php include('layouts/header_c.php'); ?>

<?php

if( !empty($_SESSION['cart']) && isset($_POST['checkout']) ){
    
}

else{
    echo '<script>alert("Cart is empty. Please add products first");</script>';

    echo '<script>setTimeout(function() { window.location.href = "index.php"; }, 0.0001);</script>';
    
}

?>





<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2>Check Out</h2>
        <hr class="mx-auto">
    </div>
   
    <div class="mx-auto container">
        <form id="checkout-form" action="server/place_order.php" method="POST">
            <div class="form-group checkout-small-element">
                <label>Name</label>
                <input type="text" class="form-control" id="checkout-name" name="name" placeholder="Name" required />
            </div>
            <div class="form-group checkout-small-element">
                <label>Email</label>
                <input type="email" class="form-control" id="checkout-email" name="email" placeholder="Email" required />
            </div>
            <div class="form-group checkout-small-element">
                <label>Phone</label>
                <input type="tel" class="form-control" id="checkout-phone" name="phone" placeholder="Mobile Number" required />
            </div>
            <div class="form-group checkout-small-element">
                <label>Address</label>
                <input type="text" class="form-control" id="checkout-address" name="address" placeholder="Address" required />
            </div>
            <div class="form-group checkout-small-element">
                <label>Street</label>
                <input type="text" class="form-control" id="checkout-street" name="street" placeholder="Street" required />
            </div>
            <div class="form-group checkout-small-element">
                <label>City/Suburb</label>
                <input type="text" class="form-control" id="checkout-city-suburb" name="city_suburb" placeholder="City/Suburb" required />
            </div>
            <div class="form-group checkout-small-element">
    <label>State</label>
    <select class="form-select" id="checkout-state" name="state" placeholder="State" required>
        <option value="" selected disabled>Select State</option>
        <option value="NSW">New South Wales (NSW)</option>
        <option value="VIC">Victoria (VIC)</option>
        <option value="QLD">Queensland (QLD)</option>
        <option value="WA">Western Australia (WA)</option>
        <option value="SA">South Australia (SA)</option>
        <option value="TAS">Tasmania (TAS)</option>
        <option value="ACT">Australian Capital Territory (ACT)</option>
        <option value="NT">Northern Territory (NT)</option>
    </select>
</div>

            <div class="form-group checkout-btn-container">
                <p>Total Amount: $ <?php echo $_SESSION['$total']; ?></p>
                <input type="submit" class="btn" id="checkout-btn" value="Place Order" name="place_order" disabled />
            </div>
        </form>

    </div>
     
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="assets/js/script.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var form = document.getElementById("checkout-form");
        var placeOrderBtn = document.getElementById("checkout-btn");

        function checkFormValidity() {
            var name = document.getElementById("checkout-name").value;
            var email = document.getElementById("checkout-email").value;
            var phone = document.getElementById("checkout-phone").value;
            var address = document.getElementById("checkout-address").value;
            var street = document.getElementById("checkout-street").value;
            var citySuburb = document.getElementById("checkout-city-suburb").value;
            var state = document.getElementById("checkout-state").value;

            if (name && email && phone && address && street && citySuburb && state) {
                placeOrderBtn.removeAttribute("disabled");
            } else {
                placeOrderBtn.setAttribute("disabled", "disabled");
            }
        }

        form.addEventListener("input", checkFormValidity);
        form.addEventListener("change", checkFormValidity);
    });
</script>

<script>
    document.getElementById("checkout-form").addEventListener("submit", function(event) {
        var phoneInput = document.getElementById("checkout-phone");
        var phone = phoneInput.value;
        var phonePattern = /^\d+$/;

        if (!phonePattern.test(phone) || phone.length < 10) {
            alert("Please enter a valid phone number with at least 10 digits.");
            phoneInput.focus();
            event.preventDefault();
        }
    });
</script>
</body>
</html>
