<?php
require_once 'classes/Project.php';
session_start();

$project = new Project();
$projects = $project->readAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Interior Design Projects</title>
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
                <li class="nav-item"><a class="nav-link" href="services.php">Our Projects</a></li>
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

<div class="container-fluid mt-4">
    <h2 class="text-center mb-4">Interior Design Projects</h2>

    <?php if (empty($projects)): ?>
        <div class="alert alert-warning text-center">No projects found.</div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($projects as $p): ?>
                <div class="col-md-6 mb-4">
                    <div class="card flex-row h-100">
                        <?php if (!empty($p['image_path'])): ?>
                            <div class="col-md-5 p-0">
                                <img src="<?= htmlspecialchars($p['image_path']) ?>" class="card-img-left img-fluid h-100" alt="<?= htmlspecialchars($p['title']) ?>">
                            </div>
                        <?php endif; ?>
                        <div class="col-md-7">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($p['title']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($p['description']) ?></p>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><strong>Location:</strong> <?= htmlspecialchars($p['location']) ?></li>
                                    <li class="list-group-item"><strong>Start Date:</strong> <?= htmlspecialchars($p['start_day']) ?></li>
                                    <li class="list-group-item"><strong>End Date:</strong> <?= htmlspecialchars($p['end_day']) ?></li>
                                    <li class="list-group-item"><strong>Status:</strong> <?= htmlspecialchars($p['status']) ?></li>
                                </ul>
                            </div>
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
