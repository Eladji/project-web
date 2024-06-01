<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscription</title>
</head>
<body>
<?php
require '../layout/header.php';
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
    $user = new user([
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        'git' => '',
        'score' => 0,
        'nbt_project' => 0,
        'icon' => ''
    ]);
    $user_manager = new userManager();
    $user_manager->add($user);
    header('Location: ../index.php');
    exit();
}
?>
<form action="create_user.php" method="post">
    <label for="name">Nom</label>
    <input type="text" name="name" id="name">
    <label for="email">Email</label>
    <input type="email" name="email" id="email">
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password">
    <input type="submit" value="S'inscrire">
</form>
    
</body>
</html>