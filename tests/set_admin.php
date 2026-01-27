<?php
// scripts/set_admin.php
require_once __DIR__ . '/../config/database.php';

$email = 'traorealexy@gmail.com';

try {
    // Check if user exists first
    $stmt = $pdo->prepare("SELECT id, name, role FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        echo "Error: User with email '$email' not found.\n";
        exit(1);
    }

    echo "User found: " . $user['name'] . " (Current Role: " . $user['role'] . ")\n";

    // Update to admin
    $update = $pdo->prepare("UPDATE users SET role = 'admin' WHERE email = ?");
    $result = $update->execute([$email]);

    if ($result) {
        echo "Success! updated role to 'admin' for user '$email'.\n";
    } else {
        echo "Failed to update role.\n";
    }

} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage() . "\n";
    exit(1);
}
?>
