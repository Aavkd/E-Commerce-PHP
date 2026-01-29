/**
 * Product Catalog Logic
 * Fetches products from API and renders them with glassmorphism styling
 */

document.addEventListener('DOMContentLoaded', () => {
    fetchProducts();
});

async function fetchProducts() {
    const grid = document.getElementById('product-grid');
    if (!grid) return;

    // Loading State
    grid.innerHTML = '<p class="text-center text-muted" style="grid-column: 1/-1; padding: 2rem;">Loading revenue assets...</p>';

    try {
        const response = await fetch('/api/products/list.php');
        if (!response.ok) throw new Error('Failed to fetch data');

        const products = await response.json();
        renderGrid(products);
    } catch (error) {
        console.error('Error fetching products:', error);
        grid.innerHTML = `
            <div class="text-center" style="grid-column: 1/-1; padding: 2rem;">
                <p class="text-muted text-gradient" style="font-size: 1.2rem; margin-bottom: 1rem;">Unable to load catalog</p>
                <button class="btn btn-outline" onclick="fetchProducts()">Try Again</button>
            </div>
        `;
    }
}

function renderGrid(products) {
    const grid = document.getElementById('product-grid');
    grid.innerHTML = '';

    if (!products || products.length === 0) {
        grid.innerHTML = '<p class="text-center text-muted" style="grid-column: 1/-1; padding: 4rem;">No products available yet.</p>';
        return;
    }

    products.forEach(product => {
        const card = document.createElement('div');
        card.className = 'product-card scroll-fade';

        // Format price
        const price = new Intl.NumberFormat('en-US', { style: 'currency', currency: 'USD' }).format(product.price);

        // Placeholder SVG if no image
        const fallbackImage = `
            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="opacity:0.2; color:white;">
                <path d="M21 16V8.00002C20.9996 7.22853 20.7334 6.48007 20.2472 5.88289C19.761 5.28571 19.0851 4.87679 18.334 4.72602L13.334 3.72602C12.9026 3.63974 12.4574 3.63974 12.026 3.72602L7.026 4.72602C6.27494 4.87679 5.59904 5.28571 5.11283 5.88289C4.62662 6.48007 4.36037 7.22853 4.36 8.00002V16C4.36037 16.7715 4.62662 17.52 5.11283 18.1171C5.59904 18.7143 6.27494 19.1232 7.026 19.274L12.026 20.274C12.4574 20.3603 12.9026 20.3603 13.334 20.274L18.334 19.274C19.0851 19.1232 19.761 18.7143 20.2472 18.1171C20.7334 17.52 20.9996 16.7715 21 16Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        `;

        const imageHtml = `
            <div class="product-image">
                ${product.image_url
                ? `<img src="${product.image_url}" alt="${product.name}" style="width:100%;height:100%;object-fit:cover;" onerror="this.parentElement.innerHTML='${fallbackImage.replace(/"/g, "'")}'">`
                : fallbackImage
            }
            </div>
        `;

        card.style.position = 'relative'; // Ensure anchor is contained within the card

        // Description truncation
        const desc = product.description
            ? (product.description.length > 80 ? product.description.substring(0, 80) + '...' : product.description)
            : 'No description available.';

        card.innerHTML = `
            <a href="product.php?id=${product.id}" style="text-decoration: none; color: inherit; display: flex; flex-direction: column; flex-grow: 1;">
                ${imageHtml}
                <div class="product-content" style="flex-grow: 1; padding-bottom: 0.5rem;">
                    <span class="product-tag">ASSET</span>
                    <h3 class="product-title">${product.name}</h3>
                    <p class="product-desc">${desc}</p>
                </div>
            </a>
            <div class="product-footer" style="margin: 0 2rem; padding: 1.5rem 0 2rem 0; border-top: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
                <span class="price">${price}</span>
                <button class="btn btn-primary btn-sm" 
                    onclick="addToCart(${product.id}, '${product.name.replace(/'/g, "\\'")}', ${product.price})" 
                    style="padding: 0.5rem 1rem; font-size: 0.9rem;">
                    Add
                </button>
            </div>
        `;

        // No z-index hacks needed anymore

        grid.appendChild(card);
    });

    // Animate in
    setTimeout(() => {
        document.querySelectorAll('.scroll-fade').forEach((el, index) => {
            setTimeout(() => el.classList.add('active'), index * 100);
        });
    }, 50);
}
