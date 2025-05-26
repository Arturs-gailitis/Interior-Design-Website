<?php
session_start();
require_once 'classes/Project.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $desc = trim($_POST['description']);
    $location = trim($_POST['location']);
    $start_day = trim($_POST['start_day']);
    $end_day = trim($_POST['end_day']);
    $status = trim($_POST['status']);
    $image_path = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $allowed_types = ['image/jpeg', 'image/png', 'image/webp'];
        $filename = time() . '_' . preg_replace('/\s+/', '_', basename($_FILES['image']['name']));
        $target_file = $upload_dir . $filename;

        if (in_array($_FILES['image']['type'], $allowed_types)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image_path = $target_file;
            } else {
                $error = "Image upload failed.";
            }
        } else {
            $error = "Only JPG, PNG, and WEBP files are allowed.";
        }
    }

    if (!$error) {
        $projectHandler = new Project();
        if ($projectHandler->create($title, $desc, $location, $start_day, $end_day, $status, $image_path)) {
            header("Location: dashboard.php?success=added");
            exit();
        } else {
            $error = "Failed to save the project.";
        }
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
    <h2>Add Project</h2>
    
    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" 
                   value="<?= isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '' ?>" required />
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?= isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '' ?></textarea>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location" name="location"
                   value="<?= isset($_POST['location']) ? htmlspecialchars($_POST['location']) : '' ?>" required />
        </div>

        <div class="mb-3">
            <label for="start_day" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="start_day" name="start_day"
                   value="<?= isset($_POST['start_day']) ? htmlspecialchars($_POST['start_day']) : '' ?>" required />
        </div>

        <div class="mb-3">
            <label for="end_day" class="form-label">End Date</label>
            <input type="date" class="form-control" id="end_day" name="end_day"
                   value="<?= isset($_POST['end_day']) ? htmlspecialchars($_POST['end_day']) : '' ?>" required />
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" id="status" name="status" required>
                <?php
                $statuses = ['planned', 'in progress', 'completed', 'on hold', 'cancelled'];
                $selectedStatus = $_POST['status'] ?? '';
                foreach ($statuses as $s) {
                    $selected = ($selectedStatus === $s) ? 'selected' : '';
                    echo "<option value=\"" . htmlspecialchars($s) . "\" $selected>" . ucfirst($s) . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Project Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" />
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


