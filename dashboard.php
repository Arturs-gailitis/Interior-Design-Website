<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require_once 'classes/Project.php';

$project = new Project();
$projects = $project->readAll();

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if ($project->delete($id)) {
        header("Location: dashboard.php?success=deleted");
        exit();
    } else {
        $error = "Failed to delete project";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Projects Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
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
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="services.php">Our Projects</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
            </ul>
        </div>
        <div class="d-flex">
            <a href="dashboard.php" class="btn btn-light ml-2">Project Dashboard</a>
            <a href="message_dashboard.php" class="btn btn-light ml-2">Message Dashboard</a>
            <button id="darkModeToggle" class="btn btn-light ml-2">Toggle Dark Mode</button>
        </div>
    </div>
</nav>

<div class="container mt-5 text-center">
    <h2>Projects Dashboard</h2>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success mt-3">
            <?php
            switch ($_GET['success']) {
                case 'added': echo "Project added successfully!"; break;
                case 'updated': echo "Project updated successfully!"; break;
                case 'deleted': echo "Project deleted successfully!"; break;
            }
            ?>
        </div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger mt-3"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <div class="text-right mb-3">
        <a href="add_project.php" class="btn btn-primary"> + Add New Project</a>
    </div>

    <?php if (!empty($projects)): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped bg-white text-center">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Location</th>
                    <th>Start Day</th>
                    <th>End Day</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projects as $p): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td><?= htmlspecialchars($p['title']) ?></td>
                    <td><?= htmlspecialchars($p['description']) ?></td>
                    <td><?= htmlspecialchars($p['location']) ?></td>
                    <td><?= htmlspecialchars($p['start_day']) ?></td>
                    <td><?= htmlspecialchars($p['end_day']) ?></td>
                    <td><?= htmlspecialchars($p['status']) ?></td>
                    <td>
                        <a href="edit_project.php?id=<?= $p['id'] ?>" class="btn btn-primary btn-sm" style="font-size: inherit; padding: 0.375rem 0.75rem;">Edit</a>
                        <a href="dashboard.php?delete=<?= $p['id'] ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this project?')" style="font-size: inherit; padding: 0.375rem 0.75rem;">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
        <p class="text-center mt-3">No projects found.</p>
    <?php endif; ?>
</div>

<footer id="footer" class="text-center mt-5">
    <p>&copy; <span id="years_before"></span><span id="corrent_year"></span> Project Management. All rights reserved. 
    <a href="https://www.instagram.com/">Instagram</a>, <a href="https://x.com/">X</a></p>
</footer>

<script src="js/script.js"></script>
<script src="js/DarkTheme.js"></script>
<script src="js/toggle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
