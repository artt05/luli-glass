<!DOCTYPE html>
<html lang="en ?">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Upload</title>
    <link rel="stylesheet" href="admin_projects.css">
</head>

<body>
    <div class="project-container" style="width:40%;">
        <div class="project-card">
            <img src="" alt="" class="project-image" id="project-image">
            <div class="project-info">
                <form action="../backend/add_project_handler.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="title" placeholder="Title" style="width:100%; margin-bottom: 10px; height: 30px;" required>
                    <textarea name="description" placeholder="Description" style="width:100%; min-height: 100px; margin-bottom: 30px;" required></textarea>
                    <label for="file" class="upload-btn">Upload Image</label>
                    <input type="file" id="file" name="file" style="display: none;" required>
                    <button type="submit" class="add-product-btn">Add Product</button>
                </form>


            </div>
        </div>
    </div>

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