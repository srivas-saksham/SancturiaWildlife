<?php
// Log errors to file
function log_error($message, $level = 'ERROR') {
    $log_dir = __DIR__ . '/../logs';
    if (!file_exists($log_dir)) {
        mkdir($log_dir, 0777, true);
    }
    
    $log_file = $log_dir . '/error.log';
    $timestamp = date('Y-m-d H:i:s');
    $log_message = "[$timestamp] [$level] $message\n";
    error_log($log_message, 3, $log_file);
}

// Display user-friendly error
function show_error($message = "An error occurred. Please try again.") {
    echo '<div class="alert alert-danger">' . htmlspecialchars($message) . '</div>';
}
?>