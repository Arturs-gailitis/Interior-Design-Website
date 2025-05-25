<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

require_once 'classes/Service.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $image = $_FILES['image'];

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($image['type'], $allowedTypes)) {
        $error = "Only JPG, PNG, and GIF images are allowed.";
    } elseif ($image['size'] > 2000000) {
        $error = "Image size must be less than 2MB.";
    } else {
        $service = new Service();
        if ($service->create($title, $desc, $image)) {
            header("Location: dashboard.php?success=added");
            exit();
        } else {
            $error = "Failed to add service";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Service</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
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
                <li class="nav-item"><a class="nav-link" href="dashboard.php">Dashboard</a></li>
            </ul>
        </div>
        <button id="darkModeToggle" class="btn btn-light">Toggle Dark Mode</button>
    </div>
</nav>

<div class="container mt-5">
    <h2>Add New Service</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Service Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Service</button>
        <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script src="js/DarkTheme.js"></script>
<script src="js/toggle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
