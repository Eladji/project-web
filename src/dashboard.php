<?php
require 'layout/header.php';
require 'config.php';
// dashboard.php

if (!$_SESSION || !$_SESSION["is_connected"]) {
    echo "<script>window.location.href='login.php'</script>";
    die();
}

echo "<h1>Welcome, " . htmlspecialchars($_SESSION['user_id']) . "!</h1>";


$projectManager = new ProjectManager($conn);

$projects = $projectManager->list();

foreach ($projects as $project) {
    if ($project->getIdAuthor() != $_SESSION['user_id']) {
        continue;
    }
    echo "Project ID: " . $project->getId() . "<br>";
    echo "Project Name: " . $project->getName() . "<br>";
    echo "Project State: " . $project->getState() . "<br>";
    echo "Project Repo: " . $project->getRepoGit() . "<br>";
    echo "Project Thumbnail: <img src=\"" . $project->getThumbnail() . "\"><br>";
    echo "Project Description: " . $project->getDescription() . "<br>";
    echo "<hr>";
}
?>
