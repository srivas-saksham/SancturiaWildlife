<?php
require_once __DIR__ . '/../config/database.php';

// Register new user
function register_user($name, $email, $password) {
    global $pdo;
    
    try {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            return ['success' => false, 'error' => 'Email already exists'];
        }
        
        // Hash password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        
        // Insert user
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $hashed_password]);
        
        return ['success' => true, 'user_id' => $pdo->lastInsertId()];
        
    } catch (PDOException $e) {
        return ['success' => false, 'error' => $e->getMessage()];
    }
}

// Login user
function login_user($email, $password) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("SELECT user_id, name, email, password FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if (!$user) {
            return ['success' => false, 'error' => 'Invalid email or password'];
        }
        
        // Verify password
        if (!password_verify($password, $user['password'])) {
            return ['success' => false, 'error' => 'Invalid email or password'];
        }
        
        // Update last login
        $stmt = $pdo->prepare("UPDATE users SET last_login = NOW() WHERE user_id = ?");
        $stmt->execute([$user['user_id']]);
        
        return ['success' => true, 'user' => $user];
        
    } catch (PDOException $e) {
        return ['success' => false, 'error' => $e->getMessage()];
    }
}

// Check if user is logged in
function check_login() {
    if (!isset($_SESSION['user_id'])) {
        return false;
    }
    return true;
}

// Get user data
function get_user_data($user_id) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("SELECT user_id, name, email, donation_total, adoptions_count, created_at FROM users WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetch();
    } catch (PDOException $e) {
        return null;
    }
}

// Logout user
function logout_user() {
    session_start();
    session_unset();
    session_destroy();
    return true;
}
?>