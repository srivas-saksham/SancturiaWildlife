<!DOCTYPE html>

<?php
session_start();
require_once '../../config/database.php';
require_once '../../includes/auth.php';
require_once '../../includes/csrf.php';

// Backend processing
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!validate_csrf_token($_POST['csrf_token'] ?? '')) {
        die('CSRF validation failed');
    }
    
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    if (empty($name) || empty($email) || empty($password)) {
        $_SESSION['error'] = 'Please fill in all fields';
        header('Location: signup.php');
        exit();
    }
    
    if ($password !== $confirm_password) {
        $_SESSION['error'] = 'Passwords do not match';
        header('Location: signup.php');
        exit();
    }
    
    if (strlen($password) < 8) {
        $_SESSION['error'] = 'Password must be at least 8 characters';
        header('Location: signup.php');
        exit();
    }
    
    $result = register_user($name, $email, $password);
    
    if ($result['success']) {
        $_SESSION['user_id'] = $result['user_id'];
        $_SESSION['user_name'] = $name;
        $_SESSION['user_email'] = $email;
        session_regenerate_id(true);
        header('Location: ../dashboard/dashboard.php');
        exit();
    } else {
        $_SESSION['error'] = $result['error'];
        header('Location: signup.php');
        exit();
    }
}
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Join Sancturia - Wildlife Conservation</title>
  <link rel="shortcut icon" href="/Assets_TBU/Background Images/Sancturia Logo Green.png" type="image/x-icon">
  <link rel="stylesheet" href="sign-style.css">
</head>
<body>
  <!-- Background Container -->
  <div class="background-container">
    <img src="/Assets_TBU/Background Images/signup-loginBg.jpeg" alt="Sancturia Wildlife Background" class="background-image">
    <div class="background-overlay"></div>
  </div>

  <!-- Main Container -->
  <div class="main-container">
    <div class="form-card">
      <!-- Brand Header -->
      <div class="brand-header">
        <h1 class="brand-title">Join Sancturia</h1>
        <p class="brand-tagline">Protect wildlife with us</p>
      </div>

      <div class="divider"></div>

      <!-- Signup Form -->
      <div class="form-section">
        <form action="./signup.php" method="POST">
          <?php
            require_once '../../includes/csrf.php';
            echo csrf_field(); 
          ?>

          <?php
            if (isset($_SESSION['error'])) {
                echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['error']) . '</div>';
                unset($_SESSION['error']);
            }
          ?>

          <!-- Full Name -->
          <div class="input-group">
            <label for="name" class="input-label">Full Name</label>
            <input type="text" id="name" name="name" class="input-field" placeholder="Enter your full name" required>
          </div>

          <!-- Email -->
          <div class="input-group">
            <label for="email" class="input-label">Email Address</label>
            <input type="email" id="email" name="email" class="input-field" placeholder="Enter your email address" required>
          </div>

          <!-- Password -->
          <div class="input-group">
            <label for="password" class="input-label">Password</label>
            <input type="password" id="password" name="password" class="input-field" placeholder="Create a secure password" required>
          </div>

          <!-- Confirm Password -->
          <div class="input-group">
            <label for="confirm-password" class="input-label">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirm_password" class="input-field" placeholder="Re-enter your password" required>
          </div>

          <!-- Submit Button -->
          <button type="submit" class="submit-button">Create Account</button>
        </form>
      </div>

      <!-- Login Link -->
      <div class="login-link-section">
        <p class="login-link-text">Already have an account? <a href="./login.php" class="login-link">Log in</a></p>
      </div>

      <!-- Footer Note -->
      <div class="footer-note">
        <p class="footer-text">
          By signing up, you agree to our 
          <a href="#" class="footer-links">Terms of Service</a> & 
          <a href="#" class="footer-links">Privacy Policy</a>
        </p>
      </div>
    </div>
  </div>
</body>
</html>