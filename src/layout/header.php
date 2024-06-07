<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/style_template.css">
    <link rel="icon" type="image/png" href="./media/cb_icon-transformed.png" />
    <title>Coop brain</title>
</head>

<body>
    <?php

function loadClass(string $class)
{
    if (str_contains($class, "manager")) {
        require("./managers/$class.php");
    } else {
        require("./model/$class.php");
    }
}
    spl_autoload_register('loadClass');
    ?>
    <div class="header">

        <a href="../index.php" class="logo">
            <img src="../media/cb_icon.png" alt="site icon">


            CoopBrain_

        </a>
        <div class="header-right">
            <a class="active" href="../profil.php">Profil</a>

            <a href="#contact">Contact</a>
            <a href="#about">About</a>
        </div>
    </div>
</body>

</html>