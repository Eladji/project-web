<?php
require 'layout/header.php';
require 'config.php';
// dashboard.php
echo "<link rel='stylesheet' href='styles/Dashboard.css'>";
if (!$_SESSION || !$_SESSION["is_connected"]) {
    echo "<script>window.location.href='login.php'</script>";
    die();
}
$userManager = new UserManager($conn);
$user = $userManager->getUserById($_SESSION['user_id']);

echo "<h1>Welcome, " . htmlspecialchars($_SESSION['user_name']) . "!</h1>";


echo '<a href="editprofile.php">Edit Profile</a><br>';
echo '<a href="deleteprofile.php">DELETE ACCOUNT</a><br>';
      
$projectManager = new ProjectManager($conn);

$projects = $projectManager->list();
echo "<ul class='cards'>";
foreach ($projects as $project) {
    if ($project->getIdAuthor() != $_SESSION['user_id']) {
        continue;
    }
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
    echo "<img class='card__thumb' src='".$user['icon']."'alt='' />";
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

// foreach ($projects as $project) {
//     if ($project->getIdAuthor() != $_SESSION['user_id']) {
//         continue;
//     }
//     echo "Project ID: " . $project->getId() . "<br>";
//     echo "Project Name: " . $project->getName() . "<br>";
//     echo "Project State: " . $project->getState() . "<br>";
//     echo "Project Repo: " . $project->getRepoGit() . "<br>";
//     echo "Project Thumbnail: "; 
//     if ($project->getThumbnail())
//     {
//         echo "<img src=\"" .$project->getThumbnail() . "\"><br>";
//     }
//     else {
//         echo "Error thumbnail not fund<br>";
//         }
//     echo "Project Description: " . $project->getDescription() . "<br>";
//     echo "<hr>";
// }
?>
