<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['id'];

    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]); // Remove item from session
    }

    // Calculate total items and total price in the cart
    $totalItems = 0;
    $totalPrice = 0.0;
    foreach ($_SESSION['cart'] as $item) {
        $totalItems += $item['quantity']; // Sum of all quantities
        $totalPrice += $item['price']; // Sum of all product prices
    }

    // Update the session with new totals
    $_SESSION['totalItems'] = $totalItems;
    $_SESSION['totalPrice'] = $totalPrice;


    echo json_encode([
        'success' => true,
        'message' => 'Item removed successfully.',
        'totalItems' => $totalItems,
        'totalPrice' => number_format($totalPrice, 2), // Format price to 2 decimals
    ]);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Invalid request.']);
