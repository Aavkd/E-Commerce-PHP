<?php
// public/admin/index.php
// Header includes auth check
require_once 'includes/header.php';
?>

<div class="admin-page-header">
    <h1 class="admin-page-title">Dashboard Overview</h1>
    <div>
        <span style="color: #94a3b8;">Welcome back, Admin</span>
    </div>
</div>

<!-- Stats Grid -->
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-label">Total Revenue</div>
        <div class="stat-value">$12,450</div>
        <div style="color: #10b981; font-size: 0.9rem;">+12% this month</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Active Orders</div>
        <div class="stat-value">24</div>
        <div style="color: #f59e0b; font-size: 0.9rem;">8 pending processing</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Products Active</div>
        <div class="stat-value">15</div>
        <div style="color: #60a5fa; font-size: 0.9rem;">All systems operational</div>
    </div>
    <div class="stat-card">
        <div class="stat-label">Total Users</div>
        <div class="stat-value">1,240</div>
        <div style="color: #10b981; font-size: 0.9rem;">+45 this week</div>
    </div>
</div>

<div class="admin-card">
    <h2 style="margin-bottom: 1rem; color: #fff;">Recent Activity</h2>
    <p style="color: #94a3b8;">System functioning normally. No critical alerts.</p>
</div>

</body>
</html>
