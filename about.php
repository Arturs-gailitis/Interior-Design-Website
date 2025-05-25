<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>About Us - Interior Design Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Interior Design Hub</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="services.php">Design Services</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link active" href="about.php">About Us</a></li>
            </ul>
        </div>
        <div class="d-flex">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="dashboard.php" class="btn btn-success">Dashboard</a>
                <a href="logout.php" class="btn btn-success ml-2">Logout</a>
            <?php else: ?>
                <a href="register.php" class="btn btn-success">Register</a>
                <a href="login.php" class="btn btn-success ml-2">Login</a>
            <?php endif; ?>
            <button id="darkModeToggle" class="btn btn-light ml-2">Toggle Dark Mode</button>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2>About Our Interior Design Services</h2>
            <p class="mt-4">We are passionate about transforming your living spaces into aesthetically pleasing and functional environments. Our team of experienced designers specializes in residential and commercial interior design, offering personalized consultations, mood board creation, and full-service decorating.</p>
            <p>Whether you are renovating your home, opening a new office, or simply looking to refresh a room, our team is here to help. We focus on blending style, comfort, and functionality to reflect your personal taste and needs.</p>
            <p>At Interior Design Hub, we believe that great design starts with understanding our clients' visions. Our process includes detailed planning, material selection, 3D visualizations, and project management to ensure a smooth and satisfying experience.</p>
        </div>
    </div>
</div>

<footer id="footer" class="text-center mt-5">
    <p>&copy; <span id="years_before"></span><span id="corrent_year"></span> Interior Design Hub. All rights reserved.
    <a href="https://www.instagram.com/">Instagram</a>, <a href="https://x.com/">X</a></p>
</footer>

<script src="js/DarkTheme.js"></script>
<script src="js/script.js"></script>
<script src="js/toggle.js"></script>
</body>
</html>
