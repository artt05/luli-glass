<?php
session_start();
include '../db_connection/db_conn.php'; // Include your MySQLi connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log(print_r($_POST, true)); // Logs all POST data for debugging

    try {
        // Start a transaction
        $conn->begin_transaction();

        // 1. Insert form data into `order_userinfo` table
        $stmt = $conn->prepare("
            INSERT INTO order_userinfo (
                first_name, last_name, country, city, postal_code, address, email, phone_number, total_price, total_quantity
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        if (!$stmt) {
            throw new Exception("Prepare statement failed: " . $conn->error);
        }

        // Bind form data to the query
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

        if (!$stmt->execute()) {
            throw new Exception("Execution failed: " . $stmt->error);
        }

        // Get the generated `order_id` from the `order_userinfo` table
        $orderId = $conn->insert_id;

        // 2. Update the `userinfo_id` in the `order_details` table
        if (isset($_SESSION['user_id'])) {
            $stmt = $conn->prepare("
                UPDATE order_details 
                SET userinfo_id = ? 
                WHERE userinfo_id = ?
            ");

            if (!$stmt) {
                throw new Exception("Prepare statement failed: " . $conn->error);
            }

            // Bind the new `order_id` to replace the temporary session ID
            $stmt->bind_param(
                "is", // i = integer, s = string
                $orderId,
                $_SESSION['user_id']
            );

            if (!$stmt->execute()) {
                throw new Exception("Execution failed: " . $stmt->error);
            }
        }

        // Commit the transaction
        $conn->commit();

        // Clear the cart session after successful order
        unset($_SESSION['cart']);
        unset($_SESSION['user_id']);

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
