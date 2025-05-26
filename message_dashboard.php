<?php
require_once "classes/Message.php";

$messageObj = new Message();
$messages = $messageObj->getAll();

if (isset($_GET['delete'])) {
    $idToDelete = (int)$_GET['delete'];
    if ($messageObj->delete($idToDelete)) {
        header("Location: message_dashboard.php?success=deleted");
        exit;
    } else {
        $error = "Failed to delete message with ID $idToDelete.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Message Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Message Management</a>
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
    <h2>Messages Dashboard</h2>

    <?php if (isset($_GET['success'])): ?>
        <div class="alert alert-success mt-3">
            <?php
            switch ($_GET['success']) {
                case 'added': echo "Message added successfully!"; break;
                case 'updated': echo "Message updated successfully!"; break;
                case 'deleted': echo "Message deleted successfully!"; break;
            }
            ?>
        </div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger mt-3"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if (!empty($messages)): ?>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped bg-white text-center">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($messages as $msg): ?>
                <tr>
                    <td><?= $msg['id'] ?></td>
                    <td><?= htmlspecialchars($msg['name']) ?></td>
                    <td><?= htmlspecialchars($msg['email']) ?></td>
                    <td><?= nl2br(htmlspecialchars($msg['message'])) ?></td>
                    <td><?= htmlspecialchars($msg['created_at']) ?></td>
                    <td><?= htmlspecialchars($msg['Status']) ?></td>

                    <td>
                        <a href="edit_message.php?id=<?= $msg['id'] ?>" class="btn btn-primary btn-sm" style="font-size: inherit; padding: 0.375rem 0.75rem;">Edit</a>
                        <a href="message_dashboard.php?delete=<?= $msg['id'] ?>" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this message?')" style="font-size: inherit; padding: 0.375rem 0.75rem;">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
        <p class="text-center mt-3">No messages found.</p>
    <?php endif; ?>
</div>

<footer id="footer" class="text-center mt-5">
    <p>&copy; <span id="years_before"></span><span id="corrent_year"></span> Message Management. All rights reserved. 
    <a href="https://www.instagram.com/">Instagram</a>, <a href="https://x.com/">X</a></p>
</footer>

<script src="js/script.js"></script>
<script src="js/DarkTheme.js"></script>
<script src="js/toggle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

