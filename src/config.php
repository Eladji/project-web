<?php
// config.php
$servername = "mysql";
$username = "reddji";
$password = "urarameichiro";
$dbname = "coop-brain";
$port = 3306; // Custom port number

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

