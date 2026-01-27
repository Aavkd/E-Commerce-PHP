<?php
// public/api/admin/check_auth.php
header('Content-Type: application/json');
require_once '../../../config/database.php';
require_once '../../../src/Utils/Auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
    exit;
}

if (Auth::isAdmin()) {
    echo json_encode(['authenticated' => true, 'role' => 'admin']);
} else {
    http_response_code(401); // Unauthorized
    echo json_encode(['authenticated' => false, 'error' => 'Unauthorized']);
}
?>
