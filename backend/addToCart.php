

<?php
session_start();

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['id'];
    $productName = $_POST['name'];
    $productQuantity = $_POST['quantity'];
    $productPrice = $_POST['price'];

    // Initialize the cart if not already set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Check if the product already exists in the cart
    if (!isset($_SESSION['cart'][$productId])) {
        // Add a new product
        $_SESSION['cart'][$productId] = [
            'id' => $productId,
            'name' => $productName,
            'quantity' => $productQuantity,
            'price' => $productPrice,

        ];
    } else {
        // Update the quantity of an existing product
        $_SESSION['cart'][$productId]['quantity'] += $productQuantity;
    }
    // Calculate the total items and total price in the cart
    $totalItems = 0;
    $totalPrice = 0.0;
    foreach ($_SESSION['cart'] as $item) {
        $totalItems += $item['quantity']; // Total quantity from all items
        $totalPrice += $item['price']; // Just add the price, no multiplication
    }

    // Store the calculated totals in the session
    $_SESSION['totalItems'] = $totalItems;
    $_SESSION['totalPrice'] = $totalPrice;

    // Return the total items and total price for real-time updates
    echo json_encode([
        'success' => true,
        'message' => 'Product added to cart.',
        'totalItems' => $totalItems,
        'totalPrice' => number_format($totalPrice, 2), // Format total price to 2 decimals
    ]);
    exit;
}
