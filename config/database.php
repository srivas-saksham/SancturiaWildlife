<?php
define('DB_HOST', 'sql208.infinityfree.com');
define('DB_NAME', 'if0_41629643_sancturia');
define('DB_USER', 'if0_41629643');
define('DB_PASS', 'HFwQqgTE8fJQJ');

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
    die("Database connection failed.");
}
?>