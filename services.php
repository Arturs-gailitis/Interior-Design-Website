<?php
require_once 'classes/Service.php';
session_start();

$service = new Service();
$services = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    $keyword = trim($_POST['search']);
    $services = $service->searchByKeyword($keyword);
} else {
    $services = $service->readAll();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Interior Design Services</title>
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
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
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

<div class="container mt-4">
    <h2 class="text-center mb-4">Interior Design Services</h2>

    <form method="POST" class="form-inline justify-content-center mb-4">
        <input type="text" name="search" class="form-control mr-2" placeholder="Search services..." value="<?= htmlspecialchars($_POST['search'] ?? '') ?>">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <?php if (empty($services)): ?>
        <div class="alert alert-warning text-center">No services found.</div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($services as $s): ?>
                <div class="col-md-4 col-sm-6 mb-4">
                    <div class="card h-100">
                        <img src="images/services/<?= htmlspecialchars($s['image']) ?>" class="card-img-top service-img" alt="<?= htmlspecialchars($s['title']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($s['title']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($s['description']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
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
