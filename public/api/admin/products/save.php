<?php
// public/api/admin/products/save.php
header('Content-Type: application/json');
require_once '../../../../config/database.php';
require_once '../../../../src/Utils/Auth.php';
require_once '../../../../src/Models/Product.php';
require_once '../../../../src/Utils/Validator.php';

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

$input = json_decode(file_get_contents('php://input'), true) ?? $_POST;

$id = $input['id'] ?? null;
$name = Validator::sanitize($input['name'] ?? '');
$description = Validator::sanitize($input['description'] ?? '');
$price = floatval($input['price'] ?? 0);
$stock = intval($input['stock'] ?? 0);
$image_url = $input['image_url'] ?? ''; // In a real app, handle file upload here

if (empty($name) || $price < 0) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid input']);
    exit;
}

try {
    $productModel = new Product($pdo);
    
    if ($id) {
        // Update
        $productModel->update($id, $name, $description, $price, $image_url, $stock);
        echo json_encode(['success' => true, 'message' => 'Product updated']);
    } else {
        // Create
        $newId = $productModel->create($name, $description, $price, $image_url, $stock);
        echo json_encode(['success' => true, 'message' => 'Product created', 'id' => $newId]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
