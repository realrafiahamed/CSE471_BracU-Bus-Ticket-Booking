<?php

echo "Testing MySQL Connection...\n";

try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=bracu_transport', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✓ Database connection successful!\n";
    
    // Test if bookings table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'bookings'");
    if ($stmt->rowCount() > 0) {
        echo "✓ Bookings table already exists!\n";
    } else {
        echo "✗ Bookings table does not exist yet.\n";
    }
    
    // Show all tables
    $stmt = $pdo->query("SHOW TABLES");
    echo "\nExisting tables:\n";
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        echo "  - " . $row[0] . "\n";
    }
    
} catch (PDOException $e) {
    echo "✗ Connection failed: " . $e->getMessage() . "\n";
}
