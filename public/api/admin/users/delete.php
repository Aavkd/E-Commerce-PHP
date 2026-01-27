<?php
// public/api/admin/users/delete.php
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

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$id = $input['id'] ?? null;
$currentUserId = $_SESSION['user_id'] ?? null;

if (!$id) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing ID']);
    exit;
}

if ($id == $currentUserId) {
    http_response_code(400);
    echo json_encode(['error' => 'Cannot delete yourself']);
    exit;
}

try {
    $userModel = new User($pdo);
    $userModel->delete($id);
    echo json_encode(['success' => true, 'message' => 'User deleted']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
