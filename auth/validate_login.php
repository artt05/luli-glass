<?php
// Include database connection
require '../db_connection/db_conn.php';

// Retrieve and decode JSON data from the POST request
$data = json_decode(file_get_contents('php://input'), true);
$email = $conn->real_escape_string($data['email']);
$password = $data['password'];

// Check if email exists in the database
$sql = "SELECT * FROM users WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch user data
    $user = $result->fetch_assoc();

    // Verify password
    if (password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        // Retrieve cart data for the user from the database
        $query = "
            SELECT product_id, thickness, width, height, border_radius, quantity, price 
            FROM order_details 
            WHERE userinfo_id = ?
        ";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $user['id']);
        $stmt->execute();
        $result = $stmt->get_result();
        $cartItems = $result->fetch_all(MYSQLI_ASSOC);

        // Save cart data to the session
        $_SESSION['cart'] = [];
        foreach ($cartItems as $item) {
            $_SESSION['cart'][$item['product_id']] = $item;
        }

        // Update session totals
        $_SESSION['totalItems'] = array_sum(array_column($cartItems, 'quantity'));
        $_SESSION['totalPrice'] = array_sum(array_column($cartItems, 'price'));

        // Redirect based on user role
        if ($user['role'] === 'admin') {
            echo json_encode([
                "status" => "success",
                "redirect" => "../admin/index.php",
            ]);
        } else {
            echo json_encode([
                "status" => "success",
                "redirect" => "../index.php",
            ]);
        }
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid password.",
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "message" => "User not found.",
    ]);
}

$conn->close();
