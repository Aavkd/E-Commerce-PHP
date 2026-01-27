<?php
// src/Models/Product.php

class Product {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT i.*, s.quantity FROM items i LEFT JOIN stock s ON i.id = s.id_item ORDER BY i.date_publication DESC");
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT i.*, s.quantity FROM items i LEFT JOIN stock s ON i.id = s.id_item WHERE i.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($name, $desc, $price, $image, $qty) {
        $stmt = $this->pdo->prepare("INSERT INTO items (name, description, price, image) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $desc, $price, $image]);
        $id = $this->pdo->lastInsertId();
        
        $stmtS = $this->pdo->prepare("INSERT INTO stock (id_item, quantity) VALUES (?, ?)");
        $stmtS->execute([$id, $qty]);
        return $id;
    }

    public function update($id, $name, $desc, $price, $image, $qty) {
        $stmt = $this->pdo->prepare("UPDATE items SET name=?, description=?, price=?, image=? WHERE id=?");
        $res = $stmt->execute([$name, $desc, $price, $image, $id]);
        
        // Update stock
        $stmtS = $this->pdo->prepare("UPDATE stock SET quantity=? WHERE id_item=?");
        $stmtS->execute([$qty, $id]);
        
        return $res;
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM items WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
