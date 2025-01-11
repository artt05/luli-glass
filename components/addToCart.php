

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
            'price' => $productPrice
        ];
    } else {
        // Update the quantity of an existing product
        $_SESSION['cart'][$productId]['quantity'] += $productQuantity;
    }

    // Return the total items in the cart for real-time updates
    $totalItems = 0;
    foreach ($_SESSION['cart'] as $item) {
        $totalItems += $item['quantity'];
    }

    echo json_encode([
        'success' => true,
        'message' => 'Product added to cart.',
        'totalItems' => $totalItems
    ]);
    exit;
}
