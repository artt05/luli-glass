<?php
require_once(__DIR__ . '/../db_connection/db_conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image_url = null;

    // Handle image upload if a new file is provided
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../images/';
        $fileName = basename($_FILES['file']['name']);
        $uploadFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
            $image_url = './images/' . $fileName;
        } else {
            echo '<script>
                    Swal.fire({
                        icon: "error",
                        title: "Failed to upload image",
                        text: "Please try again.",
                        confirmButtonText: "Okay"
                    }).then(() => {
                        window.history.back();
                    });
                  </script>';
            exit;
        }
    }

    // Update project in the database
    if ($image_url) {
        $query = "UPDATE projects SET title = ?, description = ?, image_url = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $title, $description, $image_url, $id);
    } else {
        $query = "UPDATE projects SET title = ?, description = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssi", $title, $description, $id);
    }

    if ($stmt->execute()) {
        // Redirect to the admin_projects.php page after success
        header('Location: ../admin/projects.php');
        exit;
    } else {
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "Failed to update project",
                    text: "' . $stmt->error . '",
                    confirmButtonText: "Okay"
                }).then(() => {
                    window.history.back();
                });
              </script>';
    }

    $stmt->close();
    $conn->close();
}
