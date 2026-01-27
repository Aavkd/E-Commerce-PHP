<?php
// api/checkout.php
header('Content-Type: application/json');
require_once '../config/database.php';
require_once '../src/Utils/Auth.php';
require_once '../src/Models/Cart.php';
require_once '../src/Models/Order.php';

if (!Auth::isLoggedIn()) {
    http_response_code(401);
    echo json_encode(['error' => 'Non authentifié']);
    exit;
}

$cart = new Cart();
$items = $cart->getItems();

if (empty($items)) {
    http_response_code(400);
    echo json_encode(['error' => 'Panier vide']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

// Validation of billing info
$address = $input['address'] ?? '';
$city = $input['city'] ?? '';
$zip = $input['zip'] ?? '';

if (!$address || !$city || !$zip) {
    echo json_encode(['error' => 'Adresse incomplète']);
    exit;
}

$orderModel = new Order($pdo);
$userId = $_SESSION['user_id'];
$total = $cart->getTotal();
$billing = ['address' => $address, 'city' => $city, 'zip' => $zip];

try {
    $orderId = $orderModel->createOrder($userId, $items, $total, $billing);
    $cart->clear();
    echo json_encode(['success' => true, 'order_id' => $orderId, 'message' => 'Commande validée']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
