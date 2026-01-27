<?php
// api/cart.php
header('Content-Type: application/json');
require_once '../src/Models/Cart.php';

$cart = new Cart();
$input = json_decode(file_get_contents('php://input'), true);
$action = $input['action'] ?? $_GET['action'] ?? '';

switch ($action) {
    case 'add':
        $id = $input['id'] ?? null;
        $name = $input['name'] ?? 'Produit';
        $price = $input['price'] ?? 0;
        $qty = $input['quantity'] ?? 1;
        if ($id) {
            $cart->add($id, $name, $price, $qty);
            echo json_encode(['success' => true, 'cart' => $cart->getItems(), 'total' => $cart->getTotal()]);
        } else {
            echo json_encode(['error' => 'ID manquant']);
        }
        break;

    case 'remove':
        $id = $input['id'] ?? null;
        if ($id) {
            $cart->remove($id);
            echo json_encode(['success' => true, 'cart' => $cart->getItems(), 'total' => $cart->getTotal()]);
        }
        break;

    case 'clear':
        $cart->clear();
        echo json_encode(['success' => true]);
        break;

    default:
        echo json_encode(['cart' => $cart->getItems(), 'total' => $cart->getTotal()]);
        break;
}
?>
