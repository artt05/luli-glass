<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['id'];

    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]); // Remove item from session
    }

    // Calculate total items in the cart
    $totalItems = 0;
    foreach ($_SESSION['cart'] as $item) {
        $totalItems += $item['quantity'];
    }

    echo json_encode([
        'success' => true,
        'message' => 'Item removed successfully.',
        'totalItems' => $totalItems,
    ]);
    exit;
}

echo json_encode(['success' => false, 'message' => 'Invalid request.']);
