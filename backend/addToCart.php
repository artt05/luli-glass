<?php
session_start();

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['id'];
    $productName = $_POST['name'];
    $productQuantity = $_POST['quantity'];
    $productPrice = $_POST['price'];
    $productImage = $_POST['image'];

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
            'price' => $productPrice, // Store price contribution for this addition
            'image' => $productImage, // Store the image URL
        ];
    } else {
        // Update the quantity of an existing product
        $_SESSION['cart'][$productId]['quantity'] += $productQuantity;

        // Add the new price contribution (based on the current addition)
        $_SESSION['cart'][$productId]['price'] += $productPrice;
    }

    // Get the updated quantity and total price for this specific product
    $updatedQuantity = $_SESSION['cart'][$productId]['quantity'];
    $updatedPrice = $_SESSION['cart'][$productId]['price']; // This sums up the incremental contributions

    // Calculate the total items and total price in the cart
    $totalItems = 0;
    $totalPrice = 0.0;
    foreach ($_SESSION['cart'] as $item) {
        $totalItems += $item['quantity']; // Total quantity from all items
        $totalPrice += $item['price']; // Directly sum the stored prices (no multiplication)
    }

    // Store the calculated totals in the session
    $_SESSION['totalItems'] = $totalItems;
    $_SESSION['totalPrice'] = $totalPrice;

    // Return the total items, total price, and updated quantity for real-time updates
    echo json_encode([
        'success' => true,
        'message' => 'Product added to cart.',
        'updatedQuantity' => $updatedQuantity, // Include the updated quantity
        'updatedPrice' => number_format($updatedPrice, 2), // Include the updated price (formatted)
        'totalItems' => $totalItems,
        'totalPrice' => number_format($totalPrice, 2), // Format total price to 2 decimals
    ]);
    exit;
}
