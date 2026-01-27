<?php
// src/Models/Order.php

class Order {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function createOrder($userId, $cartItems, $total, $billingInfo) {
        try {
            $this->pdo->beginTransaction();

            // 1. Order Header
            $stmt = $this->pdo->prepare("INSERT INTO orders (user_id, total_amount) VALUES (?, ?)");
            $stmt->execute([$userId, $total]);
            $orderId = $this->pdo->lastInsertId();

            // 2. Order Details & Stock validation/update
            foreach ($cartItems as $itemId => $item) {
                // Check stock first (optional robust check)
                
                // Add Line Item
                $stmt = $this->pdo->prepare("INSERT INTO order_items (order_id, item_id, quantity, unit_price) VALUES (?, ?, ?, ?)");
                $stmt->execute([$orderId, $itemId, $item['quantity'], $item['price']]);

                // Decrement Stock
                $stmt = $this->pdo->prepare("UPDATE items SET stock = stock - ? WHERE id = ?");
                $stmt->execute([$item['quantity'], $itemId]);
            }

            // 3. Invoice
            $stmt = $this->pdo->prepare("INSERT INTO invoices (user_id, order_id, amount, billing_address, city, zip_code) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $userId, 
                $orderId, 
                $total, 
                $billingInfo['address'], 
                $billingInfo['city'], 
                $billingInfo['zip']
            ]);

            $this->pdo->commit();
            return $orderId;

        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }
}
?>
