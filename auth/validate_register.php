<?php
// Include database connection
require_once '../db_connection/db_conn.php';

// Get JSON data from the fetch request
$data = json_decode(file_get_contents('php://input'), true);

// Extract and sanitize form data
$first_name = $conn->real_escape_string($data['first_name']);
$last_name = $conn->real_escape_string($data['last_name']);
$email = $conn->real_escape_string($data['email']);
$username = $conn->real_escape_string($data['username']);
$password = password_hash($data['password'], PASSWORD_BCRYPT); // Hash password
$created_at = date("Y-m-d H:i:s"); // Current timestamp

// Check if the email already exists
$email_check = $conn->query("SELECT id FROM users WHERE email = '$email'");
if ($email_check->num_rows > 0) {
    echo json_encode([
        "status" => "error",
        "title" => "Email Exists",
        "message" => "The email address is already registered. Please try a different email."
    ]);
    exit;
}

// Insert user into the database
$sql = "INSERT INTO users (first_name, last_name, email, username, password, created_at) 
        VALUES ('$first_name', '$last_name', '$email', '$username', '$password', '$created_at')";

if ($conn->query($sql) === TRUE) {
    echo json_encode([
        "status" => "success",
        "title" => "Registration Successful",
        "message" => "You have successfully registered. Redirecting to login page."
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "title" => "Registration Failed",
        "message" => "An error occurred during registration. Please try again later."
    ]);
}

$conn->close();
