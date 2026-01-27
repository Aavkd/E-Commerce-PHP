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
    public function getOrdersByUserId($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function getOrderDetails($orderId) {
        $stmt = $this->pdo->prepare("
            SELECT oi.*, i.name, i.image_url 
            FROM order_items oi 
            JOIN items i ON oi.item_id = i.id 
            WHERE oi.order_id = ?
        ");
        $stmt->execute([$orderId]);
        return $stmt->fetchAll();
    }

    public function getOrderById($orderId) {
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE id = ?");
        $stmt->execute([$orderId]);
        return $stmt->fetch();
    }

    public function getInvoiceByOrderId($orderId) {
        $stmt = $this->pdo->prepare("SELECT * FROM invoices WHERE order_id = ?");
        $stmt->execute([$orderId]);
        return $stmt->fetch();
    }
}
?>
