<?php
require 'config.php';
require_once 'model/Comment.php';
require_once 'managers/CommentManager.php';

$commentManager = new CommentManager($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $commentId = $_POST['commentId'];
    $newContent = $_POST['content'];

    // Fetch the existing comment to preserve other fields
    $comment = $commentManager->read($commentId);

    if ($comment) {
        $comment->setContent($newContent);
        $commentManager->update($comment);
    }
}

// Redirect back to the main page
header('Location: projectpae.php');
exit;
?>
