<?php
require_once '../config/database.php';

header('Content-Type: application/json');

try {
    $stmt = $pdo->query("SELECT * FROM sanctuaries ORDER BY name");
    $sanctuaries = $stmt->fetchAll();
    
    echo json_encode([
        'success' => true,
        'data' => $sanctuaries,
        'count' => count($sanctuaries)
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Database error'
    ]);
}
?>