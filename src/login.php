<?php
require 'layout/header.php';
require 'config.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userManager = new UserManager($conn);

    // Fetch user by email
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Store user data in session
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['is_connected'] = true;

            // Redirect to dashboard
            echo "<script>window.location.href='dashboard.php'</script>";
            exit();
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No user found with this email.";
    }
    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Coop Brain</title>
    <link rel="stylesheet" href="styles/login-logout.css"> <!-- Make sure the path to styles.css is correct -->
</head>

<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Login</h2>
            <form action="login.php" method="post">
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="input-group">
                    <button type="submit" class="login-button">Login</button>
                </div>
                <div class="error">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            </form>
            <p class="register-link">Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </div>
    <?php include 'layout/footer.php'; ?>
</body>

</html>
