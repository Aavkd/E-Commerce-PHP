<?php include 'includes/header.php'; ?>

<section class="hero" style="padding-top: 120px; padding-bottom: 60px; min-height: 40vh;">
    <div class="container">
        <h1>Your <span class="text-gradient">Cart</span></h1>
        <p>Review your selected revenue assets before checkout.</p>
    </div>
</section>

<section class="section-padding" style="padding-top: 0;">
    <div class="container">
        
        <!-- Empty State -->
        <div id="cart-empty" style="display: none; text-align: center; padding: 4rem;">
            <div style="font-size: 3rem; margin-bottom: 2rem; opacity: 0.2;">🛒</div>
            <h3 class="mb-1">Your cart is empty</h3>
            <p class="text-muted mb-2">Looks like you haven't added any assets yet.</p>
            <a href="/products.php" class="btn btn-primary">Browse Products</a>
        </div>

        <!-- Cart Content -->
        <div id="cart-content" style="display: none;">
            <div class="glass-panel" style="border-radius: 16px; overflow: hidden; margin-bottom: 3rem;">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead style="background: rgba(255,255,255,0.03); border-bottom: 1px solid var(--border-color);">
                        <tr>
                            <th style="padding: 1.5rem; color: var(--text-muted); font-weight: 500;">Product</th>
                            <th style="padding: 1.5rem; color: var(--text-muted); font-weight: 500;">Price</th>
                            <th style="padding: 1.5rem; color: var(--text-muted); font-weight: 500;">Quantity</th>
                            <th style="padding: 1.5rem; color: var(--text-muted); font-weight: 500;">Total</th>
                            <th style="padding: 1.5rem; color: var(--text-muted); font-weight: 500;"></th>
                        </tr>
                    </thead>
                    <tbody id="cart-table-body">
                        <!-- Items injected here -->
                    </tbody>
                </table>
            </div>

            <!-- Summary -->
            <div style="display: flex; justify-content: flex-end;">
                <div class="glass-panel" style="padding: 2rem; border-radius: 16px; width: 100%; max-width: 400px;">
                    <h3 class="mb-2" style="border-bottom: 1px solid var(--border-color); padding-bottom: 1rem;">Order Summary</h3>
                    
                    <div style="display: flex; justify-content: space-between; margin-bottom: 1rem; color: var(--text-muted);">
                        <span>Subtotal</span>
                        <span id="cart-total" style="color: var(--text-main); font-weight: 700;">$0.00</span>
                    </div>

                    <div style="display: flex; justify-content: space-between; margin-bottom: 2rem; color: var(--text-muted);">
                        <span>Tax</span>
                        <span>$0.00</span>
                    </div>

                    <a href="/checkout.php" class="btn btn-primary" style="width: 100%; text-align: center;">
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

<?php include 'includes/footer.php'; ?>
