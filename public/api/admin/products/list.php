<?php
// public/api/admin/products/list.php
header('Content-Type: application/json');
require_once '../../../../config/database.php';
require_once '../../../../src/Utils/Auth.php';
require_once '../../../../src/Models/Product.php';

// Auth Check
if (!Auth::isAdmin()) {
    http_response_code(403);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

try {
    $productModel = new Product($pdo);
    $products = $productModel->getAll();
    echo json_encode($products);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
