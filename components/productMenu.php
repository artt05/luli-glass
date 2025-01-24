<?php
// Existing logic to retrieve cart data from session
$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$storedTotalItems = isset($_SESSION['totalItems']) ? $_SESSION['totalItems'] : 0;
$storedTotalPrice = isset($_SESSION['totalPrice']) ? number_format($_SESSION['totalPrice'], 2) : '0.00';

// Include database connection (adjust path as needed)
require_once(__DIR__ . '/../db_connection/db_conn.php');

// Get the logged-in user ID
$userId = $_SESSION['user_id'] ?? null;

if ($userId) {
    // Fetch data from the database and merge with session-based cart items
    $query = "
        SELECT 
            od.product_id AS id,
            od.quantity,
            od.price,
            p.name AS name,
            p.image_url AS image
        FROM 
            order_details od
        JOIN 
            products p
        ON 
            od.product_id = p.id
        WHERE 
            od.userinfo_id = ?
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch cart items into an array
    while ($row = $result->fetch_assoc()) {
        $cartItems[$row['id']] = $row;
    }

    // Calculate total items and price
    $storedTotalItems = array_sum(array_column($cartItems, 'quantity'));
    $storedTotalPrice = number_format(array_sum(array_column($cartItems, 'price')), 2);
}
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
                        <img src="<?= htmlspecialchars($item['image'] ?? 'images/default-image.jpg') ?>"
                            alt="<?= htmlspecialchars($item['name'] ?? 'Unnamed Product') ?>"
                            class="product-image">

                        <div class="product-details">
                            <!-- Handle missing name -->
                            <h3 class="product-name"><?= htmlspecialchars($item['name'] ?? 'Unnamed Product') ?></h3>

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