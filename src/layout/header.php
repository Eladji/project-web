<?php
 session_start();
?>
<!-- header.php never put the session start after comment-->

<?php

function loadClass(string $class): void
{
    if (str_contains($class, "Manager")) {
        require("./managers/$class.php");
    } else {
        require("./model/$class.php");
    }
}
    spl_autoload_register('loadClass');
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coop-Brain</title>
    <link rel="icon" type="image/x-png" href="media/cb_icon-transformed.png">
    <link rel="stylesheet" href="styles/header-footer.css">
</head>
<body>
    <header>
        <div class="header-content">
            <a href="index.php" class="logo">
                <img src="../media/cb_icon.png" alt="Coop-Brain Logo">
                <span>Coop-Brain</span>
            </a>
            <nav>
                <ul>
                    <?php if ($_SESSION && $_SESSION["is_connected"]) : ?>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    <li><a href="createProject.php">Create Project</a></li>
                    <?php else : ?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                    <?php endif; ?>
                    <li><a href="about.php">About</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
