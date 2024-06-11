<?php
require 'config.php';
require_once 'model/user.php';
require_once 'managers/UserManager.php';

$userManager = new UserManager($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $commentId = $_POST['commentId'];

    // Delete the comment
    $userManager->deleteUser($_SESSION['user_id']);
    session_unset();
session_destroy();

}

// Redirect back to the main page
header('Location: index.php');
exit;
?>
