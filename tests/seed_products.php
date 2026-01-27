<?php
require_once __DIR__ . '/../config/database.php';

try {
    $db = $pdo;

    $products = [
        [
            'name' => 'TikTok Shop Intelligence Actor',
            'description' => 'Extracts real-time sales data, trending products, and competitor analysis from TikTok Shop. Perfect for e-commerce agencies.',
            'price' => 49.99,
            'image_url' => 'https://ui-avatars.com/api/?name=Ti&background=000000&color=fff&size=256',
            'stock' => 100
        ],
        [
            'name' => 'Website to LLM Extractor',
            'description' => 'Converts any website content into structured markdown ready for RAG pipelines and LLM training. Handles JS-heavy sites.',
            'price' => 29.99,
            'image_url' => 'https://ui-avatars.com/api/?name=LLM&background=6366f1&color=fff&size=256',
            'stock' => 999
        ],
        [
            'name' => 'LinkedIn Job Change Detector',
            'description' => 'Monitors target companies and alerts you when key decision-makers change jobs or new roles are posted. High-signal lead generation.',
            'price' => 79.99,
            'image_url' => 'https://ui-avatars.com/api/?name=Jo&background=10b981&color=fff&size=256',
            'stock' => 50
        ],
        [
            'name' => 'Instagram Sentiment Analyzer',
            'description' => 'Analyzes comments and engagement on specialized niches to detect market sentiment and burning pains.',
            'price' => 39.99,
            'image_url' => 'https://ui-avatars.com/api/?name=In&background=ec4899&color=fff&size=256',
            'stock' => 100
        ]
    ];

    echo "Seeding products...\n";

    $stmt = $db->prepare("INSERT INTO items (name, description, price, image_url, stock) VALUES (:name, :description, :price, :image_url, :stock)");

    foreach ($products as $product) {
        // Check if exists
        $check = $db->prepare("SELECT id FROM items WHERE name = ?");
        $check->execute([$product['name']]);
        if ($check->rowCount() == 0) {
            $stmt->execute($product);
            echo "Added: " . $product['name'] . "\n";
        } else {
            echo "Skipped (Exists): " . $product['name'] . "\n";
        }
    }

    echo "Done!\n";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
