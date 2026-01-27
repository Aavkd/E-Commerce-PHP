<?php
// public/admin/products.php
require_once 'includes/header.php';
?>

<div class="admin-page-header">
    <h1 class="admin-page-title">Products</h1>
    <a href="product_form.php" class="btn btn-primary">
        <span>+ Add Product</span>
    </a>
</div>

<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th width="80">Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th width="150">Actions</th>
            </tr>
        </thead>
        <tbody id="product-list">
            <tr>
                <td colspan="6" style="text-align: center; color: #94a3b8;">Loading products...</td>
            </tr>
        </tbody>
    </table>
</div>

<script src="../js/admin-products.js"></script>
<script>
    // Initialize
    document.addEventListener('DOMContentLoaded', loadAdminProducts);
</script>

</body>
</html>
