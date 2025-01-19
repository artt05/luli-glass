<?php

// Include the database connection file
require '../db_connection/db_conn.php';

// Get the action from the URL (update or delete)
$action = $_GET['action'] ?? null;

if ($action === 'update') {
    // Update user information
    $id = intval($_POST['id']); // Sanitize and retrieve user ID from the form
    $first_name = $conn->real_escape_string($_POST['first_name']); // Sanitize first name
    $last_name = $conn->real_escape_string($_POST['last_name']); // Sanitize last name
    $email = $conn->real_escape_string($_POST['email']); // Sanitize email

    // SQL query to update user information in the database
    $sql = "UPDATE users SET 
            first_name = '$first_name', 
            last_name = '$last_name', 
            email = '$email' 
            WHERE id = $id";

    // Execute the update query and check for success
    if ($conn->query($sql) === TRUE) {
        // Optionally, add logging or notifications for successful update
    } else {
        // Log or handle errors during the update
        error_log("Error updating user: " . $conn->error);
    }
} elseif ($action === 'delete') {
    // Delete user
    $id = intval($_GET['id']); // Sanitize user ID from the URL

    // SQL query to delete the user from the database
    $sql = "DELETE FROM users WHERE id = $id";

    // Execute the delete query and check for success
    if ($conn->query($sql) === TRUE) {
        // Optionally, add logging or notifications for successful deletion
    } else {
        // Log or handle errors during the delete
        error_log("Error deleting user: " . $conn->error);
    }
} else {
    // Invalid action
    die("Invalid action specified.");
}

// Redirect back to the index page after completing the action
header("Location: index.php");
exit; // Ensure no further code is executed
