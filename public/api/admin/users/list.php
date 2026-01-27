<?php
// public/api/admin/users/list.php
header('Content-Type: application/json');
require_once '../../../../config/database.php';
require_once '../../../../src/Utils/Auth.php';
require_once '../../../../src/Models/User.php';

// Auth Check
if (!Auth::isAdmin()) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

try {
    $userModel = new User($pdo);
    $users = $userModel->getAll();
    echo json_encode($users);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
