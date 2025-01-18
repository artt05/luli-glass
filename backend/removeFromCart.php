<?php
session_start();
include '../db_connection/db_conn.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['id'] ?? null;

    if (!$productId) {
        echo json_encode(['success' => false, 'message' => 'Product ID is missing.']);
        exit;
    }

    // Check if the product exists in the session cart and remove it
    if (isset($_SESSION['cart'][$productId])) {
        unset($_SESSION['cart'][$productId]); // Remove item from session
    }

    // Remove the item from the database for the current user
    if (isset($_SESSION['user_id'])) {
        $userinfo_id = $_SESSION['user_id']; // Retrieve the session-based user ID
        $stmt = $conn->prepare("DELETE FROM order_details WHERE userinfo_id = ? AND product_id = ?");
        if ($stmt) {
            $stmt->bind_param("ii", $userinfo_id, $productId);
            $stmt->execute();
            $stmt->close();
        } else {
            echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
            exit;
        }
    }

    // Recalculate the total items and total price in the session cart
    $totalItems = 0;
    $totalPrice = 0.0;
    foreach ($_SESSION['cart'] as $item) {
        $totalItems += $item['quantity']; // Sum of all quantities
        $totalPrice += $item['price'];    // Sum of all product prices
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
