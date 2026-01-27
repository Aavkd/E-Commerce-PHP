<?php
// api/products/get.php
header('Content-Type: application/json');
require_once '../../../config/database.php';
require_once '../../../src/Models/Product.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    http_response_code(400);
    echo json_encode(['error' => 'ID manquant']);
    exit;
}

$productModel = new Product($pdo);
$product = $productModel->getById($id);

if ($product) {
    echo json_encode($product);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Produit non trouvé']);
}
?>
