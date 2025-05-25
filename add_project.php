<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require_once 'classes/Project.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $location = $_POST['location'];
    $start_day = $_POST['start_day'];
    $end_day = $_POST['end_day'];
    $status = $_POST['status'];

    $project = new Project();
    if ($project->create($title, $desc, $location, $start_day, $end_day, $status)) {
        header("Location: dashboard.php?success=added");
        exit();
    } else {
        $error = "Failed to add project";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Add Project</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/styles.css" />
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Project Management</a>
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
    <h2>Add New Project</h2>
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required />
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location" name="location" required />
        </div>

        <div class="mb-3">
            <label for="start_day" class="form-label">Start Day</label>
            <input type="date" class="form-control" id="start_day" name="start_day" required />
        </div>

        <div class="mb-3">
            <label for="end_day" class="form-label">End Day</label>
            <input type="date" class="form-control" id="end_day" name="end_day" required />
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <option value="planned">Planned</option>
                <option value="in progress">In Progress</option>
                <option value="completed">Completed</option>
                <option value="on hold">On Hold</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add Project</button>
        <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script src="js/DarkTheme.js"></script>
<script src="js/toggle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
