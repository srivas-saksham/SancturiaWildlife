<?php
session_start();
require_once '../../config/database.php';
require_once '../../includes/auth.php';
require_once '../../includes/csrf.php';

// Capture redirect parameter from donate page
if (isset($_GET['redirect']) && $_GET['redirect'] === 'donate') {
    $_SESSION['redirect_after_login'] = 'donate';
    if (isset($_GET['sanctuary'])) {
        $_SESSION['donation_sanctuary'] = $_GET['sanctuary'];
    }
}

// Backend processing
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!validate_csrf_token($_POST['csrf_token'] ?? '')) {
        die('CSRF validation failed');
    }
    
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    // Validate inputs
    if (empty($email) || empty($password)) {
        $_SESSION['error'] = 'Please fill in all fields';
        header('Location: login.php');
        exit();
    }
    
    // Attempt login
    $result = login_user($email, $password);
    
    if ($result['success']) {
        $_SESSION['user_id'] = $result['user']['user_id'];
        $_SESSION['user_name'] = $result['user']['name'];
        $_SESSION['user_email'] = $result['user']['email'];
        
        // Regenerate session ID for security
        session_regenerate_id(true);
        
        // Check if user came from donate page
        if (isset($_SESSION['redirect_after_login']) && $_SESSION['redirect_after_login'] === 'donate') {
            $sanctuary = isset($_SESSION['donation_sanctuary']) ? $_SESSION['donation_sanctuary'] : 'General Fund';
            
            // Clear redirect session variables
            unset($_SESSION['redirect_after_login']);
            // Keep donation_sanctuary for the donate page to use
            
            header('Location: /pages/donate/donate.php?from_login=1&sanctuary=' . urlencode($sanctuary));
            exit();
        }
        
        // Default redirect to dashboard
        header('Location: ../dashboard/dashboard.php');
        exit();
    } else {
        $_SESSION['error'] = $result['error'];
        header('Location: login.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Sancturia Wildlife Conservation</title>
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
        <h1 class="brand-title">Welcome Back</h1>
        <p class="brand-tagline">
          <?php 
            if (isset($_SESSION['redirect_after_login']) && $_SESSION['redirect_after_login'] === 'donate') {
                echo 'Log in to complete your donation';
            } else {
                echo 'Continue your conservation journey';
            }
          ?>
        </p>
      </div>

      <div class="divider"></div>

      <!-- Login Form -->
      <div class="form-section">
        <form action="./login.php" method="POST">
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

          <!-- Email -->
          <div class="input-group">
            <label for="email" class="input-label">Email Address</label>
            <input type="email" id="email" name="email" class="input-field" placeholder="Enter your email address" required>
          </div>

          <!-- Password -->
          <div class="input-group">
            <label for="password" class="input-label">Password</label>
            <input type="password" id="password" name="password" class="input-field" placeholder="Enter your password" required>
          </div>

          <!-- Submit Button -->
          <button type="submit" class="submit-button">
            <?php 
              if (isset($_SESSION['redirect_after_login']) && $_SESSION['redirect_after_login'] === 'donate') {
                  echo 'Log In & Continue to Donate';
              } else {
                  echo 'Log In';
              }
            ?>
          </button>
        </form>
      </div>

      <!-- Signup Link -->
      <div class="login-link-section">
        <p class="login-link-text">Don't have an account? <a href="./signup.php" class="login-link">Sign up</a></p>
      </div>

      <!-- Footer Note -->
      <div class="footer-note">
        <p class="footer-text">
          By logging in, you agree to our 
          <a href="#" class="footer-links">Terms of Service</a> & 
          <a href="#" class="footer-links">Privacy Policy</a>
        </p>
      </div>
    </div>
  </div>
</body>
</html>