<?php include 'includes/header.php'; ?>

<section class="section-padding" style="min-height: 80vh; display: flex; align-items: center;">
    <div class="container">
        
        <div id="loading" class="text-center">
            <p class="text-muted">Loading product details...</p>
        </div>

        <div id="error-container" style="display: none; text-align: center;">
            <h2 class="mb-1">Product Not Found</h2>
            <p class="text-muted mb-2">The asset you are looking for does not exist or has been removed.</p>
            <a href="/products.php" class="btn btn-outline">Back to Products</a>
        </div>

        <div id="product-detail" class="grid-2" style="display: none; align-items: start;">
            <!-- Left: Image -->
            <div class="glass-panel" style="padding: 2rem; border-radius: 20px; text-align: center;">
                <div id="product-image-container" style="width: 100%; aspect-ratio: 4/3; display: flex; align-items: center; justify-content: center; overflow: hidden; border-radius: 12px; background: #14141a;">
                    <!-- Image injected here -->
                </div>
            </div>

            <!-- Right: Info -->
            <div class="product-info ml-4">
                <span id="product-tag" class="product-tag mb-1">ASSET</span>
                <h1 id="product-name" style="font-size: 3rem; margin-bottom: 0.5rem;" class="text-gradient">Product Name</h1>
                
                <div style="font-size: 2rem; font-weight: 700; color: var(--text-main); margin-bottom: 2rem;">
                    <span id="product-price">$0.00</span>
                </div>

                <div class="glass-panel" style="padding: 1.5rem; margin-bottom: 2rem; border-radius: 12px;">
                    <p id="product-description" style="color: var(--text-muted); line-height: 1.8;">
                        Description goes here...
                    </p>
                </div>

                <div class="product-actions" style="border-top: 1px solid var(--border-color); padding-top: 2rem;">
                    <button id="add-to-cart-btn" class="btn btn-primary" style="padding: 1rem 3rem; font-size: 1.1rem;">
                        Add to Cart
                    </button>
                    <p class="text-muted" style="font-size: 0.9rem; margin-top: 1rem;">
                        <span style="color: var(--success);">✓</span> Instant Delivery via Email
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>

<script src="/js/product-detail.js"></script>

<?php include 'includes/footer.php'; ?>
