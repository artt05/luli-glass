<?php
// Start session and include database connection
session_start();
require_once '../db_connection/db_conn.php'; // Adjust path if needed

// Define BASE_URL for the project if not already defined
if (!defined('BASE_URL')) {
    define('BASE_URL', '/luli-glass'); // Adjust this to your project's base URL
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image_url = ''; // Initialize the image URL

    // Handle file upload
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = realpath(__DIR__ . '/../images/') . '/'; // Absolute path to save images
        $fileName = basename($_FILES['file']['name']);
        $uploadFile = $uploadDir . $fileName;

        // Check if directory exists, otherwise create it
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Create directory if it doesn't exist
        }

        // Move uploaded file to the target directory
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
            $image_url = './images/' . $fileName; // Use relative path


        } else {
            die('Error uploading file.');
        }
    }

    // Insert data into database
    $query = "INSERT INTO projects (title, description, image_url, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $title, $description, $image_url);

    if ($stmt->execute()) {
        // Redirect back to the admin_projects.php page with success message
        header("Location: ../admin/admin_projects.php?status=success");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
