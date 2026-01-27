<?php
// public/admin/product_form.php
require_once 'includes/header.php';
?>

<div class="admin-page-header">
    <h1 class="admin-page-title" id="form-title">Add Product</h1>
    <a href="products.php" class="btn btn-outline" style="border: 1px solid rgba(255,255,255,0.1); color: #fff;">
        ← Back to List
    </a>
</div>

<div class="admin-card" style="max-width: 800px; margin: 0 auto;">
    <form id="product-form" class="auth-form" style="max-width: 100%;">
        <input type="hidden" id="product_id" name="id">
        
        <div class="form-group">
            <label for="name" style="color: #cbd5e1;">Product Name</label>
            <input type="text" id="name" name="name" required placeholder="e.g. TikTok Scraper" 
                   style="background: rgba(15, 23, 42, 0.5); border-color: rgba(255,255,255,0.1); color: #fff;">
        </div>

        <div class="grid-2" style="gap: 1.5rem; margin-bottom: 1.5rem;">
            <div class="form-group" style="margin: 0;">
                <label for="price" style="color: #cbd5e1;">Price ($)</label>
                <input type="number" id="price" name="price" step="0.01" required placeholder="49.99"
                       style="background: rgba(15, 23, 42, 0.5); border-color: rgba(255,255,255,0.1); color: #fff;">
            </div>
            <div class="form-group" style="margin: 0;">
                <label for="stock" style="color: #cbd5e1;">Stock / Licenses</label>
                <input type="number" id="stock" name="stock" value="999" required
                       style="background: rgba(15, 23, 42, 0.5); border-color: rgba(255,255,255,0.1); color: #fff;">
            </div>
        </div>

        <div class="form-group">
            <label for="description" style="color: #cbd5e1;">Description</label>
            <textarea id="description" name="description" rows="5" required placeholder="Product details..."
                      style="width: 100%; padding: 1rem; border-radius: 0.5rem; background: rgba(15, 23, 42, 0.5); border: 1px solid rgba(255,255,255,0.1); color: #fff; font-family: var(--font-body);"></textarea>
        </div>

        <div class="form-group">
            <label for="image_url" style="color: #cbd5e1;">Image URL</label>
            <input type="text" id="image_url" name="image_url" placeholder="https://..."
                   style="background: rgba(15, 23, 42, 0.5); border-color: rgba(255,255,255,0.1); color: #fff;">
            <small style="color: #64748b; display: block; margin-top: 0.5rem;">For now, paste an external image URL.</small>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%;">
            <span id="submit-btn-text">Save Product</span>
        </button>
        
        <div id="form-message" class="message" style="margin-top: 1rem;"></div>
    </form>
</div>

<script src="../js/admin-products.js"></script>
<script>
    // Check for ID in URL to switch to Edit Mode
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    if (id) {
        document.getElementById('form-title').textContent = 'Edit Product';
        document.getElementById('submit-btn-text').textContent = 'Update Product';
        loadProductForEdit(id);
    }
</script>

</body>
</html>
