<?php
session_start();
require_once '../../config/database.php';
require_once '../../includes/csrf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!validate_csrf_token($_POST['csrf_token'] ?? '')) {
        die('CSRF validation failed');
    }
    
    // Get form data
    $donor_name = trim($_POST['donorName'] ?? '');
    $donor_email = trim($_POST['donorEmail'] ?? '');
    $donor_phone = trim($_POST['donorPhone'] ?? '');
    $amount = floatval($_POST['donationAmount'] ?? 0);
    $recurring = $_POST['recurring'] ?? 'none';
    
    // Validate
    if (empty($donor_name) || empty($donor_email) || $amount <= 0) {
        die('Invalid form data');
    }
    
    // Get user_id if logged in
    $user_id = $_SESSION['user_id'] ?? null;
    
    try {
        // Insert donation
        $stmt = $pdo->prepare("
            INSERT INTO donations 
            (user_id, donor_name, donor_email, donor_phone, amount, sanctuary_name, recurring_type) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        
        $sanctuary_name = $_POST['sanctuary_name'] ?? 'General Fund';
        $recurring_type = ($recurring === 'monthly') ? 'monthly' : (($recurring === 'yearly') ? 'yearly' : 'none');
        
        $stmt->execute([
            $user_id,
            $donor_name,
            $donor_email,
            $donor_phone,
            $amount,
            $sanctuary_name,
            $recurring_type
        ]);
        
        // Update user donation total if logged in
        if ($user_id) {
            $stmt = $pdo->prepare("UPDATE users SET donation_total = donation_total + ? WHERE user_id = ?");
            $stmt->execute([$amount, $user_id]);
        }
        
        // Redirect to thank you page
        header('Location: thankyou.html');
        exit();
        
    } catch (PDOException $e) {
        log_error("Donation error: " . $e->getMessage());
        die('An error occurred while processing your donation');
    }
} else {
    header('Location: donate.html');
    exit();
}
?>