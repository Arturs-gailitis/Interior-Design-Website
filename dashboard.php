<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

require_once 'classes/Service.php';

$service = new Service();
$services = $service->readAll();

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if ($service->delete($id)) {
        header("Location: dashboard.php?success=deleted");
        exit();
    } else {
        $error = "Failed to delete service";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Video Games Website</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Main Page</a></li>
                <li class="nav-item"><a class="nav-link" href="services.php">List of Services</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About the Team</a></li>
            </ul>
        </div>
        <button id="darkModeToggle" class="btn btn-light ml-2">Toggle Dark Mode</button>
    </div>
</nav>

<div class="container mt-5 text-center">
    <h2>Services Dashboard</h2>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success mt-3">
            <?php
            switch ($_GET['success']) {
                case 'added': echo "Service added successfully!"; break;
                case 'updated': echo "Service updated successfully!"; break;
                case 'deleted': echo "Service deleted successfully!"; break;
            }
            ?>
        </div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger mt-3"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="text-right mb-3">
        <a href="add_service.php" class="btn btn-primary">➕ Add New Service</a>
    </div>

    <?php if (!empty($services)): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped bg-white text-center">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $s): ?>
                <tr>
                    <td><?= $s['id'] ?></td>
                    <td><?= htmlspecialchars($s['title']) ?></td>
                    <td><?= htmlspecialchars($s['description']) ?></td>
                    <td><?= htmlspecialchars($s['image']) ?></td>
                    <td>
                        <a href="edit_service.php?id=<?= $s['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="dashboard.php?delete=<?= $s['id'] ?>" class="btn btn-primary btn-sm"
                           onclick="return confirm('Are you sure you want to delete this service?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
        <p class="text-center mt-3">No services found.</p>
    <?php endif; ?>
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
