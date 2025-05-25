<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "design-database";
$port = 3306;

try {

    $con = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);

} catch (PDOException $e) {
    die("Connection faled: " . $e->getMessage());
}

?>