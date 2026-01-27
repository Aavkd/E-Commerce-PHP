<?php
// api/admin/product_delete.php
header('Content-Type: application/json');
require_once '../../config/database.php';
require_once '../../src/Utils/Auth.php';
require_once '../../src/Models/Product.php';

if (!Auth::isAdmin()) {
    http_response_code(403);
    echo json_encode(['error' => 'Accès refusé']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$id = $input['id'] ?? null;

if (!$id) {
    http_response_code(400);
    echo json_encode(['error' => 'ID manquant']);
    exit;
}

$productModel = new Product($pdo);
$productModel->delete($id);

echo json_encode(['success' => true, 'message' => 'Produit supprimé']);
?>
