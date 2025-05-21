<?php

include "connection.php";



try {

    $connection = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);

} catch (PDOException $error) {

    die("Connection failed: " . $error->getMessage());
}

try {

    $usertable = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
    )";

    $designproject = "CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(60) NOT NULL UNIQUE,
    description VARCHAR(300) NOT NULL,
    location VARCHAR(150) NOT NULL,
    start_day DATE NOT NULL,
    end_day DATE,
    status VARCHAR(50) NOT NULL
    )";

    $messages = "CREATE TABLE messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    $review = "CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255) NOT NULL,
    review INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    $connection ->exec($usertable);
    $connection ->exec($designproject);
    $connection ->exec($messages);
    $connection ->exec($review);

    echo "<h2>Setup Complete!</h2>";
    echo "<p>Database and tables created successfully.</p>";
    echo "<p>You can now <a href='../index.php'>access the website</a>.</p>";
    
} catch (PDOException $quarryError) {

    die("The quarry statement have failed: " . $error->getMessage());
}
?>