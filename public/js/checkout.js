/**
 * Checkout Logic
 * Handles validation, submission, and auth check
 */

document.addEventListener('DOMContentLoaded', () => {
    loadOrderSummary();

    document.getElementById('checkout-form').addEventListener('submit', handleCheckout);
});

async function loadOrderSummary() {
    const container = document.getElementById('checkout-items');
    const totalEl = document.getElementById('checkout-total');

    try {
        const response = await fetch('/api/cart.php');
        const data = await response.json();

        if (!data.cart || Object.keys(data.cart).length === 0) {
            window.location.href = '/cart.php'; // Redirect if empty
            return;
        }

        container.innerHTML = '';
        Object.values(data.cart).forEach(item => {
            const div = document.createElement('div');
            div.style.display = 'flex';
            div.style.justifyContent = 'space-between';
            div.style.marginBottom = '0.5rem';
            div.style.color = 'var(--text-muted)';

            div.innerHTML = `
                <span>${item.name} <span style="font-size: 0.8em; opacity: 0.7;">x${item.quantity}</span></span>
                <span>$${(item.price * item.quantity).toFixed(2)}</span>
            `;
            container.appendChild(div);
        });

        totalEl.textContent = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(data.total);

    } catch (e) {
        console.error('Error loading summary', e);
    }
}

async function handleCheckout(e) {
    e.preventDefault();

    const btn = e.target.querySelector('button[type="submit"]');
    const originalText = btn.textContent;
    btn.textContent = 'Processing...';
    btn.disabled = true;

    // Data from fields
    const address = document.getElementById('address').value;
    const city = document.getElementById('city').value;
    const zip = document.getElementById('zip').value;

    try {
        const response = await fetch('/api/checkout.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                address: address,
                city: city,
                zip: zip
            })
        });

        const data = await response.json();

        if (response.status === 401) {
            alert('Please login to complete your purchase.');
            window.location.href = '/login.php?redirect=/checkout.php';
            return;
        }

        if (data.success) {
            alert('Order processed successfully! Order ID: ' + data.order_id);
            window.location.href = '/'; // or /success.php
        } else {
            alert('Error: ' + (data.error || 'Unknown error'));
            btn.textContent = originalText;
            btn.disabled = false;
        }

    } catch (e) {
        console.error('Checkout error', e);
        alert('An error occurred. Please try again.');
        btn.textContent = originalText;
        btn.disabled = false;
    }
}
