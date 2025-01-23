<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Projects</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="../css/projects.css"> <!-- Link to your CSS -->
    <link rel="stylesheet" href="../style.css"> <!-- Link to your CSS -->
</head>

<body>
    <?php
    $activePage = 'projects';
    include $_SERVER['DOCUMENT_ROOT'] . '/luli-glass/components/header.php';
    ?>


    <!-- Main Section -->
    <main class="project-page">
        <div style="display: flex; justify-content: center; width: 100%;">
            <div class="titlemain">
                <span class="page-title">Our Projects</span>
                <a href="admin_projects.php" class="btn btn-primary" style="background-color: #00ced1; border:none;">Add New Project</a>
            </div>
        </div>
        <div class="project-container">
            <?php
            require_once(__DIR__ . '/../db_connection/db_conn.php');

            $sql = "SELECT * FROM projects ORDER BY created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="project-card">';
                    echo '<img src="' . htmlspecialchars($row['image_url']) . '" alt="' . htmlspecialchars($row['title']) . '" class="project-image">';
                    echo '<div class="project-info">';
                    echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                    echo '<p>' . htmlspecialchars($row['description']) . '</p>';
                    echo '<button class="btn btn-danger delete-project" data-id="' . $row['id'] . '">Delete</button>'; // Add delete button
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p class="no-projects">No projects available at the moment.</p>';
            }
            ?>
        </div>
    </main>

    <footer class="footerr">
        <div class="footer-containerr">
            <div class="footer-logo">
                <a href="index.php">
                    <img src="../images/luli-glass.png" alt="Luli Glass Logo" />
                </a>
                <div class="footer-section contact">

                    <p style="margin: 0px;"> <strong>Phone:</strong> 049 800 800</p>
                    <p style="margin: 0px;">
                        <strong>Mail:</strong>
                        <a href="mailto:contact@support.com" style="color: white;">luliglass@gmail.com</a>
                    </p>
                    <p style="margin: 0px;">
                        <strong>Address:</strong> Prishtinë
                    </p>
                </div>
                <div class="footer-nav">
                    <div class="footer-section-links">
                        <div style="font-size: 28px; padding-bottom: 10px">Other Pages</div>
                        <div class="footer-links">
                            <a href="#">Privacy & Policy</a>
                            <a href="#">Terms of Use</a>
                            <a href="#">Disclaimer</a>
                            <a href="#">FAQ</a>
                        </div>
                    </div>

                    <div class="footer-social">
                        <div class="footer-section-links">
                            <div style="font-size: 28px;">Socials</div>
                            <div class="footer-socials">
                                <a href="#"><img src="../images/facebook-svgrepo-com.png" alt="Facebook" /></a>

                                <a href="#"><img src="../images/instagram.png" alt="Instagram" style="width: 50px; height: 50px;" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="footer-bottom">
                        <p>© 2024 Luli Glass. All Rights Reserved.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.delete-project').forEach(button => {
            button.addEventListener('click', function() {
                const projectId = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#00ced1',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('../backend/delete_project_handler.php', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({
                                    id: projectId
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire('Deleted!', 'Your project has been deleted.', 'success');
                                    location.reload(); // Reload the page to reflect changes
                                } else {
                                    Swal.fire('Error!', 'Failed to delete the project.', 'error');
                                }
                            })
                            .catch(() => {
                                Swal.fire('Error!', 'An error occurred while deleting the project.', 'error');
                            });
                    }
                });
            });
        });
    </script>
</body>

</html>