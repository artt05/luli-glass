<?php
// session_start(); 

$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$storedTotalItems = isset($_SESSION['totalItems']) ? $_SESSION['totalItems'] : 0;
$storedTotalPrice = isset($_SESSION['totalPrice']) ? number_format($_SESSION['totalPrice'], 2) : '0.00';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Menu</title>
    <link rel="stylesheet" href="css/productMenu.css">
</head>

<body>
    <div style="display: flex; justify-content: right;">
        <img src="./images/close.svg" width="30px" height="30px" class="close-button" alt="">
    </div>
    <div class="product-menu-container hidden">

        <h1>Your Cart</h1>

        <div class="cart-list">
            <?php if (!empty($cartItems)) : ?>
                <?php foreach ($cartItems as $item) : ?>
                    <div class="cart-item" data-id="<?= htmlspecialchars($item['id'] ?? '') ?>">
                        <!-- Handle missing image -->
                        <img src="<?= isset($item['image']) ? htmlspecialchars($item['image']) : 'default-image.jpg' ?>"
                            alt="<?= isset($item['name']) ? htmlspecialchars($item['name']) : 'Unnamed Product' ?>"
                            class="product-image">

                        <div class="product-details">
                            <!-- Handle missing name -->
                            <h3 class="product-name"><?= isset($item['name']) ? htmlspecialchars($item['name']) : 'Unnamed Product' ?></h3>

                            <!-- Handle price -->
                            <p class="product-price">$<?= number_format($item['price'] ?? 0, 2) ?></p>

                            <div class="quantity-controls">
                                <!-- Handle quantity -->
                                <span class="quantity">Quantity:&nbsp;<?= htmlspecialchars($item['quantity'] ?? 0) ?></span>
                            </div>
                        </div>

                        <!-- Remove button -->
                        <button class="remove-item"
                            onclick="removeCartItem(<?= htmlspecialchars($item['id'] ?? '') ?>)">Remove</button>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="empty-cart" style="<?= empty($cartItems) ? 'display: block;' : 'display: none;' ?>">Your cart is empty.</p>
            <?php endif; ?>
        </div>

        <div class="cart-summary">
            <p id="total-quantity">Total Quantity: <?= $storedTotalItems ?></p>
            <p id="total-price">Total Price: $<?= $storedTotalPrice ?></p>
        </div>

        <button class="checkout-button" onclick="redirectToCheckout()" <?= empty($cartItems) ? 'disabled' : '' ?>>Checkout</button>

    </div>

    <script src="./js/productMenu.js"></script>
    <script src="./js/cardCRUD.js"></script>
</body>

</html>