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

function fetchContactSubmissions()
{
    global $conn; // Use the global database connection variable
    $sql = "SELECT id, full_name, email, phone_number, message, submitted_at FROM contact_form";
    $result = $conn->query($sql);

    $data = array(); // Initialize an empty array for storing contact data
    if ($result->num_rows > 0) { // Check if there are any results
        while ($row = $result->fetch_assoc()) { // Fetch each row as an associative array
            $data[] = $row; // Add the row to the data array
        }
    }
    return $data; // Return the data array
}

// Fetch contact submission data
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <a href="../index.php" class="back-button">Go Back</a>
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

                    <a href="javascript:void(0);" onclick="confirmDeletion('user', <?php echo $user['id']; ?>)">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Contact List</h2>

    <!-- Display contact data in a table -->
    <table border="1">
        <tr style="background-color: #9FE2FF; ">
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Message</th>
            <th>Submission Date</th>
            <th>Action</th>
        </tr>
        <?php foreach ($submissions as $submission) : ?>
            <tr>
                <td><?php echo $submission['id']; ?></td>
                <td><?php echo $submission['full_name']; ?></td>
                <td><?php echo $submission['email']; ?></td>
                <td><?php echo $submission['phone_number']; ?></td>
                <td><?php echo $submission['message']; ?></td>
                <td><?php echo $submission['submitted_at']; ?></td>
                <td>
                    <!-- Links for deleting a contact submission -->
                    <a href="javascript:void(0);" onclick="confirmDeletion('contact', <?php echo $submission['id']; ?>)">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <script>
        function confirmDeletion(type, id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: 'rgb(98 197 240)',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `process.php?action=delete_${type}&id=${id}`;
                }
            });
        }
    </script>
</body>

</html>