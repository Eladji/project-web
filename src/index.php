<?php
include 'layout/header.php';

require 'config.php';

$projectManager = new ProjectManager($conn);
$projects = $projectManager->list();
$usermanager = new UserManager($conn);
foreach ($projects as $project) {
    echo "Project ID: " . $project->getId() . "<br>";
    echo "Project Name: " . $project->getName() . "<br>";
    echo "Project State: " . $project->getState() . "<br>";
    echo "Project Repo: " . $project->getRepoGit() . "<br>";
    echo "Project Author: ";
    // switch ($project->getIdAuthor()) {
    //     case 1:
    //         echo "Admin";      need to change the if to this switch
    //         break;
    //     case 2:
    //         echo "User";
    //         break;
    //     default:
    //         echo "Unknown";
    // }
    if ($usermanager->getUserById($project->getIdAuthor())['name'] == null) {
        echo "Unknown";
    }else if ($_SESSION)
    {

        if($usermanager->getUserById($project->getIdAuthor())['name'] == $_SESSION['user_name']) {
            echo "you";
        }
        else {
            echo $usermanager->getUserById($project->getIdAuthor())['name'];
        }
    }
    
    else {
        echo $usermanager->getUserById($project->getIdAuthor())['name'];
    }
    echo "<br>";
    echo "Project Thumbnail: "; 
    if ($project->getThumbnail())
    {
        echo "<img src=\"" .$project->getThumbnail() . "\"><br>";
    }
    else {
        echo "Error thumbnail not fund<br>";
    echo "Project Description: " . $project->getDescription() . "<br>";
    echo "<hr>";

}
}