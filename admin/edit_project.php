<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
    <link rel="stylesheet" href="admin_projects.css">
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    require_once(__DIR__ . '/../db_connection/db_conn.php');
    include __DIR__ . '../../components/header.php';

    // Fetch project details
    if (isset($_GET['id'])) {
        $projectId = $_GET['id'];
        $stmt = $conn->prepare("SELECT * FROM projects WHERE id = ?");
        $stmt->bind_param("i", $projectId);
        $stmt->execute();
        $result = $stmt->get_result();
        $project = $result->fetch_assoc();
        $stmt->close();
    } else {
        echo '<script>
                Swal.fire({
                    icon: "error",
                    title: "No project selected",
                    text: "Please select a project to edit",
                    confirmButtonText: "Back to Projects"
                }).then(() => {
                    window.location.href = "admin_projects.php";
                });
              </script>';
        exit;
    }
    ?>

    <div class="project-container" style="width:40%; margin: auto; padding-top: 50px;">
        <div class="project-card">
            <img src="<?php echo htmlspecialchars($project['image_url']); ?>" alt="" class="project-image" id="project-image">
            <div class="project-info">
                <form action="../backend/edit_project_handler.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($project['id']); ?>">
                    <input type="text" name="title" value="<?php echo htmlspecialchars($project['title']); ?>" placeholder="Title" style="width:100%; margin-bottom: 10px; height: 30px;" required>
                    <textarea name="description" placeholder="Description" style="width:100%; min-height: 100px; margin-bottom: 30px;" required><?php echo htmlspecialchars($project['description']); ?></textarea>
                    <label for="file" class="upload-btn">Upload New Image</label>
                    <input type="file" id="file" name="file" style="display: none;">
                    <button type="submit" class="add-product-btn" style="background-color: #00ced1; border: none;">Update Project</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("file").addEventListener("change", function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById("project-image").src = e.target.result;
            }
            reader.readAsDataURL(this.files[0]);
        });
    </script>
</body>

</html>