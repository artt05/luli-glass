<?php
// Include the database connection file
require '../db_connection/db_conn.php';

// Check if 'id' is passed as a GET parameter
if (isset($_GET['id'])) {
    $userId = $_GET['id']; // Get the user ID from the URL
    $sql = "SELECT * FROM users WHERE id = ?"; // Use a prepared statement for security
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc(); // Fetch user data as an associative array
    } else {
        // Display a message if the user is not found and terminate the script
        echo "User not found!";
        die();
    }
} else {
    // Display an error if no 'id' is provided in the request and terminate the script
    echo "Invalid request!";
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="admin_edit.css"> <!-- Path to the CSS file in the admin folder -->
</head>

<body>
    <h2>Edit User</h2>
    <!-- Form to edit user details -->
    <form action="process.php?action=update" method="post">
        <!-- Hidden field for user ID -->
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>"><br>

        <!-- Input field for username -->
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required><br>

        <!-- Input field for first name -->
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" value="<?php echo htmlspecialchars($user['first_name']); ?>" required><br>

        <!-- Input field for last name -->
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" value="<?php echo htmlspecialchars($user['last_name']); ?>" required><br>

        <!-- Input field for email -->
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>

        <!-- Submit button to update the user -->
        <input type="submit" value="Update User"><br>
    </form>
</body>

</html>