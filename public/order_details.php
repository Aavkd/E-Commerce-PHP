<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/Utils/Auth.php';
require_once __DIR__ . '/../src/Models/Order.php';

Auth::startSession();

if (!Auth::isLoggedIn()) {
    header('Location: /login.php');
    exit;
}

if (!isset($_GET['id'])) {
    header('Location: /orders.php');
    exit;
}

$orderId = $_GET['id'];
$db = $pdo;
$orderModel = new Order($db);

// Fetch order to verify ownership
$order = $orderModel->getOrderById($orderId);

if (!$order || $order['user_id'] != $_SESSION['user_id']) {
    // Security: Not found or not authorized
    http_response_code(403);
    include 'includes/header.php';
    echo '<div class="container section-padding"><h1>Access Denied</h1><p>You cannot view this order.</p></div>';
    include 'includes/footer.php';
    exit;
}

$items = $orderModel->getOrderDetails($orderId);
$invoice = $orderModel->getInvoiceByOrderId($orderId);

include 'includes/header.php';
?>

<section class="section-padding" style="min-height: 80vh;">
    <div class="container">
        <div class="scroll-fade" style="margin-bottom: 2rem;">
            <a href="/orders.php" style="color: var(--text-muted); text-decoration: none;">&larr; Back to Orders</a>
            <h1 style="margin-top: 1rem;">Order #<?= htmlspecialchars($order['id']) ?></h1>
            <p style="color: var(--text-muted);">
                Placed on <?= date('F j, Y, g:i a', strtotime($order['created_at'])) ?>
                <span style="
                    margin-left: 1rem;
                    padding: 0.25rem 0.75rem; 
                    border-radius: 1rem; 
                    font-size: 0.85rem; 
                    background: <?= $order['status'] === 'completed' ? 'rgba(16, 185, 129, 0.2)' : 'rgba(245, 158, 11, 0.2)' ?>; 
                    color: <?= $order['status'] === 'completed' ? '#10b981' : '#f59e0b' ?>;
                ">
                    <?= ucfirst(htmlspecialchars($order['status'])) ?>
                </span>
            </p>
        </div>

        <div class="grid-2-1" style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
            
            <!-- Items List -->
            <div class="card scroll-fade delay-100">
                <h3 style="margin-bottom: 1.5rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem;">Items</h3>
                <div class="order-items">
                    <?php foreach ($items as $item): ?>
                        <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem; align-items: center;">
                            <div style="width: 60px; height: 60px; background: #222; border-radius: 8px; overflow: hidden; flex-shrink: 0;">
                                <?php if (!empty($item['image_url'])): ?>
                                    <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                                <?php else: ?>
                                    <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: #555;">img</div>
                                <?php endif; ?>
                            </div>
                            <div style="flex-grow: 1;">
                                <h4 style="margin: 0; font-size: 1rem;"><?= htmlspecialchars($item['name']) ?></h4>
                                <span style="color: var(--text-muted); font-size: 0.9rem;">Qty: <?= $item['quantity'] ?></span>
                            </div>
                            <div style="font-weight: 600;">
                                $<?= number_format($item['unit_price'], 2) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Summary & Billing -->
            <div class="card scroll-fade delay-200">
                <h3 style="margin-bottom: 1.5rem; border-bottom: 1px solid var(--border-color); padding-bottom: 1rem;">Summary</h3>
                
                <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                    <span style="color: var(--text-muted);">Subtotal</span>
                    <span>$<?= number_format($order['total_amount'], 2) ?></span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 1rem;">
                    <span style="color: var(--text-muted);">Tax</span>
                    <span>$0.00</span>
                </div>
                <div style="display: flex; justify-content: space-between; margin-bottom: 2rem; font-size: 1.2rem; font-weight: 700;">
                    <span>Total</span>
                    <span class="text-gradient">$<?= number_format($order['total_amount'], 2) ?></span>
                </div>

                <?php if ($invoice): ?>
                <h4 style="margin-bottom: 1rem; font-size: 1rem;">Billing Address</h4>
                <p style="color: var(--text-muted); font-size: 0.9rem; line-height: 1.6;">
                    <?= nl2br(htmlspecialchars($invoice['billing_address'])) ?><br>
                    <?= htmlspecialchars($invoice['city']) ?>, <?= htmlspecialchars($invoice['zip_code']) ?>
                </p>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
