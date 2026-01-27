<?php
// api/products/list.php
header('Content-Type: application/json');
require_once '../../../config/database.php';
require_once '../../../src/Models/Product.php';

$productModel = new Product($pdo);
echo json_encode($productModel->getAll());
?>
