<?php
session_start();
$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
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
    <div style=" display: flex; justify-content: right;">
        <img src="./images/close.svg" width="30px" height="30px" class="close-button" alt="">
    </div>
    <div class="product-menu-container hidden">


        <h1>Your Cart</h1>

        <div class="cart-list">
            <?php if (!empty($cartItems)) : ?>
                <?php foreach ($cartItems as $item) : ?>
                    <div class="cart-item" data-id="<?= htmlspecialchars($item['id']) ?>">
                        <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" class="product-image">
                        <div class="product-details">
                            <h3 class="product-name"><?= htmlspecialchars($item['name']) ?></h3>
                            <p class="product-price">$<?= number_format($item['price'], 2) ?></p>
                            <div class="quantity-controls">
                                <button class="decrease-quantity" onclick="updateCartItem(<?= htmlspecialchars($item['id']) ?>, 'decrease')">-</button>
                                <span class="quantity"><?= htmlspecialchars($item['quantity']) ?></span>
                                <button class="increase-quantity" onclick="updateCartItem(<?= htmlspecialchars($item['id']) ?>, 'increase')">+</button>
                            </div>
                        </div>
                        <button class="remove-item" onclick="removeCartItem(<?= htmlspecialchars($item['id']) ?>)">Remove</button>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="empty-cart">Your cart is empty.</p>
            <?php endif; ?>
        </div>

        <div class="cart-summary">
            <p id="total-quantity">Total Quantity: 0</p>
            <p id="total-price">Total Price: $0.00</p>
        </div>

        <button class="checkout-button">Checkout</button>
    </div>

    <script src="./js/productMenu.js"></script>
    <script src="./js/cardCRUD.js"></script>
</body>

</html>