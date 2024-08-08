<?php
include 'components/connect.php';
session_start();

// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
    header('location:user_login.php');
    exit();
}

// Handle the order placement
if (isset($_POST['order'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $number = filter_var($_POST['number'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $method = filter_var($_POST['method'], FILTER_SANITIZE_STRING);
    $address = 'flat no. ' . $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ', ' . $_POST['country'];
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $total_products = $_POST['total_products'];
    $total_price = $_POST['total_price'];

    // Check if the cart is not empty
    $check_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
    $check_cart->execute([$user_id]);

    if ($check_cart->rowCount() > 0) {
        // Insert the order into the database
        $insert_order = $conn->prepare("INSERT INTO `orders` (user_id, name, number, email, method, address, total_products, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $insert_order->execute([$user_id, $name, $number, $email, $method, $address, $total_products, $total_price]);

        // Delete the cart items
        $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
        $delete_cart->execute([$user_id]);

        $message[] = 'Your order has been placed successfully!';
    } else {
        $message[] = 'Your cart is empty';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Font Awesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="checkout-orders">
    <div class="row">
        <div class="image">
        <img src="https://i.pinimg.com/564x/05/ff/0e/05ff0ec6987a1d40abc4b804ba21594c.jpg" alt="Checkout" width="300" height="600">
        </div>

        <form action="" method="POST">
            <h3>Your Orders</h3>
            <div class="display-orders">
                <?php
                $grand_total = 0;
                $cart_items = [];
                $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                $select_cart->execute([$user_id]);

                if ($select_cart->rowCount() > 0) {
                    while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
                        $cart_items[] = $fetch_cart['name'] . ' (' . $fetch_cart['price'] . ' x ' . $fetch_cart['quantity'] . ') - ';
                        $total_products = implode($cart_items);
                        $grand_total += ($fetch_cart['price'] * $fetch_cart['quantity']);
                        ?>
                        <p><?= $fetch_cart['name']; ?> <span>(<?= '$' . $fetch_cart['price'] . '/- x ' . $fetch_cart['quantity']; ?>)</span></p>
                        <?php
                    }
                } else {
                    echo '<p class="empty">Your cart is empty!</p>';
                }
                ?>
                <input type="hidden" name="total_products" value="<?= $total_products; ?>">
                <input type="hidden" name="total_price" value="<?= $grand_total; ?>">
                <div class="grand-total">Total : <span>$<?= $grand_total; ?>/-</span></div>
            </div>

            <h3>Place Your Orders</h3>
            <div class="flex">
                <div class="inputBox">
                    <span>Your Name :</span>
                    <input type="text" name="name" placeholder="Enter your name" class="box" maxlength="20" required>
                </div>
                <div class="inputBox">
                    <span> Number :</span>
                    <input type="number" name="number" placeholder="Enter your number" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
                </div>
                <div class="inputBox">
                    <span>Your Email :</span>
                    <input type="email" name="email" placeholder="Enter your email" class="box" maxlength="50" required>
                </div>
                <div class="inputBox">
                    <span>Payment Method :</span>
                    <select name="method" class="box" required>
                        <option value="cash on delivery">Cash on Delivery</option>
                        <option value="credit card">Credit Card</option>
                        <option value="paytm">Kpay</option>
                        <option value="paypal">PayPal</option>
                    </select>
                </div>
                <div class="inputBox">
                    <span>Address:</span>
                    <input type="text" name="flat" placeholder="e.g. flat number" class="box" maxlength="50" required>
                </div>
                <!-- <div class="inputBox">
                    <span>Address Line 02 :</span>
                    <input type="text" name="street" placeholder="e.g. street name" class="box" maxlength="50" required>
                </div> -->
                <div class="inputBox">
                    <span>City :</span>
                    <select name="city" class="box" required>
                        <option value="yangon">Yangon</option>
                        <option value="mandalay">Mandalay</option>
                        <option value="naypyidaw">Naypyidaw</option>
                        <option value="new_york">New York</option>
                        <option value="california">California</option>
                        <option value="texas">Texas</option>
                        <option value="florida">Florida</option>
                        <option value="illinois">Illinois</option>
                        <option value="pennsylvania">Pennsylvania</option>
                        <option value="ohio">Ohio</option>
                        <option value="georgia">Georgia</option>
                        <option value="north_carolina">North Carolina</option>
                        <option value="michigan">Michigan</option>
                        <option value="new_jersey">New Jersey</option>
                        <option value="virginia">Virginia</option>
                        <option value="washington">Washington</option>
                        <option value="arizona">Arizona</option>
                        <option value="massachusetts">Massachusetts</option>
                        <option value="tennessee">Tennessee</option>
                        <option value="indiana">Indiana</option>
                        <option value="missouri">Missouri</option>
                        <option value="maryland">Maryland</option>
                        <option value="wisconsin">Wisconsin</option>
                        <!-- Add more cities as needed -->
                    </select>
                </div>
                <div class="inputBox">
                    <span>State :</span>
                    <select name="state" class="box" required>
                        <option value="yangon state">Yangon State</option>
                        <option value="mandalay state">Mandalay State</option>
                        <option value="naypyidaw state">Naypyidaw State</option>
                        <option value="new_york">New York</option>
                        <option value="california">California</option>
                        <option value="texas">Texas</option>
                        <option value="florida">Florida</option>
                        <option value="illinois">Illinois</option>
                        <option value="pennsylvania">Pennsylvania</option>
                        <option value="ohio">Ohio</option>
                        <option value="georgia">Georgia</option>
                        <option value="north_carolina">North Carolina</option>
                        <option value="michigan">Michigan</option>
                        <option value="new_jersey">New Jersey</option>
                        <option value="virginia">Virginia</option>
                        <option value="washington">Washington</option>
                        <option value="arizona">Arizona</option>
                        <option value="massachusetts">Massachusetts</option>
                        <option value="tennessee">Tennessee</option>
                        <option value="indiana">Indiana</option>
                        <option value="missouri">Missouri</option>
                        <option value="maryland">Maryland</option>
                        <option value="wisconsin">Wisconsin</option>
                        <!-- Add more states as needed -->
                    </select>
                </div>
                <div class="inputBox">
                    <span>Country :</span>
                    <select name="country" class="box" required>
                        <option value="myanmar">Myanmar</option>
                        <option value="usa">USA</option>
                        <option value="uk">UK</option>
                        <option value="canada">Canada</option>
                        <option value="australia">Australia</option>
                        <option value="argentina">Argentina</option>
                        <option value="brazil">Brazil</option>
                        <option value="denmark">Denmark</option>
                        <option value="egypt">Egypt</option>
                        <option value="france">France</option>
                        <option value="germany">Germany</option>
                        <option value="hungary">Hungary</option>
                        <option value="india">India</option>
                        <option value="japan">Japan</option>
                        <option value="kenya">Kenya</option>
                        <option value="laos">Laos</option>
                        <option value="mexico">Mexico</option>
                        <option value="nepal">Nepal</option>
                        <option value="oman">Oman</option>
                        <option value="portugal">Portugal</option>
                        <option value="qatar">Qatar</option>
                        <option value="russia">Russia</option>
                        <option value="spain">Spain</option>
                        <option value="thailand">Thailand</option>
                        <!-- Add more countries as needed -->
                    </select>
                </div>
            </div>

            <input type="submit" name="order" class="btn <?= ($grand_total > 1) ? '' : 'disabled'; ?>" value="Place Order">
        </form>
    </div>
</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
