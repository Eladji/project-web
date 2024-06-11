<?php
require 'config.php';
require_once 'model/Comment.php';
require_once 'managers/CommentManager.php';

$commentManager = new CommentManager($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $commentId = $_POST['commentId'];

    // Delete the comment
    $commentManager->delete($commentId);
}

// Redirect back to the main page
header('Location: projectpae.php');
exit;
?>
