<?php
// api/admin/product_save.php
header('Content-Type: application/json');
require_once '../../config/database.php';
require_once '../../src/Utils/Auth.php';
require_once '../../src/Utils/Validator.php';
require_once '../../src/Models/Product.php';

if (!Auth::isAdmin()) {
    http_response_code(403);
    echo json_encode(['error' => 'Accès refusé']);
    exit;
}

// Handle Form Data (Multipart for images potentially, but API usually is JSON. 
// If JSON, we can't upload file easily. Let's assume Form Data for now or just text updates)
// The Prompt implies "Handle Create/Update".

$id = $_POST['id'] ?? null;
$name = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$price = $_POST['price'] ?? 0;
$quantity = $_POST['quantity'] ?? 0;
// Handle Image separately if needed, for API simplifiction assume existing image or passed filename
$image = $_POST['image'] ?? ''; 

$productModel = new Product($pdo);

if ($id) {
    // Update
    $productModel->update($id, $name, $description, $price, $image, $quantity);
    echo json_encode(['success' => true, 'message' => 'Produit mis à jour']);
} else {
    // Create
    $newId = $productModel->create($name, $description, $price, $image, $quantity);
    echo json_encode(['success' => true, 'id' => $newId]);
}
?>
