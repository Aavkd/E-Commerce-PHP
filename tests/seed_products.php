<?php
require_once __DIR__ . '/../config/database.php';

try {
    $db = $pdo;

    // 1. On vide la table pour éviter les doublons et forcer la mise à jour des images
    $db->exec("DELETE FROM items");
    // Optionnel : Réinitialiser l'auto-incrément (si tu veux que l'ID recommence à 1)
    $db->exec("ALTER TABLE items AUTO_INCREMENT = 1");

    $products = [
        [
            'name' => 'TikTok Shop Intelligence Actor',
            'description' => 'Extracts real-time sales data, trending products, and competitor analysis from TikTok Shop. Perfect for e-commerce agencies.',
            'price' => 49.99,
            'image_url' => 'https://destinlibertefinanciere.com/wp-content/uploads/2024/05/main-qimg-829ce993ad803cc3b5aa20e8d3d9d210.jpg',
            'stock' => 100
        ],
        [
            'name' => 'Website to LLM Extractor',
            'description' => 'Converts any website content into structured markdown ready for RAG pipelines and LLM training. Handles JS-heavy sites.',
            'price' => 29.99,
            'image_url' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?w=800&q=80',
            'stock' => 999
        ],
        [
            'name' => 'LinkedIn Job Change Detector',
            'description' => 'Monitors target companies and alerts you when key decision-makers change jobs or new roles are posted. High-signal lead generation.',
            'price' => 79.99,
            'image_url' => 'https://images.unsplash.com/photo-1616469829581-73993eb86b02?w=800&q=80',
            'stock' => 50
        ],
        [
            'name' => 'Instagram Sentiment Analyzer',
            'description' => 'Analyzes comments and engagement on specialized niches to detect market sentiment and burning pains.',
            'price' => 39.99,
            'image_url' => 'https://mylittlebigweb.com/wp-content/uploads/2025/03/logo-instagram.jpeg',
            'stock' => 100
        ]
    ];

    echo "Cleaning and Seeding products...\n";

    $stmt = $db->prepare("INSERT INTO items (name, description, price, image_url, stock) VALUES (:name, :description, :price, :image_url, :stock)");

    foreach ($products as $product) {
        $stmt->execute([
            ':name' => $product['name'],
            ':description' => $product['description'],
            ':price' => $product['price'],
            ':image_url' => $product['image_url'],
            ':stock' => $product['stock']
        ]);
        echo "Added: " . $product['name'] . "\n";
    }

    echo "Done! All images have been updated.\n";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}