<?php
// Include database connection
require_once '../db_connection/db_conn.php';

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

    // Debugging: Log the password provided and the hashed password
    error_log("Password provided: $password");
    error_log("Password from DB: " . $user['password']);

    // Verify password
    if (password_verify($password, $user['password'])) {
        echo json_encode([
            "status" => "success",
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "title" => "Invalid Password",
            "message" => "The password you entered is incorrect.",
        ]);
    }
} else {
    echo json_encode([
        "status" => "error",
        "title" => "User Not Found",
        "message" => "No account found with the provided email address.",
    ]);
}

$conn->close();
