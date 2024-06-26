<?php
require 'layout/header.php';
require 'config.php';
$userManager = new UserManager($conn);
$reg_error = "";

// Define target directory for icon uploads from environment variable
$target_dir = getenv('UPLOAD_DIR');

// Ensure the uploads directory exists and is writable
if (!file_exists($target_dir)) {
    if (!mkdir($target_dir, 0755, true)) {
        die("Failed to create directories...");
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $password_confirm = htmlspecialchars($_POST['password_confirm']);
    $git = htmlspecialchars($_POST['git'] ?? ''); // GitHub profile URL

    $icon_path = "";

    // Handle file upload
    if (!empty($_FILES['icon']['name'])) {
        $icon = $_FILES['icon'];
        $upload_ok = 1;
        $image_file_type = strtolower(pathinfo($icon["name"], PATHINFO_EXTENSION));

        // Check file size
        if ($icon["size"] > 2 * 1024 * 1024) { // 2MB
            $reg_error = "Sorry, your file is too large.";
            $upload_ok = 0;
        }

        // Allow certain file formats
        $allowed_types = ['jpg', 'png', 'jpeg', 'gif'];
        if (!in_array($image_file_type, $allowed_types)) {
            $reg_error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $upload_ok = 0;
        }

        // Check if $upload_ok is set to 0 by an error
        if ($upload_ok == 0) {
            $reg_error = "Sorry, your file was not uploaded.";
        } else {
            // Ensure unique file name
            $target_file = $target_dir . uniqid() . '.' . $image_file_type;

            // Move file to target directory
            if (move_uploaded_file($icon["tmp_name"], $target_file)) {
                $icon_path = $target_file;
            } else {
                $reg_error = "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Validate password
    if ($password !== $password_confirm) {
        $reg_error = "Passwords do not match.";
    } else {
        

        // Check if email already exists
        $sql = "SELECT id FROM user WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $reg_error = "Email already registered.";
        } else {
            // Hash password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            // Set default values for score and nbt_project
            $score = 0;
            $nbt_project = 0;
            $user = new User($name, $password,$email,  $git, $score, $nbt_project, $icon_path);

            // Insert new user
    
            if ($userManager->createUser($user)) {
                $_SESSION['user_id'] = $stmt->insert_id;
                $_SESSION['user_name'] = $name;
                $_SESSION['is_connected'] = true;
                echo "<script>window.location.href='dashboard.php'</script>";
                exit();
            } else {
                $reg_error = "Registration failed. Please try again.";
            }
        }

        $stmt->close();
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Coop Brain</title>
    <link rel="stylesheet" href="styles/register.css"> <!-- Make sure the path to styles.css is correct -->
</head>

<body>
    <div class="register-container">
        <div class="register-box">
            <h2>Register</h2>
            <form action="register.php" method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="input-group">
                    <label for="password_confirm">Confirm Password:</label>
                    <input type="password" id="password_confirm" name="password_confirm" required>
                </div>
                <div class="input-group">
                    <label for="git">GitHub Profile URL:</label>
                    <input type="url" id="git" name="git" placeholder="https://github.com/username">
                </div>
                <div class="input-group">
                    <label for="icon">Profile Icon:</label>
                    <input type="file" id="icon" name="icon" accept="image/*">
                </div>
                <div class="input-group">
                    <button type="submit" class="register-button">Register</button>
                </div>
                <div class="error">
                    <?php echo htmlspecialchars($reg_error); ?>
                </div>
            </form>
            <p class="login-link">Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </div>
    <?php include 'layout/footer.php'; ?>
</body>

</html>
