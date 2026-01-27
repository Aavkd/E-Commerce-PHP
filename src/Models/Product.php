<?php
// src/Models/Product.php

class Product {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM items ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM items WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($name, $desc, $price, $image, $qty) {
        $stmt = $this->pdo->prepare("INSERT INTO items (name, description, price, image_url, stock) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $desc, $price, $image, $qty]);
        return $this->pdo->lastInsertId();
    }

    public function update($id, $name, $desc, $price, $image, $qty) {
        $stmt = $this->pdo->prepare("UPDATE items SET name=?, description=?, price=?, image_url=?, stock=? WHERE id=?");
        return $stmt->execute([$name, $desc, $price, $image, $qty, $id]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM items WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
