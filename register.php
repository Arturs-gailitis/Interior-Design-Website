<?php
require_once __DIR__ . '/classes/Database.php';

$db = new Database();
$con = $db->getConnection();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username)) {
        $errors['username'] = 'Username is required';
    } elseif (strlen($username) < 4) {
        $errors['username'] = 'Username must be at least 4 characters';
    }

    if (empty($email)) {
        $errors['email'] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format';
    }

    if (empty($password)) {
        $errors['password'] = 'Password is required';
    } elseif (strlen($password) < 8) {
        $errors['password'] = 'Password must be at least 8 characters';
    }

    if ($password !== $confirm_password) {
        $errors['confirm_password'] = 'Passwords do not match';
    }

    if (empty($errors)) {
       
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        try {
            $stmt = $con->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            if ($stmt->execute([$username, $email, $hashed_password])) {
                            if (!headers_sent()) {
                                       header("Location: index.php");
                    exit();
                } else {
                                       echo '<script>window.location.href = "index.php";</script>';
                    exit();
                }
            
            }
        } catch (PDOException $e) {
           
            $errors['database'] = 'Registration failed: ' . $e->getMessage();
            }

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Video Games Website</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Main Page</a></li>
                <li class="nav-item"><a class="nav-link" href="services.php">List of Services</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact Us</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About the Team</a></li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="btn btn-success me-2" href="register.php">Register</a></li>
                <li class="nav-item"><a class="btn btn-success" href="login.php">Login</a></li>
                <button id="darkModeToggle" class="btn btn-light ms-2">Toggle Dark Mode</button>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="card p-4 shadow mx-auto" style="max-width: 500px;">
        <h2 class="text-center mb-4">Register</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username"
                    value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>">
                <?php if (isset($errors['username'])): ?>
                    <div class="text-danger"><?php echo $errors['username']; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                <?php if (isset($errors['email'])): ?>
                    <div class="text-danger"><?php echo $errors['email']; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <?php if (isset($errors['password'])): ?>
                    <div class="text-danger"><?php echo $errors['password']; ?></div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="confirm_password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                <?php if (isset($errors['confirm_password'])): ?>
                    <div class="text-danger"><?php echo $errors['confirm_password']; ?></div>
                <?php endif; ?>
            </div>

            <?php if (isset($errors['database'])): ?>
                <div class="text-danger mb-3"><?php echo $errors['database']; ?></div>
            <?php endif; ?>

            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
    </div>
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
