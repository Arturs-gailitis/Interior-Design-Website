<?php

require_once "db.php";

try {

    $con = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);

    $designproject = "CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(60) NOT NULL UNIQUE,
    description VARCHAR(2000) NOT NULL,
    location VARCHAR(150) NOT NULL,
    start_day DATE NOT NULL,
    end_day DATE,
    status VARCHAR(50) NOT NULL,
    image_path VARCHAR(255) NOT NULL
)";

    $user = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
    )";

    $messages = "CREATE TABLE messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255),
        email VARCHAR(255),
        message TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        Status VARCHAR(255)
    )";


    $con->exec($designproject);

    $con->exec($user);

    $con->exec($messages);

    echo "<h2>Setup Complete!</h2>";
    echo "<p>Database and tables created successfully.</p>";
    echo "<p>You can now <a href='../index.php'>access the website</a>.</p>";
    
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>