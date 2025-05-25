<?php
session_start();
require_once __DIR__ . '/classes/Database.php';

$db = new Database();
$con = $db->getConnection();

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email)) {
        $errors['email'] = 'E-mail is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'E-mail is in wrong format';
    }

    if (empty($password)) {
        $errors['password'] = 'Password is required';
    }

    if (empty($errors)) {
        try {
            $stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_email'] = $user['email'];
                $_SESSION['username'] = $user['username'];
                header("Location: index.php");
                exit;
            } else {
                $errors['login'] = 'Invalid email or password';
            }
        } catch (PDOException $e) {
            $errors['database'] = 'Database error: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

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
            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a class="btn btn-success mr-2" href="dashboard.php">Dashboard</a></li>
                    <li class="nav-item"><a class="btn btn-success" href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="btn btn-success mr-2" href="register.php">Register</a></li>
                    <li class="nav-item"><a class="btn btn-success" href="login.php">Login</a></li>
                <?php endif; ?>
                <button id="darkModeToggle" class="btn btn-light ml-2">Toggle Dark Mode</button>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center mb-4">Login</h2>
    <form method="POST" action="" class="mx-auto" style="max-width: 500px;">
        <div class="form-group">
            <label for="email">Email:</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" 
                value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
            <?php if (isset($errors['email'])): ?>
                <div class="invalid-feedback"><?php echo $errors['email']; ?></div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>">
            <?php if (isset($errors['password'])): ?>
                <div class="invalid-feedback"><?php echo $errors['password']; ?></div>
            <?php endif; ?>
        </div>

        <?php if (isset($errors['login'])): ?>
            <div class="alert alert-danger"><?php echo $errors['login']; ?></div>
        <?php endif; ?>

        <?php if (isset($errors['database'])): ?>
            <div class="alert alert-danger"><?php echo $errors['database']; ?></div>
        <?php endif; ?>

        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
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
