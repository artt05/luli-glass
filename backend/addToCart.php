<?php
session_start();
include '../db_connection/db_conn.php'; // Include the database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve product data from the request
    $productId = $_POST['id'] ?? null;
    $productName = $_POST['name'] ?? null;
    $productQuantity = $_POST['quantity'] ?? 0;
    $productPrice = $_POST['price'] ?? 0;
    $productImage = $_POST['image'] ?? null;

    // Additional attributes
    $productThickness = $_POST['thickness'] ?? null;
    $productWidth = $_POST['width'] ?? null;
    $productHeight = $_POST['height'] ?? null;
    $productBorderRadius = $_POST['border_radius'] ?? null;


    // Validate required fields
    if (!$productId || !$productName || !$productQuantity || !$productPrice) {
        echo json_encode(['success' => false, 'message' => 'Missing required product data.']);
        exit;
    }

    // Initialize session cart if not already set
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Temporary session-based user ID
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['user_id'] = session_id(); // Generate session-based ID
    }
    $userinfo_id = $_SESSION['user_id']; // Use userinfo_id to match your database column

    // Check if the product already exists in the cart
    if (!isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId] = [
            'id' => $productId,
            'name' => $productName,
            'quantity' => $productQuantity,
            'price' => $productPrice,
            'image' => $productImage,
            'thickness' => $productThickness,
            'width' => $productWidth,
            'height' => $productHeight,
            'border_radius' => $productBorderRadius,

        ];
    } else {
        // Update session cart for an existing product
        $_SESSION['cart'][$productId]['quantity'] += $productQuantity;
        $_SESSION['cart'][$productId]['price'] += $productPrice;
    }

    // Insert the product data into the database
    $stmt = $conn->prepare("
        INSERT INTO order_details (userinfo_id, product_id, thickness, width, height, border_radius, quantity, price, created_at)
        VALUES (?, ?, ?, ?, ?, ?,  ?, ?, NOW())
    ");
    if (!$stmt) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $conn->error]);
        exit;
    }

    $stmt->bind_param(
        "iisddidi", // Data types: i = integer, s = string, d = double
        $userinfo_id,
        $productId,
        $productThickness,
        $productWidth,
        $productHeight,
        $productBorderRadius,
        $productQuantity,
        $productPrice,

    );

    if (!$stmt->execute()) {
        echo json_encode(['success' => false, 'message' => 'Failed to save product to database.']);
        exit;
    }

    $stmt->close();

    // Calculate total items and total price
    $totalItems = 0;
    $totalPrice = 0.0;
    foreach ($_SESSION['cart'] as $item) {
        $totalItems += $item['quantity'];
        $totalPrice += $item['price'];
    }


    $response = [
        'success' => true,
        'message' => 'Product added to cart.',
        'updatedQuantity' => $_SESSION['cart'][$productId]['quantity'] ?? 0, // Ensure a value is returned
        'updatedPrice' => number_format($_SESSION['cart'][$productId]['price'] ?? 0, 2), // Ensure a value is returned
        'totalItems' => $totalItems ?? 0, // Ensure a value is returned
        'totalPrice' => number_format($totalPrice ?? 0, 2), // Ensure a value is returned
    ];

    // Log the response for debugging
    error_log("Response to frontend: " . json_encode($response));

    // Return the JSON response
    echo json_encode($response);
    exit;
}
