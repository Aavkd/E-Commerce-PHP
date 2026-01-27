<?php
// api/logout.php
header('Content-Type: application/json');
require_once '../../src/Utils/Auth.php';

Auth::logout();
echo json_encode(['success' => true, 'message' => 'Déconnecté']);
?>
