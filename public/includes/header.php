<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MONEY MAKER | SaaS Agency & Automation</title>
    
    <!-- Design System -->
    <link rel="stylesheet" href="/css/style.css?v=3">
    
    <!-- Meta -->
    <meta name="description" content="We build revenue-driven SaaS, automations & Apify actors for data-hungry businesses.">
</head>
<body>

<header>
    <div class="container">
        <a href="/" class="logo">
            MONEY<span class="text-gradient">MAKER</span>
        </a>
        
        <nav class="nav-links">
            <a href="/">Home</a>
            <a href="/services.php">Services</a>
            <a href="/products.php">Products</a>
            <a href="/cases.php">Use Cases</a>
            <a href="/about.php">About</a>
        </nav>
        
        <div class="header-cta" style="display: flex; gap: 1.5rem; align-items: center;">
            <a href="/cart.php" style="position: relative; color: var(--text-main); display: flex; align-items: center;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 20C9 20.5523 8.55228 21 8 21C7.44772 21 7 20.5523 7 20C7 19.4477 7.44772 19 8 19C8.55228 19 9 19.4477 9 20Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M20 20C20 20.5523 19.5523 21 19 21C18.4477 21 18 20.5523 18 20C18 19.4477 18.4477 19 19 19C19.5523 19 20 19.4477 20 20Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M1 1H4L6.68 14.39C6.77144 14.8504 7.02191 15.264 7.38755 15.5583C7.75318 15.8526 8.2107 16.009 8.68 16H19.4C19.8693 16.009 20.3268 15.8526 20.6925 15.5583C21.0581 15.264 21.3086 14.8504 21.4 14.39L23 6H6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span id="cart-count" style="
                    position: absolute;
                    top: -8px;
                    right: -8px;
                    background: var(--primary);
                    color: white;
                    font-size: 0.7rem;
                    width: 18px;
                    height: 18px;
                    border-radius: 50%;
                    display: none;
                    align-items: center;
                    justify-content: center;
                    font-weight: 700;
                    border: 2px solid var(--bg-body);
                ">0</span>
            </a>
            <a href="/login.php" style="color: var(--text-main); font-weight: 500; font-size: 0.95rem; transition: color 0.2s;">Login</a>
            <a href="/contact.php" class="btn btn-primary">Book a Call</a>
        </div>
    </div>
</header>
<script src="/js/cart.js" defer></script>
