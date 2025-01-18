
<?php
session_start();
include '../db_connection/db_conn.php'; // Include your MySQLi connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Start a transaction
        $conn->begin_transaction();

        // 1. Insert into `order_userinfo` table
        $stmt = $conn->prepare("
            INSERT INTO order_userinfo (
                first_name, last_name, country, city, postal_code, address, email, phone_number, total_price, total_quantity
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param(
            "ssssssssdi", // Data types: s = string, d = double, i = integer
            $_POST['firstName'],
            $_POST['lastName'],
            $_POST['country'],
            $_POST['city'],
            $_POST['postalCode'],
            $_POST['address'],
            $_POST['email'],
            $_POST['phone'],
            $_POST['total_price'],
            $_POST['total_quantity']
        );

        // Execute the statement
        if (!$stmt->execute()) {
            throw new Exception("Execution failed: " . $stmt->error);
        }

        // Get the last inserted order ID
        $orderId = $conn->insert_id;

        // 2. Insert into `orders` table
        $cart = $_SESSION['cart'];
        $stmt = $conn->prepare("
            INSERT INTO orders (order_id, product_name, product_price, product_quantity, product_image) 
            VALUES (?, ?, ?, ?, ?)
        ");

        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        // Loop through the cart and insert each item
        foreach ($cart as $item) {
            $stmt->bind_param(
                "isdss", // Data types: i = integer, s = string, d = double
                $orderId,
                $item['name'],
                $item['price'],
                $item['quantity'],
                $item['image']
            );

            if (!$stmt->execute()) {
                throw new Exception("Execution failed: " . $stmt->error);
            }
        }

        // Commit the transaction
        $conn->commit();

        // Success response
        echo json_encode(['success' => true, 'message' => 'Order placed successfully.']);
    } catch (Exception $e) {
        // Rollback transaction on failure
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => 'Failed to place order: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
