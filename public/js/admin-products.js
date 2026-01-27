/**
 * public/js/admin-products.js
 * Handles CRUD operations for admin product management
 */

// Load all products into the table
async function loadAdminProducts() {
    const listEl = document.getElementById('product-list');
    if (!listEl) return;

    try {
        const response = await fetch('/api/admin/products/list.php');
        const products = await response.json();

        if (!response.ok) throw new Error(products.error || 'Failed to fetch');

        listEl.innerHTML = products.map(p => `
            <tr>
                <td>
                    <img src="${p.image_url || '/images/placeholder.jpg'}" alt="" 
                         style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px; background: #334155;">
                </td>
                <td style="font-weight: 500; color: #fff;">${escapeHtml(p.name)}</td>
                <td>$${parseFloat(p.price).toFixed(2)}</td>
                <td>${p.stock}</td>
                <td>
                    <span style="font-size: 0.75rem; padding: 0.2rem 0.5rem; background: rgba(16, 185, 129, 0.2); color: #34d399; border-radius: 4px;">
                        Active
                    </span>
                </td>
                <td>
                    <a href="product_form.php?id=${p.id}" class="action-btn btn-edit">Edit</a>
                    <button onclick="deleteProduct(${p.id})" class="action-btn btn-delete">Delete</button>
                </td>
            </tr>
        `).join('');

        if (products.length === 0) {
            listEl.innerHTML = '<tr><td colspan="6" class="text-center" style="padding: 2rem;">No products found.</td></tr>';
        }

    } catch (error) {
        console.error('Error:', error);
        listEl.innerHTML = `<tr><td colspan="6" style="color: #ef4444; text-align: center;">Error loading products: ${error.message}</td></tr>`;
    }
}

// Load a single product for editing
async function loadProductForEdit(id) {
    try {
        // We reuse the public GET API since it returns the same data structure, 
        // OR we could make a specific admin one if we needed private fields.
        // For now, public API is fine, or we filter from the list. 
        // Better to fetch fresh.
        const response = await fetch(`/api/products/get.php?id=${id}`);
        const product = await response.json();

        if (response.ok && product) {
            document.getElementById('product_id').value = product.id;
            document.getElementById('name').value = product.name;
            document.getElementById('price').value = product.price;
            document.getElementById('stock').value = product.stock || 0;
            document.getElementById('description').value = product.description;
            document.getElementById('image_url').value = product.image_url || '';
        } else {
            alert('Product not found');
            window.location.href = 'products.php';
        }
    } catch (error) {
        console.error('Error loading product:', error);
    }
}

// Handle Form Submission (Create/Update)
const productForm = document.getElementById('product-form');
if (productForm) {
    productForm.addEventListener('submit', async function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        const data = Object.fromEntries(formData.entries());
        const messageEl = document.getElementById('form-message');

        messageEl.textContent = 'Saving...';
        messageEl.className = 'message'; // reset styles

        try {
            const response = await fetch('/api/admin/products/save.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (response.ok) {
                messageEl.textContent = 'Product saved successfully!';
                messageEl.className = 'message success'; // Add your success class style
                messageEl.style.color = '#10b981';
                setTimeout(() => window.location.href = 'products.php', 1000);
            } else {
                throw new Error(result.error || 'Failed to save');
            }
        } catch (error) {
            messageEl.textContent = error.message;
            messageEl.className = 'message error'; // Add your error class style
            messageEl.style.color = '#ef4444';
        }
    });
}

// Delete Product
async function deleteProduct(id) {
    if (!confirm('Are you sure you want to delete this product?')) return;

    try {
        const response = await fetch('/api/admin/products/delete.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id })
        });

        if (response.ok) {
            loadAdminProducts(); // Reload list
        } else {
            const data = await response.json();
            alert('Failed to delete: ' + (data.error || 'Unknown error'));
        }
    } catch (error) {
        alert('Error deleting product');
    }
}

function escapeHtml(text) {
    if (!text) return '';
    return text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}
