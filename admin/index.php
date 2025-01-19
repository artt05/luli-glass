<?php
// Start the session
session_start();

// Check if the user is logged in and has an admin role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    // Redirect to login page if not an admin
    header("Location: ../auth/login.php");
    exit;
}

// Include the database connection
require '../db_connection/db_conn.php';

// Fetch all users from the database
function fetchUsers()
{
    global $conn;  // Use the global database connection variable
    $sql = "SELECT * FROM users";  // Query to fetch all users
    $result = $conn->query($sql);

    $data = array();  // Initialize an empty array for storing user data
    if ($result->num_rows > 0) {  // Check if there are any results
        while ($row = $result->fetch_assoc()) {  // Fetch each row as an associative array
            $data[] = $row;  // Add the row to the data array
        }
    }
    return $data;  // Return the data array
}

// Fetch user data
$users = fetchUsers();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css"> <!-- Link to the admin CSS -->
</head>

<body>
    <h1 style="text-align: center;">Welcome to the Admin Dashboard</h1>
    <h2>User List</h2>

    <!-- Display user data in a table -->
    <table border="1">
        <tr style="background-color: #9FE2FF; ">
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Action</th>
        </tr>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><?php echo $user['id']; ?></td>
                <td><?php echo $user['first_name']; ?></td>
                <td><?php echo $user['last_name']; ?></td>
                <td><?php echo $user['email']; ?></td>
                <td><?php echo $user['username']; ?></td> <!-- Adjusted field for phone number -->
                <td>
                    <!-- Links for editing and deleting a user -->
                    <a href="edit.php?id=<?php echo $user['id']; ?>">Edit</a>
                    <a href="process.php?action=delete&id=<?php echo $user['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>