<?php
// Start session and include database connection
session_start();
require_once '../db_connection/db_conn.php'; // Adjust path if needed

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image_url = '';

    // Handle file upload
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../images/'; // Directory where images will be saved
        $fileName = basename($_FILES['file']['name']);
        $uploadFile = $uploadDir . $fileName;

        // Check if directory exists, otherwise create it
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Create directory if it doesn't exist
        }

        // Move uploaded file to the target directory
        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
            $image_url = './images/' . $fileName; // Save relative file path to the database
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
