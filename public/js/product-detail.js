/**
 * Product Details Logic
 * Handles fetching single product data and rendering details
 */

document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('id');

    if (!productId) {
        showError();
        return;
    }

    fetchProductDetails(productId);
});

async function fetchProductDetails(id) {
    try {
        const response = await fetch(`/api/products/get.php?id=${id}`);

        if (!response.ok) {
            throw new Error('Product not found');
        }

        const product = await response.json();
        if (!product || product.error) {
            throw new Error(product.error || 'Invalid product data');
        }

        renderProduct(product);
    } catch (error) {
        console.error('Error:', error);
        showError();
    }
}

function renderProduct(product) {
    // Hide loading, show details
    document.getElementById('loading').style.display = 'none';
    const container = document.getElementById('product-detail');
    container.style.display = 'grid'; // Restore grid layout

    // Inject Data
    document.getElementById('product-name').textContent = product.name;
    document.getElementById('product-description').textContent = product.description;

    // Price
    const priceFormatted = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(product.price);
    document.getElementById('product-price').textContent = priceFormatted;

    // Image
    const imageContainer = document.getElementById('product-image-container');
    if (product.image_url) {
        imageContainer.innerHTML = `<img src="${product.image_url}" alt="${product.name}" style="width:100%; height:100%; object-fit: cover;">`;
    } else {
        // Fallback SVG
        imageContainer.innerHTML = `
            <svg width="120" height="120" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="opacity:0.2; color:white;">
                <path d="M21 16V8.00002C20.9996 7.22853 20.7334 6.48007 20.2472 5.88289C19.761 5.28571 19.0851 4.87679 18.334 4.72602L13.334 3.72602C12.9026 3.63974 12.4574 3.63974 12.026 3.72602L7.026 4.72602C6.27494 4.87679 5.59904 5.28571 5.11283 5.88289C4.62662 6.48007 4.36037 7.22853 4.36 8.00002V16C4.36037 16.7715 4.62662 17.52 5.11283 18.1171C5.59904 18.7143 6.27494 19.1232 7.026 19.274L12.026 20.274C12.4574 20.3603 12.9026 20.3603 13.334 20.274L18.334 19.274C19.0851 19.1232 19.761 18.7143 20.2472 18.1171C20.7334 17.52 20.9996 16.7715 21 16Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        `;
    }

    // Add to Cart Button
    const btn = document.getElementById('add-to-cart-btn');
    btn.onclick = () => addToCart(product.id, product.name, product.price);
    btn.textContent = `Add to Cart - ${priceFormatted}`;
}

function showError() {
    document.getElementById('loading').style.display = 'none';
    document.getElementById('product-detail').style.display = 'none';
    document.getElementById('error-container').style.display = 'block';
}
