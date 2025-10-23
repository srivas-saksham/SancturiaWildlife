<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'sancturia_wildlife');
define('DB_USER', 'root');
define('DB_PASS', ''); // Empty for XAMPP default

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_PERSISTENT => true
        ]
    );
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>