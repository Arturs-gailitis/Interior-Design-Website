<?php
session_start();
require_once 'classes/Project.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$id = (int)$_GET['id'];
$projectHandler = new Project();
$currentProject = $projectHandler->getProjectById($id);

if (!$currentProject) {
    header("Location: dashboard.php?error=notfound");
    exit();
}

// CSRF token ģenerēšana, ja nav
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF token pārbaude
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Invalid CSRF token');
    }

    // Saņem dati no formas un nedaudz sanitizē
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $location = trim($_POST['location']);
    $start_day = trim($_POST['start_day']);
    $end_day = trim($_POST['end_day']);
    $status = trim($_POST['status']);

    // Var pievienot papildu validāciju šeit (piemēram, datumu formāts, obligātie lauki utt.)

    if ($projectHandler->update($id, $title, $description, $location, $start_day, $end_day, $status)) {
        // Lai tokens netiktu pārlietots, var to nomainīt
        unset($_SESSION['csrf_token']);
        header("Location: dashboard.php?success=updated");
        exit();
    } else {
        $error = "Failed to update project";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Edit Project</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet"
    />
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Project Management</a>
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="projects_dashboard.php">Dashboard</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2>Edit Project</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form method="POST" novalidate>
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>" />

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input
                type="text"
                id="title"
                name="title"
                class="form-control"
                value="<?= htmlspecialchars($currentProject['title']) ?>"
                required
            />
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea
                id="description"
                name="description"
                class="form-control"
                rows="4"
                required
            ><?= htmlspecialchars($currentProject['description']) ?></textarea>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input
                type="text"
                id="location"
                name="location"
                class="form-control"
                value="<?= htmlspecialchars($currentProject['location']) ?>"
                required
            />
        </div>

        <div class="mb-3">
            <label for="start_day" class="form-label">Start Date</label>
            <input
                type="date"
                id="start_day"
                name="start_day"
                class="form-control"
                value="<?= htmlspecialchars($currentProject['start_day']) ?>"
                required
            />
        </div>

        <div class="mb-3">
            <label for="end_day" class="form-label">End Date</label>
            <input
                type="date"
                id="end_day"
                name="end_day"
                class="form-control"
                value="<?= htmlspecialchars($currentProject['end_day']) ?>"
                required
            />
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-select" required>
                <?php
                $statuses = ['planned', 'ongoing', 'completed', 'cancelled'];
                foreach ($statuses as $s) {
                    $selected = ($currentProject['status'] === $s) ? 'selected' : '';
                    echo "<option value=\"" . htmlspecialchars($s) . "\" $selected>" . ucfirst($s) . "</option>";
                }
                ?>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Project</button>
        <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
></script>
</body>
</html>




