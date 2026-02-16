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
        ],
        [
            'name' => 'Google Maps Leads Scraper',
            'description' => 'Extract business names, phone numbers, and emails directly from Google Maps. The ultimate tool for B2B cold outreach.',
            'price' => 59.99,
            'image_url' => 'https://www.lepoint.fr/resizer/v2/VOJ2RQ22Q5NCVIZILKJ7ZJ66HQ.jpg?auth=ed196857f6541b2432a10af8dd11ea4497150a509aba9d1a17156d7b345bce0f&width=765&height=575&smart=true',
            'stock' => 150
        ],
        [
            'name' => 'YouTube AI Summarizer',
            'description' => 'Automatically transcribe and summarize any YouTube video using GPT-4. Save hours of watching and get the core insights.',
            'price' => 19.99,
            'image_url' => 'https://www.journaldugeek.com/app/uploads/2025/10/youtube.jpg',
            'stock' => 500
        ],
        [
            'name' => 'X Viral Thread Hook',
            'description' => 'Uses AI to analyze trending topics and generate viral hooks for your Twitter threads based on current engagement data.',
            'price' => 24.99,
            'image_url' => 'https://techcrunch.com/wp-content/uploads/2023/07/x-twitter.jpg?w=1024',
            'stock' => 200
        ],
        [
            'name' => 'Amazon Price Tracker Bot',
            'description' => 'Monitor price drops on Amazon in real-time. Get instant Discord or Telegram alerts when your target product hits its lowest price.',
            'price' => 34.99,
            'image_url' => 'https://www.lsa-conso.fr/mediatheque/1/2/0/000529021_896x598_c.jpg',
            'stock' => 80
        ],
        [
            'name' => 'Auto-Reply Discord Bot',
            'description' => 'AI-powered bot that handles customer support on your Discord server 24/7. Trained on your own documentation.',
            'price' => 45.00,
            'image_url' => 'https://www.telecom-sudparis.eu/wp-content/uploads/2025/06/discord.jpg',
            'stock' => 60
        ],
        [
            'name' => 'Pinterest Trends Predictor',
            'description' => 'Data analysis tool that identifies viral Pinterest trends 2 months before they peak. Perfect for drop-shippers.',
            'price' => 69.99,
            'image_url' => 'https://siecledigital.fr/wp-content/uploads/2025/10/pinterest.jpg',
            'stock' => 45
        ],
        [
            'name' => 'Email Cold Outreach AI',
            'description' => 'Generates hyper-personalized icebreakers for your cold emails by scraping the LinkedIn profile of your leads.',
            'price' => 89.00,
            'image_url' => 'https://images.unsplash.com/photo-1557200134-90327ee9fafa?w=800&q=80',
            'stock' => 120
        ],
        [
            'name' => 'SEO Keyword Gap Finder',
            'description' => 'Enter your competitor URL and instantly find the keywords they rank for that you are missing. Pure SEO gold.',
            'price' => 55.00,
            'image_url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&q=80',
            'stock' => 200
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