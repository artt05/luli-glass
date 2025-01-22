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
    global $conn; // Use the global database connection variable
    $sql = "SELECT * FROM users"; // Query to fetch all users
    $result = $conn->query($sql);

    $data = array(); // Initialize an empty array for storing user data
    if ($result->num_rows > 0) { // Check if there are any results
        while ($row = $result->fetch_assoc()) { // Fetch each row as an associative array
            $data[] = $row; // Add the row to the data array
        }
    }
    return $data; // Return the data array
}

// Fetch all contact submissions from the database
function fetchContactSubmissions()
{
    global $conn; // Use the global database connection variable
    $sql = "SELECT * FROM contact_form"; // Query to fetch all contact form submissions
    $result = $conn->query($sql);

    $data = array(); // Initialize an empty array for storing contact data
    if ($result->num_rows > 0) { // Check if there are any results
        while ($row = $result->fetch_assoc()) { // Fetch each row as an associative array
            $data[] = $row; // Add the row to the data array
        }
    }
    return $data; // Return the data array
}

if ($_GET['action'] === 'delete_user' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error deleting user.";
    }
}

if ($_GET['action'] === 'delete_contact' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM contact_form WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error deleting contact submission.";
    }
}

// Fetch user data and contact submissions
$users = fetchUsers();
$submissions = fetchContactSubmissions();


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <a href="../index.php" class="back-button">Go Back</a>
    <h1 style="text-align: center;">Welcome to the Admin Dashboard</h1>

    <!-- User List Section -->
    <h2>User List</h2>
    <table border="1">
        <tr style="background-color: #9FE2FF;">
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
                <td><?php echo htmlspecialchars($user['first_name']); ?></td>
                <td><?php echo htmlspecialchars($user['last_name']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $user['id']; ?>">Edit</a>
                    <a href="process.php?action=delete_user&id=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Contact Submissions Section -->
    <h2 style="padding: 30px 0px;">Contact Submissions</h2>
    <table border="1">
        <tr style="background-color: #9FE2FF;">
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Message</th>
            <th>Submitted At</th>
            <th>Action</th>
        </tr>
        <?php foreach ($submissions as $submission) : ?>
            <tr>
                <td><?php echo $submission['id']; ?></td>
                <td><?php echo htmlspecialchars($submission['full_name']); ?></td>
                <td><?php echo htmlspecialchars($submission['email']); ?></td>
                <td><?php echo htmlspecialchars($submission['phone_number']); ?></td>
                <td><?php echo htmlspecialchars($submission['message']); ?></td>
                <td><?php echo htmlspecialchars($submission['submitted_at']); ?></td>
                <td>
                    <a href="process.php?action=delete_contact&id=<?php echo $submission['id']; ?>" onclick="return confirm('Are you sure you want to delete this submission?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>

</html>