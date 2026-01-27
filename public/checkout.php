<?php include 'includes/header.php'; ?>

<section class="hero" style="padding-top: 120px; padding-bottom: 60px;">
    <div class="container">
        <h1>Secure <span class="text-gradient">Checkout</span></h1>
    </div>
</section>

<section class="section-padding" style="padding-top: 0;">
    <div class="container">
        <div class="grid-2">
            
            <!-- Left: Billing Form -->
            <div>
                <div class="glass-panel" style="padding: 2.5rem; border-radius: 20px;">
                    <h3 class="mb-2">Billing Details</h3>
                    
                    <form id="checkout-form">
                        <div style="margin-bottom: 1.5rem;">
                            <label style="display: block; color: var(--text-muted); margin-bottom: 0.5rem;">Full Name</label>
                            <input type="text" name="name" required style="width: 100%; padding: 0.8rem; background: rgba(255,255,255,0.05); border: 1px solid var(--border-color); color: white; border-radius: 8px;">
                        </div>

                        <div style="margin-bottom: 1.5rem;">
                            <label style="display: block; color: var(--text-muted); margin-bottom: 0.5rem;">Email Address</label>
                            <input type="email" name="email" required style="width: 100%; padding: 0.8rem; background: rgba(255,255,255,0.05); border: 1px solid var(--border-color); color: white; border-radius: 8px;">
                        </div>

                        <div style="margin-bottom: 1.5rem;">
                            <label style="display: block; color: var(--text-muted); margin-bottom: 0.5rem;">Address</label>
                            <input type="text" id="address" name="address" required style="width: 100%; padding: 0.8rem; background: rgba(255,255,255,0.05); border: 1px solid var(--border-color); color: white; border-radius: 8px;">
                        </div>

                        <div class="grid-2" style="gap: 1.5rem; margin-bottom: 1.5rem; grid-template-columns: 1fr 1fr;">
                            <div>
                                <label style="display: block; color: var(--text-muted); margin-bottom: 0.5rem;">City</label>
                                <input type="text" id="city" name="city" required style="width: 100%; padding: 0.8rem; background: rgba(255,255,255,0.05); border: 1px solid var(--border-color); color: white; border-radius: 8px;">
                            </div>
                            <div>
                                <label style="display: block; color: var(--text-muted); margin-bottom: 0.5rem;">Zip Code</label>
                                <input type="text" id="zip" name="zip" required style="width: 100%; padding: 0.8rem; background: rgba(255,255,255,0.05); border: 1px solid var(--border-color); color: white; border-radius: 8px;">
                            </div>
                        </div>

                        <h3 class="mb-2" style="margin-top: 3rem;">Payment Method</h3>
                        <div style="background: rgba(255,255,255,0.05); padding: 1.5rem; border-radius: 12px; border: 1px solid var(--border-color);">
                            <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                                <span style="font-weight: 600;">Credit Card</span>
                                <span style="color: var(--text-muted);">(Secure Processing)</span>
                            </div>
                            <!-- Mock Card Fields -->
                            <input type="text" placeholder="Card Number" style="width: 100%; padding: 0.8rem; margin-bottom: 1rem; background: rgba(0,0,0,0.2); border: 1px solid var(--border-color); color: white; border-radius: 8px;">
                            <div style="display: flex; gap: 1rem;">
                                <input type="text" placeholder="MM/YY" style="width: 50%; padding: 0.8rem; background: rgba(0,0,0,0.2); border: 1px solid var(--border-color); color: white; border-radius: 8px;">
                                <input type="text" placeholder="CVC" style="width: 50%; padding: 0.8rem; background: rgba(0,0,0,0.2); border: 1px solid var(--border-color); color: white; border-radius: 8px;">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 2rem;">Complete Order</button>
                    </form>
                </div>
            </div>

            <!-- Right: Summary -->
            <div>
                <div class="glass-panel" style="padding: 2rem; border-radius: 16px;">
                    <h3 class="mb-2">Your Order</h3>
                    <div id="checkout-items" style="margin-bottom: 1.5rem;">
                        <!-- Items injected here -->
                        <p class="text-muted">Loading items...</p>
                    </div>
                    
                    <div style="border-top: 1px solid var(--border-color); padding-top: 1.5rem;">
                        <div style="display: flex; justify-content: space-between; font-size: 1.25rem; font-weight: 700;">
                            <span>Total</span>
                            <span id="checkout-total">$0.00</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script src="/js/checkout.js"></script>

<?php include 'includes/footer.php'; ?>
