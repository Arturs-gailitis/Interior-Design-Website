<?php
require_once 'classes/db.php';
session_start();

$success_message = "";
$error_message = "";

$user_name = '';
$user_email = '';
$user_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = trim($_POST['name'] ?? '');
    $user_email = trim($_POST['email'] ?? '');
    $user_message = trim($_POST['message'] ?? '');

    $isValid = !empty($user_name)
        && !empty($user_email)
        && !empty($user_message)
        && strlen($user_message) >= 10
        && filter_var($user_email, FILTER_VALIDATE_EMAIL);

    if ($isValid) {
        $pdo = (new Database())->getConnection();
        $stmt = $pdo->prepare("
            INSERT INTO messages (name, email, message, created_at)
            VALUES (?, ?, ?, NOW())
        ");
        if ($stmt->execute([$user_name, $user_email, $user_message])) {
            $success_message = "Message was successfully sent to the admin!";
            $user_name = $user_email = $user_message = '';
        } else {
            $error_message = "Message was not sent due to an unknown error!";
        }
    } else {
        $error_message = "Invalid input. Please fill all fields correctly.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Contact Form</title>
  <link rel="stylesheet" href="style/layout.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
</head>
<body>

    <div class="d-flex">
        <button id="changeDarkMode">Toggle Websites Light Mode</button>
    </div>

  <div class="container mt-5">
    <h2 class="mb-4">Contact us</h2>

    <?php if ($success_message): ?>
      <div class="alert alert-success" role="alert">
        <?= htmlspecialchars($success_message) ?>
      </div>
    <?php endif; ?>

    <?php if ($error_message): ?>
      <div class="alert alert-danger" role="alert">
        <?= htmlspecialchars($error_message) ?>
      </div>
    <?php endif; ?>

    <form id="contactForm" action="contact.php" method="post" novalidate>
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input
          type="text"
          class="form-control"
          id="name"
          name="name"
          required
          value="<?= htmlspecialchars($user_name) ?>"
        />
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input
          type="email"
          class="form-control"
          id="email"
          name="email"
          required
          value="<?= htmlspecialchars($user_email) ?>"
        />
      </div>

      <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea
          class="form-control"
          id="message"
          name="message"
          rows="5"
          required
        ><?= htmlspecialchars($user_message) ?></textarea>
      </div>

      <button type="submit" class="btn btn-primary">Send your message</button>
    </form>
  </div>

  <script src="javascript/form-validation.js"></script>
  <script src="javascript/darkMode.js"></script>

</body>
</html>

