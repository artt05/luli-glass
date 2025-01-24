<?php
session_start();

// Reset cart-related session variables
$_SESSION['cart'] = []; // Clear all cart items
$_SESSION['totalItems'] = 0;
$_SESSION['totalPrice'] = 0.00;

// Respond with success
echo json_encode(['success' => true]);
exit();
