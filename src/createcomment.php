<?php
// create_project.php
include 'layout/header.php';
if (!$_SESSION || !$_SESSION["is_connected"]) {
    echo "<script>window.location.href='login.php'</script>";
    die();
}


require 'config.php';
$commentManager = new CommentManager($conn);
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $content = htmlspecialchars($_POST['content']);
    $projectId = intval($_POST['projectId']);
    $creationDate = new DateTime();
    $comment = new Comment($projectId, $_SESSION['user_id'],$creationDate ,$content, );
    $commentManager->create($comment);
    echo "<script>window.location.href='projectpae.php'</script>";
    
    exit();
}