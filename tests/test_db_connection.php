<?php
require_once __DIR__ . '/../config/database.php';

try {
    $db = new \PDO("mysql:host=localhost;dbname=agency_db;charset=utf8", "root", "");
    $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    echo "Connection successful!\n";
    
    // Check if tables exist
    $tables = ['users', 'items', 'orders', 'order_items', 'invoices'];
    foreach ($tables as $table) {
        $stmt = $db->query("SHOW TABLES LIKE '$table'");
        if ($stmt->rowCount() > 0) {
            echo "Table '$table' exists.\n";
        } else {
            echo "Table '$table' MISSING.\n";
        }
    }
} catch (\PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
    exit(1);
}
