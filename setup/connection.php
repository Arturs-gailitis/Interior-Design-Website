<?php

$host = "localhost";
$username = "root";
$password = "arturs2003";
$database = "design-database";
$port = 3306;



try {

    $connection = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);

    echo "Connection successful!";

    echo "<p>To create database tables. You must go <a href='tables.php'>here</a>.</p>";

} catch (PDOException $error){

    die("Connection failed: " . $error->getMessage());
}
?>