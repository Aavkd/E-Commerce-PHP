<?php
// public/admin/includes/header.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SaaS Agency - Admin Dashboard</title>
    <link rel="stylesheet" href="/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@500;700&display=swap" rel="stylesheet">
    <!-- Admin Specific CSS -->
    <style>
        :root {
            --admin-nav-bg: #0f172a;
            --admin-content-bg: #1e293b;
        }
        body {
            background-color: #020617; /* Very dark blue/black */
        }
        .admin-nav {
            background: var(--admin-nav-bg);
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .admin-brand {
            font-family: 'Outfit', sans-serif;
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--color-primary);
            text-decoration: none;
        }
        .admin-brand span { color: #fff; }
        .admin-menu {
            display: flex;
            gap: 2rem;
        }
        .admin-menu a {
            color: #94a3b8;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        .admin-menu a:hover, .admin-menu a.active {
            color: #fff;
        }
        .admin-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }
        .admin-card {
            background: rgba(30, 41, 59, 0.5);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 1rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        .admin-page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }
        .admin-page-title {
            font-family: 'Outfit', sans-serif;
            font-size: 2rem;
            margin: 0;
            background: linear-gradient(135deg, #fff 0%, #94a3b8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: rgba(15, 23, 42, 0.6);
            padding: 1.5rem;
            border-radius: 0.75rem;
            border: 1px solid rgba(255,255,255,0.05);
        }
        .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--color-primary);
            margin: 0.5rem 0;
        }
        .stat-label {
            color: #94a3b8;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        /* Table Styles override for darkness */
        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }
        .admin-table th {
            text-align: left;
            padding: 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            color: #94a3b8;
            font-weight: 600;
        }
        .admin-table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            color: #e2e8f0;
        }
        .admin-table tr:hover {
            background: rgba(255,255,255,0.02);
        }
        .action-btn {
            padding: 0.25rem 0.75rem;
            border-radius: 0.25rem;
            font-size: 0.8rem;
            text-decoration: none;
            margin-left: 0.5rem;
        }
        .btn-edit { background: rgba(59, 130, 246, 0.2); color: #60a5fa; }
        .btn-delete { background: rgba(239, 68, 68, 0.2); color: #f87171; cursor: pointer; border: none; }
    </style>
    <!-- Auth Check Middleware -->
    <script src="/js/admin-auth.js"></script>
</head>
<body>

<nav class="admin-nav">
    <a href="/admin/index.php" class="admin-brand">AGENCY<span>OS</span></a>
    <div class="admin-menu">
        <a href="/admin/index.php">Dashboard</a>
        <a href="/admin/products.php">Products</a>
        <a href="/admin/users.php">Users</a>
        <a href="/" target="_blank">View Site ↗</a>
        <a href="/admin/logout.php" style="color: #f87171;">Logout</a>
    </div>
</nav>

<div class="admin-container">
