<?php
session_start();

$loggedOut = false;
$username = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['user_email'])) {
        date_default_timezone_set('Europe/Riga');
        setcookie("username", $_SESSION['user_email'], time() + (86400 * 30), "/");
        setcookie("last_visit", date("Y-m-d H:i:s"), time() + (86400 * 30), "/");
        $username = $_SESSION['user_email'];
    }

    $_SESSION = [];
    session_destroy();
    $loggedOut = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logout</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Video Games Website</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Main Page</a></li>
                <li class="nav-item"><a class="nav-link" href="services.php">List of Services</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About the Team</a></li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a class="btn btn-success me-2" href="dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="btn btn-success" href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="btn btn-success me-2" href="register.php">Register</a></li>
                    <li class="nav-item"><a class="btn btn-success" href="login.php">Login</a></li>
                <?php endif; ?>
                <button id="darkModeToggle" class="btn btn-light ms-2">Toggle Dark Mode</button>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="card mx-auto text-center p-4 shadow" style="max-width: 400px;">
        <h3>Logout</h3>

        <?php if ($loggedOut): ?>
            <p>You have been logged out.</p>
            <?php if (!empty($username)): ?>
                <p>Goodbye, <?php echo htmlspecialchars($username); ?>!</p>
            <?php endif; ?>
            <a href="index.php" class="btn btn-primary mt-3">Return to Home</a>
        <?php else: ?>
            <p>Are you sure you want to log out?</p>
            <form method="POST" action="">
                <button type="submit" class="btn btn-primary mt-3">Log Out</button>
            </form>
        <?php endif; ?>
    </div>
</div>

<footer id="footer" class="text-center mt-5">
    <p>&copy; <span id="years_before"></span><span id="corrent_year"></span> Our Website. All rights reserved. 
    <a href="https://www.instagram.com/">Instagram</a>, <a href="https://x.com/">X</a></p>
</footer>

<script src="js/script.js"></script>
<script src="js/DarkTheme.js"></script>
<script src="js/toggle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
