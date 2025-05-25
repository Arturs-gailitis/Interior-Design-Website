<?php
$host = "localhost";
$username = "root";
$password = "arturs2003";
$database = "design-database";
$port = 3306;

try {

    $con = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);

} catch (PDOException $e) {
    die("Connection faled: " . $e->getMessage());
}

?>