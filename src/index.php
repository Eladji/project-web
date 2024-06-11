<?php
include 'layout/header.php';
echo "<br>";
echo "<link rel='stylesheet' href='styles/index.css'>";

require 'config.php';
$projectManager = new ProjectManager($conn);
$projects = $projectManager->list();
$usermanager = new UserManager($conn);
if (isset($_SESSION['user_id'])) {
    echo "<h1>Welcome, " . htmlspecialchars($_SESSION['user_name']) . "!</h1>";
}
echo "<h2>Projects</h2>";
echo "<ul class='cards'>";
foreach ($projects as $project) {
    echo "<li>";
    echo "<a href='projectpae.php?id=". $project->getId() . "' class='card'>";
    if ($project->getThumbnail()) {
        echo "<img class='card__image' src=\"" . $project->getThumbnail() . "\">";
        } else {
            echo "<img class='card__image'> Error thumbnail not fund. </img>";
            }
     
            
            echo "<div class='card__overlay'>";
            echo "<div class='card__header'>";
    echo "<svg class='card__arc' xmlns='http://www.w3.org/2000/svg'><path/></svg>";
    echo "<img class='card__thumb' src='".$usermanager->getUserById($project->getIdAuthor())['icon']."'alt='' />";
    echo "<div class='card__header-text'>";
    echo "<h3 class='card__title'>" . $project->getName() . "</h3>";
    echo "<span class='card__status'>" . ($project->getState() == 1 ? "Free" : "Taken") . "</span>";
    echo "<div class='content'> <p>" . (strlen($project->getDescription()) > 50 ? substr($project->getDescription(), 0, 20) . "..." : $project->getDescription()) . "</p> </div>";
    
    echo "</div>";
    echo "</div>";
    echo "<p class='card__description'>" . $project->getDescription() . "</p>";
    echo "</div>";
    echo "</a>";
    echo "</li>";

} 
echo "</ul>";

    // echo "</article>";
    // switch ($project->getState()) {
    //     case 1:
    //         echo "Project State: Free";
    //         break;
    //     case 0:
    //         echo "Project State: Taken";
    //         break;
    //     case 2:
    //         echo "Project State: archive";
    //         break;
    //     default:
    //         echo "Project State: Unknown";
    // }
    
    // echo " <a href='" . $project->getRepoGit() . "'>
    //             <img src='media/github.svg' alt='HTML tutorial' style='width:42px;height:42px;'>
    //         </a> ";
    //         echo " <div class='card-footer'>";
            
            
   
    // echo "Project Thumbnail: ";

    // if ($usermanager->getUserById($project->getIdAuthor())['name'] == null) {
    //     echo "Unknown";
    // }else if ($_SESSION)
    // {

    //     if($usermanager->getUserById($project->getIdAuthor())['name'] == $_SESSION['user_name']) {
    //         echo "you";
    //     }
    //     else {
    //         echo $usermanager->getUserById($project->getIdAuthor())['name'];
    //     }
    // }

    // else {
    //     echo $usermanager->getUserById($project->getIdAuthor())['name'];
    // }

//     echo "<h2>" . $project->getName() . "</h2>";
