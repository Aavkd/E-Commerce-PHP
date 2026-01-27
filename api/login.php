<?php
// api/login.php
header('Content-Type: application/json');

require_once '../config/database.php';
require_once '../src/Utils/Validator.php';
require_once '../src/Utils/Auth.php';
require_once '../src/Models/User.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
$email = Validator::sanitize($input['email'] ?? '');
$password = $input['password'] ?? '';

$userModel = new User($pdo);
$user = $userModel->findByEmail($email);

if ($user && $userModel->verifyPassword($password, $user['password'])) {
    Auth::login($user);
    echo json_encode([
        'success' => true, 
        'user' => [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role']
        ]
    ]);
} else {
    http_response_code(401);
    echo json_encode(['error' => 'Email ou mot de passe incorrect.']);
}
?>
