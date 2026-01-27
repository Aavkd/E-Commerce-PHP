/**
 * Shopping Cart Logic
 * Manages cart state via API and updates UI
 */

const CART_API = '/api/cart.php';

// Initialize
document.addEventListener('DOMContentLoaded', () => {
    updateCartHeader();

    // If we are on the cart page, render it
    if (document.getElementById('cart-table-body')) {
        renderCartPage();
    }
});

/**
 * Add Item to Cart
 * Requires name and price because backend expects it (simple implementation)
 */
async function addToCart(id, name, price) {
    if (!id || !name || !price) {
        console.error('Missing product details for cart');
        return;
    }

    try {
        const response = await fetch(CART_API, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                action: 'add',
                id: id,
                name: name,
                price: price,
                quantity: 1
            })
        });

        const data = await response.json();

        if (data.success) {
            updateCartHeader();
            showToast(`Added ${name} to cart`);
        } else {
            showToast('Failed to add to cart', 'error');
        }
    } catch (e) {
        console.error(e);
        showToast('Error adding to cart', 'error');
    }
}

/**
 * Update Header Badge
 */
async function updateCartHeader() {
    try {
        const response = await fetch(CART_API); // Default action is get cart
        const data = await response.json();

        const count = data.cart ? Object.keys(data.cart).length : 0;
        const badge = document.getElementById('cart-count');

        if (badge) {
            badge.textContent = count;
            badge.style.display = count > 0 ? 'flex' : 'none';
        }
    } catch (e) {
        console.error('Failed to update cart header', e);
    }
}

/**
 * Render Cart Page
 */
async function renderCartPage() {
    const tbody = document.getElementById('cart-table-body');
    const totalEl = document.getElementById('cart-total');
    const emptyEl = document.getElementById('cart-empty');
    const contentEl = document.getElementById('cart-content');

    if (!tbody) return;

    try {
        const response = await fetch(CART_API);
        const data = await response.json();
        const cart = data.cart || {};
        const total = data.total || 0;

        // Check if empty
        if (Object.keys(cart).length === 0) {
            if (contentEl) contentEl.style.display = 'none';
            if (emptyEl) emptyEl.style.display = 'block';
            return;
        }

        if (contentEl) contentEl.style.display = 'block';
        if (emptyEl) emptyEl.style.display = 'none';

        tbody.innerHTML = '';

        Object.entries(cart).forEach(([id, item]) => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>
                    <div style="font-weight: 500; color: var(--text-main);">${item.name}</div>
                </td>
                <td>$${parseFloat(item.price).toFixed(2)}</td>
                <td>
                    <span style="color: var(--text-muted);">x${item.quantity}</span>
                </td>
                <td style="font-weight: 600; color: var(--text-main);">
                    $${(item.price * item.quantity).toFixed(2)}
                </td>
                <td>
                    <button class="btn-icon" onclick="removeFromCart(${id})" aria-label="Remove">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 6L6 18M6 6l12 12"></path>
                        </svg>
                    </button>
                </td>
            `;
            tbody.appendChild(tr);
        });

        if (totalEl) {
            totalEl.textContent = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(total);
        }

    } catch (e) {
        console.error('Error rendering cart', e);
        tbody.innerHTML = '<tr><td colspan="5" class="text-center">Error loading cart</td></tr>';
    }
}

async function removeFromCart(id) {
    if (!confirm('Remove this item?')) return;

    try {
        const response = await fetch(CART_API, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                action: 'remove',
                id: id
            })
        });

        const data = await response.json();
        if (data.success) {
            renderCartPage();
            updateCartHeader();
        }
    } catch (e) {
        console.error(e);
    }
}

// Simple Toast Notification
function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.textContent = message;

    // Style (Inline for simplicity, or move to CSS)
    Object.assign(toast.style, {
        position: 'fixed',
        bottom: '20px',
        right: '20px',
        background: type === 'error' ? '#ef4444' : 'var(--primary)',
        color: 'white',
        padding: '1rem 2rem',
        borderRadius: '8px',
        boxShadow: '0 10px 15px -3px rgba(0, 0, 0, 0.3)',
        zIndex: '9999',
        animation: 'slideIn 0.3s ease-out',
        fontWeight: '500'
    });

    document.body.appendChild(toast);

    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateY(100%)';
        toast.style.transition = 'all 0.3s ease-in';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Add keyframes for toast if not exists
if (!document.getElementById('toast-style')) {
    const style = document.createElement('style');
    style.id = 'toast-style';
    style.textContent = `
        @keyframes slideIn {
            from { transform: translateY(100%); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        .btn-icon {
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 4px;
            transition: all 0.2s;
        }
        .btn-icon:hover {
            color: #ef4444;
            background: rgba(239, 68, 68, 0.1);
        }
    `;
    document.head.appendChild(style);
}
