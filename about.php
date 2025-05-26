<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us - Interior Design Hub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Learn more about Interior Design Hub, our philosophy, and how we transform spaces with style and functionality.">
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
                <li class="nav-item"><a class="nav-link" href="services.php">Our Projects</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                <li class="nav-item active"><a class="nav-link" href="about.php">About Us</a></li>
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

<div class="container-lg mt-5 about-section">
    <div class="row justify-content-center">
        <div class="col-md-10 text-center">
            <h2 class="mb-4">About Our Interior Design Services</h2>
            <p class="lead">We transform spaces into elegant, comfortable, and functional environments tailored to your needs.</p>
            <hr class="my-4">
            <p>Our team specializes in residential and commercial projects. We offer personalized consultations, detailed planning, and 3D visualizations to bring your vision to life.</p>
            <p>We value collaboration, creativity, and commitment to excellence, ensuring every project is unique and exceptional.</p>
        </div>
    </div>

    <div class="row mt-5 text-center">
        <div class="col-md-4">
            <img src="images/consultation.jpg" class="img-fluid rounded mb-3 shadow" alt="Consultation">
            <h5>Personal Consultations</h5>
            <p>Discuss your vision with our expert designers to find the perfect style for your space.</p>
        </div>
        <div class="col-md-4">
            <img src="images/moodboard.jpg" class="img-fluid rounded mb-3 shadow" alt="Moodboard">
            <h5>Custom Moodboards</h5>
            <p>We create inspirational moodboards that align with your taste and functionality goals.</p>
        </div>
        <div class="col-md-4">
            <img src="images/project-management.jpg" class="img-fluid rounded mb-3 shadow" alt="Project Management">
            <h5>End-to-End Management</h5>
            <p>From design to execution, we manage everything to ensure high-quality results.</p>
        </div>
    </div>

    <div class="row mt-5 justify-content-center">
        <div class="col-md-8 text-center">
            <a href="contact.php" class="btn btn-primary btn-lg mt-4">Let's Talk</a>
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
