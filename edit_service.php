<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
}

require_once 'classes/Service.php';

$service = new Service();

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = $_GET['id'];
$currentService = $service->getServiceById($id);

if (!$currentService) {
    header("Location: dashboard.php?error=notfound");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $image = $_FILES['image']['size'] > 0 ? $_FILES['image'] : null;

    if ($service->update($id, $title, $desc, $image)) {
        header("Location: dashboard.php?success=updated");
        exit();
    } else {
        $error = "Failed to update service";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Service</title>
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
    <h2>Edit Service</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title"
                   value="<?= htmlspecialchars($currentService['title']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?= htmlspecialchars($currentService['description']) ?></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Service Image (Leave empty to keep current)</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
            <?php
            $imgPath = 'images/services/' . $currentService['image'];
            if (!empty($currentService['image']) && file_exists($imgPath)): ?>
                <div class="mt-2">
                    <img src="<?= $imgPath ?>" alt="Current Image" style="max-height: 100px;" class="img-thumbnail">
                </div>
            <?php else: ?>
                <p class="text-muted">No image available.</p>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Update Service</button>
        <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script src="js/DarkTheme.js"></script>
<script src="js/toggle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
