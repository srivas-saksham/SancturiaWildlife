<?php
// check_session.php - Returns JSON with login status
session_start();

// Set JSON header
header('Content-Type: application/json');

// Prevent caching
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

// Check if user is logged in
if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    echo json_encode([
        'logged_in' => true,
        'user_id' => $_SESSION['user_id'],
        'user_name' => $_SESSION['user_name'] ?? 'User',
        'user_email' => $_SESSION['user_email'] ?? ''
    ]);
} else {
    echo json_encode([
        'logged_in' => false
    ]);
}
?>