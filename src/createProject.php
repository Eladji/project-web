<?php
// create_project.php
include 'layout/header.php';
if (!$_SESSION || !$_SESSION["is_connected"]) {
    echo "<script>window.location.href='login.php'</script>";
    die();
}


require 'config.php';

$projectManager = new ProjectManager($conn);
$error = "";
$success = "";

// Ensure the uploads directory exists and is writable
$target_dir = getenv('UPLOAD_DIR');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $state = 1;
    $repoGit = "";
    $idAuthor = $_SESSION['user_id'];
    $description = $_POST['description'];

    $thumbnail_path = "";

    // Handle file upload
    if (!empty($_FILES['thumbnail']['name'])) {
        $thumbnail = $_FILES['thumbnail'];
        $upload_ok = 1;
        $image_file_type = strtolower(pathinfo($thumbnail["name"], PATHINFO_EXTENSION));

        // Check file size
        if ($thumbnail["size"] > 2 * 1024 * 1024) { // 2MB
            $error = "Sorry, your file is too large.";
            $upload_ok = 0;
        }

        // Allow certain file formats
        $allowed_types = ['jpg', 'png', 'jpeg', 'gif'];
        if (!in_array($image_file_type, $allowed_types)) {
            $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $upload_ok = 0;
        }

        // Check if $upload_ok is set to 0 by an error
        if ($upload_ok == 0) {
            $error = "Sorry, your file was not uploaded.";
        } else {
            // Ensure unique file name
            $target_file = $target_dir . uniqid() . '.' . $image_file_type;

            // Move file to target directory
            if (move_uploaded_file($thumbnail["tmp_name"], $target_file)) {
                $thumbnail_path = $target_file;
            } else {
                $error = "Sorry, there was an error uploading your file.";
            }
        }
    }

    if (empty($error)) {
        // Create project object
        $project = new Project($name, $state, $repoGit, $idAuthor, $thumbnail_path, $description);

        // Save to database
        if ($projectManager->create($project)) {
            $success = "Project created successfully.";
        } else {
            $error = "Failed to create project.";
        }
    }
}

?>

<div class="container">
    <h2>Create Project</h2>
    <?php if ($error): ?>
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>
    <form action="createProject.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="name">Project Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        
    
 
        <div>
            <label for="description">Description:</label>
            <textarea id="description" name="description" rows="4" required></textarea>
        </div>
        <div>
            <label for="thumbnail">Thumbnail Image:</label>
            <input type="file" id="thumbnail" name="thumbnail" accept="image/*" required multiple="false">
        </div>
        <div>
            <label for="images"> Images:</label>
            <input type="file" id="images" name="images" accept="image/*" required max="4">
        </div>
        <div>
            <button type="submit">Create Project</button>
        </div>
    </form>
</div>

<?php include 'layout/footer.php'; ?>