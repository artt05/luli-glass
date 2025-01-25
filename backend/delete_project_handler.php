<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once('../db_connection/db_conn.php');

    $data = json_decode(file_get_contents('php://input'), true);
    $projectId = $data['id'] ?? null;
    error_log("Received data: " . json_encode($data));

    if ($projectId) {
        $stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
        $stmt->bind_param("i", $projectId);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
            error_log("Project with ID $projectId successfully deleted.");
        } else {
            echo json_encode(['success' => false, 'error' => $conn->error]);
            error_log("Failed to delete project with ID $projectId: " . $conn->error);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid project ID.']);
        error_log("Invalid project ID received.");
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method.']);
    error_log("Invalid request method used.");
}
