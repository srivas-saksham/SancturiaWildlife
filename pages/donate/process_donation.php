<?php
session_start();
require_once '../../config/database.php';
require_once '../../includes/csrf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!validate_csrf_token($_POST['csrf_token'] ?? '')) {
        $_SESSION['error'] = 'Security validation failed. Please try again.';
        header('Location: donate.php');
        exit();
    }
    
    // Get and sanitize form data
    $donor_name = trim($_POST['donorName'] ?? '');
    $donor_email = trim($_POST['donorEmail'] ?? '');
    $donor_phone = trim($_POST['donorPhone'] ?? '');
    $amount = floatval($_POST['donationAmount'] ?? 0);
    $recurring = $_POST['recurring'] ?? 'none';
    $sanctuary_name = $_POST['sanctuary_name'] ?? 'General Fund';
    
    // Validate form data
    if (empty($donor_name)) {
        $_SESSION['error'] = 'Please enter your name.';
        header('Location: donate.php');
        exit();
    }
    
    if (empty($donor_email) || !filter_var($donor_email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = 'Please enter a valid email address.';
        header('Location: donate.php');
        exit();
    }
    
    if (!empty($donor_phone) && !preg_match('/^[0-9]{10}$/', $donor_phone)) {
        $_SESSION['error'] = 'Please enter a valid 10-digit phone number.';
        header('Location: donate.php');
        exit();
    }
    
    if ($amount <= 0) {
        $_SESSION['error'] = 'Please enter a valid donation amount.';
        header('Location: donate.php');
        exit();
    }
    
    // Get user_id if logged in
    $user_id = $_SESSION['user_id'] ?? null;
    
    // Determine recurring type
    $recurring_type = 'none';
    if ($recurring === 'monthly') {
        $recurring_type = 'monthly';
    } elseif ($recurring === 'yearly') {
        $recurring_type = 'yearly';
    }
    
    try {
        // Start transaction
        $pdo->beginTransaction();
        
        // Insert donation
        $stmt = $pdo->prepare("
            INSERT INTO donations 
            (user_id, donor_name, donor_email, donor_phone, amount, sanctuary_name, recurring_type, donation_date) 
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        
        $stmt->execute([
            $user_id,
            $donor_name,
            $donor_email,
            $donor_phone,
            $amount,
            $sanctuary_name,
            $recurring_type
        ]);
        
        // Get the inserted donation ID
        $donation_id = $pdo->lastInsertId();
        
        // Update user donation total if logged in
        if ($user_id) {
            $stmt = $pdo->prepare("
                UPDATE users 
                SET donation_total = COALESCE(donation_total, 0) + ? 
                WHERE user_id = ?
            ");
            $stmt->execute([$amount, $user_id]);
        }
        
        // Commit transaction
        $pdo->commit();
        
        // Build redirect URL with donation details
        $redirect_url = sprintf(
            'thankyou.html?name=%s&email=%s&phone=%s&amount=%s&sanctuary=%s&recurring=%s&id=%s',
            urlencode($donor_name),
            urlencode($donor_email),
            urlencode($donor_phone),
            urlencode($amount),
            urlencode($sanctuary_name),
            urlencode($recurring_type),
            urlencode($donation_id)
        );
        
        // Clear any previous errors
        unset($_SESSION['error']);
        
        // Set success message
        $_SESSION['success'] = 'Thank you for your generous donation!';
        
        // Redirect to thank you page
        header('Location: ' . $redirect_url);
        exit();
        
    } catch (PDOException $e) {
        // Rollback transaction on error
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        
        // Log the error (make sure you have a log_error function or use error_log)
        error_log("Donation error: " . $e->getMessage());
        
        // Set user-friendly error message
        $_SESSION['error'] = 'An error occurred while processing your donation. Please try again or contact support.';
        header('Location: donate.php');
        exit();
    }
    
} else {
    // Not a POST request, redirect to donation page
    header('Location: donate.php');
    exit();
}
?>