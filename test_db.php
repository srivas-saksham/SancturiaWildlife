<?php
require_once __DIR__ . '/config/database.php';

echo "<h2>Database Connection Test</h2>";

try {
    // Test connection
    echo "✅ Database connected successfully!<br><br>";
    
    // Count sanctuaries
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM sanctuaries");
    $result = $stmt->fetch();
    echo "✅ Sanctuaries in database: " . $result['count'] . "<br><br>";
    
    // Show first 3 sanctuaries
    $stmt = $pdo->query("SELECT name, location FROM sanctuaries LIMIT 3");
    echo "<strong>Sample Sanctuaries:</strong><br>";
    while ($row = $stmt->fetch()) {
        echo "- {$row['name']} ({$row['location']})<br>";
    }
    
    echo "<br>✅ Everything is working!";
    
} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>