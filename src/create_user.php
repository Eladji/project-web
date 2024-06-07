<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscription</title>
</head>
<body>
<?php
require 'layout/header.php';
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['Icon'])) {
    
    
    if ($_POST['Icon'] == null) {
        $_POST['Icon'] = 'media/cb_icon.png';
    }
    else {
        $file = $_FILES['Icon'];
        $file_name = $file['name'];
        $file_tmp_name = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];
        $file_type = $file['type'];
        $file_ext = explode('.', $file_name);
        $file_actual_ext = strtolower(end($file_ext));
        $allowed = array('jpg', 'jpeg', 'png');
        if (in_array($file_actual_ext, $allowed)) {
            if ($file_error === 0) {
                if ($file_size < 1000000) {
                    $file_name_new = uniqid('', true) . "." . $file_actual_ext;
                    $file_destination = 'media/' . $file_name_new;
                    move_uploaded_file($file_tmp_name, $file_destination);
                    $_POST['Icon'] = $file_destination;
                } else {
                    echo "Your file is too big!";
                }
            } else {
                echo "There was an error uploading your file!";
            }
        } else {
            echo "You cannot upload files of this type!";
        }
    }
    $user = new user([
        'name' => $_POST['name'],
        'email' => $_POST['email'],
        'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        'git' => '',
        'score' => 0,
        'nbt_project' => 0,
        'icon' => ''
    ]);
    $user_manager = new user_manager();
    $user_manager->add($user);
    header('Location: ../index.php');
 
}
?>
<form action="create_user.php" method="post" >
    <label for="name">Nom</label>
    <input type="text" name="name" id="name">
    <label for="email">Email</label>
    <input type="email" name="email" id="email">
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password">
    <label for="Icon">Icon</label>
    <input type="file" name="Icon" id="Icon" require >
    <input type="submit" value="S'inscrire">
</form>
    <?php

require 'layout/footer.php';
?>
</body>
</html>