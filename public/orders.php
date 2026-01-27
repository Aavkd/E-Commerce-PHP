<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/Utils/Auth.php';
require_once __DIR__ . '/../src/Models/Order.php';

Auth::startSession();

if (!Auth::isLoggedIn()) {
    header('Location: /login.php');
    exit;
}

$db = $pdo; // $pdo from config/database.php
$orderModel = new Order($db);
$orders = $orderModel->getOrdersByUserId($_SESSION['user_id']);

include 'includes/header.php';
?>

<section class="section-padding" style="min-height: 60vh;">
    <div class="container">
        <h1 class="scroll-fade">My Orders</h1>
        <p class="scroll-fade delay-100" style="color: var(--text-muted); margin-bottom: 2rem;">View your past purchases and download invoices.</p>

        <?php if (empty($orders)): ?>
            <div class="card scroll-fade delay-200" style="text-align: center; padding: 4rem 2rem;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🛍️</div>
                <h3>No orders yet</h3>
                <p style="color: var(--text-muted); margin-bottom: 2rem;">You haven't placed any orders yet.</p>
                <a href="/products.php" class="btn btn-primary">Browse Products</a>
            </div>
        <?php else: ?>
            <div class="table-container scroll-fade delay-200" style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; min-width: 600px;">
                    <thead>
                        <tr style="border-bottom: 1px solid var(--border-color); text-align: left;">
                            <th style="padding: 1rem; color: var(--text-muted);">Order ID</th>
                            <th style="padding: 1rem; color: var(--text-muted);">Date</th>
                            <th style="padding: 1rem; color: var(--text-muted);">Status</th>
                            <th style="padding: 1rem; color: var(--text-muted);">Total</th>
                            <th style="padding: 1rem; color: var(--text-muted);">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orders as $order): ?>
                            <tr style="border-bottom: 1px solid var(--border-color);">
                                <td style="padding: 1rem;">#<?= htmlspecialchars($order['id']) ?></td>
                                <td style="padding: 1rem;"><?= date('M j, Y', strtotime($order['created_at'])) ?></td>
                                <td style="padding: 1rem;">
                                    <span style="
                                        padding: 0.25rem 0.75rem; 
                                        border-radius: 1rem; 
                                        font-size: 0.85rem; 
                                        background: <?= $order['status'] === 'completed' ? 'rgba(16, 185, 129, 0.2)' : 'rgba(245, 158, 11, 0.2)' ?>; 
                                        color: <?= $order['status'] === 'completed' ? '#10b981' : '#f59e0b' ?>;
                                    ">
                                        <?= ucfirst(htmlspecialchars($order['status'])) ?>
                                    </span>
                                </td>
                                <td style="padding: 1rem;">$<?= number_format($order['total_amount'], 2) ?></td>
                                <td style="padding: 1rem;">
                                    <a href="/order_details.php?id=<?= $order['id'] ?>" class="btn-outline" style="padding: 0.4rem 1rem; font-size: 0.9rem;">View Details</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
