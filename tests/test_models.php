<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/Models/Product.php';
require_once __DIR__ . '/../src/Models/User.php';
require_once __DIR__ . '/../src/Models/Order.php';

echo "🚀 Starting Model Tests...\n";

try {
    // Database connection is created in config/database.php which creates variable $pdo
    if (!isset($pdo)) {
        throw new Exception("\$pdo variable not found in database.php");
    }
    $db = $pdo;
    
    $productModel = new Product($db);
    $userModel = new User($db);
    $orderModel = new Order($db);

    // --- TEST 1: Product CRUD ---
    echo "\nTesting Product Model...\n";
    
    // Create
    $newProductId = $productModel->create("Test Product", "Description", 99.99, "image.jpg", 100);
    echo "✅ Product Created (ID: $newProductId)\n";

    // Read
    $product = $productModel->getById($newProductId);
    if ($product['name'] === 'Test Product' && $product['stock'] == 100) {
        echo "✅ Product Read Verified\n";
    } else {
        throw new Exception("Product Read Failed: " . json_encode($product));
    }

    // Update
    $productModel->update($newProductId, "Updated Product", "Desc", 199.99, "img.jpg", 50);
    $product = $productModel->getById($newProductId);
    if ($product['stock'] == 50) {
        echo "✅ Product Update Verified\n";
    } else {
        throw new Exception("Product Update Failed");
    }

    // --- TEST 2: Order Creation & Stock Decrement ---
    echo "\nTesting Order Model...\n";

    // Setup User
    $email = "testUser" . time() . "@example.com";
    $userModel->create("Test User", $email, "password123");
    $user = $userModel->findByEmail($email);
    echo "✅ Dummy User Created (ID: {$user['id']})\n";

    // Create Order
    $cartItems = [
        $newProductId => [
            'quantity' => 5,
            'price' => 199.99
        ]
    ];
    $billing = ['address' => '123 Test St', 'city' => 'Test City', 'zip' => '10000'];
    
    $orderId = $orderModel->createOrder($user['id'], $cartItems, 999.95, $billing);
    echo "✅ Order Created (ID: $orderId)\n";

    // Verify Stock Decrement (50 - 5 = 45)
    $product = $productModel->getById($newProductId);
    if ($product['stock'] == 45) {
        echo "✅ Stock Decrement Verified (Stock is 45)\n";
    } else {
        throw new Exception("Stock Decrement Failed. Expected 45, got {$product['stock']}");
    }

    // --- TEST 3: Order Retrieval ---
    echo "\nTesting Order Retrieval...\n";

    // 1. Get Orders by User
    $orders = $orderModel->getOrdersByUserId($user['id']);
    if (count($orders) > 0) {
        echo "✅ getOrdersByUserId Verified (Found " . count($orders) . " orders)\n";
    } else {
        throw new Exception("getOrdersByUserId Failed: No orders found");
    }

    // 2. Get Order Details
    $retrievedOrderId = $orders[0]['id'];
    $items = $orderModel->getOrderDetails($retrievedOrderId);
    if (count($items) === 1 && $items[0]['item_id'] == $newProductId) {
        echo "✅ getOrderDetails Verified\n";
    } else {
        throw new Exception("getOrderDetails Failed");
    }

    // 3. Get Invoice
    $invoice = $orderModel->getInvoiceByOrderId($retrievedOrderId);
    if ($invoice && $invoice['city'] === 'Test City') {
        echo "✅ getInvoiceByOrderId Verified\n";
    } else {
        throw new Exception("getInvoiceByOrderId Failed");
    }

    // --- CLEANUP ---
    echo "\nCleaning up...\n";
    $productModel->delete($newProductId);
    // Delete user (cascade should handle orders/invoices if foreign keys are set up, but let's be safe later)
    $stmt = $db->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$user['id']]);
    
    echo "✨ All Tests Passed Successfully!\n";

} catch (Exception $e) {
    echo "❌ TEST FAILED: " . $e->getMessage() . "\n";
    exit(1);
}
