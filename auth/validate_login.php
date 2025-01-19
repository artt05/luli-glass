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
