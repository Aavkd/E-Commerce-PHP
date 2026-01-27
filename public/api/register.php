<?php
// api/register.php
header('Content-Type: application/json');

require_once '../../config/database.php';
require_once '../../src/Utils/Validator.php';
require_once '../../src/Models/User.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
    exit;
}

// Support JSON input
$input = json_decode(file_get_contents('php://input'), true) ?? $_POST;

$name = Validator::sanitize($input['name'] ?? '');
$email = Validator::sanitize($input['email'] ?? '');
$password = $input['password'] ?? '';

$errors = Validator::validateRequired(['name', 'email', 'password'], $input);
if (!Validator::validateEmail($email)) {
    $errors[] = "Email invalide.";
}

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode(['errors' => $errors]);
    exit;
}

$userModel = new User($pdo);

if ($userModel->findByEmail($email)) {
    http_response_code(409); // Conflict
    echo json_encode(['error' => 'Cet email est déjà utilisé.']);
    exit;
}

if ($userModel->create($name, $email, $password)) {
    echo json_encode(['success' => true, 'message' => 'Utilisateur créé.']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur lors de la création.']);
}
?>
