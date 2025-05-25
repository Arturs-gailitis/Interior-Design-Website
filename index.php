<?php
session_start();
$welcomeBack = '';

if (isset($_SESSION['user_id']) && isset($_COOKIE['username'])) {
    $lastVisit = $_COOKIE['last_visit'] ?? 'a while ago';
    $welcomeBack = "Welcome back, " . htmlspecialchars($_COOKIE['username']) . "! Last visit: " . $lastVisit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Interior Design Hub</title>
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
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="services.php">Our Services</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
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

<?php if (!empty($welcomeBack)): ?>
    <div class="container mt-3">
        <div class="alert alert-info text-center"><?php echo $welcomeBack; ?></div>
    </div>
<?php endif; ?>

<section class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="jumbotron bg-light p-4">
                <h1 class="display-4">Elevate Your Living Space</h1>
                <p class="lead">Interior design solutions tailored to your style and needs.</p>
                <hr class="my-4">
                <p>Explore elegant, functional and modern interiors from our design experts.</p>
                <a class="btn btn-primary btn-lg" href="services.php" role="button">Explore Services</a>
            </div>
        </div>
    </div>
</section>

<section class="feature_section">
    <h2>Why Choose Us?</h2>
    <p><b>We specialize in modern, functional, and customized interior environments.</b></p>
    <p><b>Whether you're redesigning your home or office, we provide expert guidance.</b></p>
</section>

<section class="column">
    <h2>Our Key Focus Areas</h2>
    <ul>
        <li>Residential Interior Design</li>
        <li>Commercial and Office Space Planning</li>
        <li>3D Visualizations and Mood Boards</li>
        <li>Furniture and Decor Selection</li>
        <li>Lighting and Color Consultation</li>
    </ul>
</section>

<footer id="footer">
    <p>&copy; <span id="years_before"></span><span id="corrent_year"></span> Interior Design Hub. All rights reserved. 
    <a href="https://www.instagram.com/">Instagram</a>, <a href="https://x.com/">X</a></p>
</footer>

<script src="js/DarkTheme.js"></script>
<script src="js/script.js"></script>
<script src="js/toggle.js"></script>

</body>
</html>
