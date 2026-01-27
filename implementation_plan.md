# IMPLEMENATION PLAN - SaaS Agency Website

This plan outlines the roadmap to build a high-performance SaaS Agency website using PHP and MySQL. The architecture is designed to decouple the **Backend (Database & Logic)** from the **Frontend (UI/UX)**, enabling parallel development.

## 🧱 Architecture Overview

*   **Pattern**: API-Driven Architecture (or Strict MVC).
*   **Backend**: Pure PHP (No heavy frameworks, just structure). Exposes data via JSON APIs.
*   **Frontend**: HTML5, CSS3 (Modern/High-end), Vanilla JS. Consumes Backend APIs.
*   **Database**: MySQL.

## 🗄️ Database Schema (MySQL)

We will create the 5 required tables plus necessary relations.

```sql
-- Users Table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL, -- password_hash
    role ENUM('customer', 'admin') DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Items (Products/Actors)
CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock INT DEFAULT 0, -- For digital goods, could be license count or infinite (handled via logic)
    image_url VARCHAR(255),
    is_published BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Orders
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Order Items (Linking Orders to Items) - Standard Normalization
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    item_id INT NOT NULL,
    quantity INT NOT NULL,
    unit_price DECIMAL(10,2) NOT NULL, -- Snapshotted price
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (item_id) REFERENCES items(id)
);

-- Invoices (Billing Info)
CREATE TABLE invoices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    order_id INT UNIQUE NOT NULL, -- One invoice per order
    amount DECIMAL(10,2) NOT NULL,
    billing_address TEXT NOT NULL,
    city VARCHAR(100) NOT NULL,
    zip_code VARCHAR(20) NOT NULL,
    transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (order_id) REFERENCES orders(id)
);
```

## 🗺️ Roadmap & Tasks

### PHASE 1: Project Initialization & Database (Backend Focus)

*   **Goal**: Set up the environment and persistent storage.
*   **Developer**: Backend

#### Tasks
1.  **[x] Environment Setup**
    *   Create project folder structure:
        *   `/api` (Backend endpoints)
        *   `/config` (DB connection)
        *   `/public` (Frontend assets)
        *   `/src` (Classes/Models)
    *   Create `.gitignore` and `README.md`.
2.  **[x] Database Implementation**
    *   Create `schema.sql` file.
    *   Set up local MySQL database `agency_db`.
    *   Run migration script to create tables.
3.  **[x] Database Startup & Tuning**
    *   **[x] Start Database Server**: Verified MySQL running on port 3306 (MariaDB).
    *   **[x] Fix Configuration**: Updated `database.php` to use correct DB name (`agency_db`).
4.  **[x] DB Connection Wrapper**
    *   Create `config/database.php`: Singleton pattern PDO connection.
    *   Ensure strict error mode is on.

### PHASE 2: Core Backend Logic (API Layer)

*   **Goal**: Create reusable PHP classes and expose them via JSON endpoints.
*   **Developer**: Backend

#### Tasks
1.  **[x] Validation & Security Helpers**
    *   Create `src/Utils/Validator.php`: Methods to sanitize inputs, validate emails.
    *   Create `src/Utils/Auth.php`: Session management, CSRF token generation.
2.  **[x] User Management API**
    *   Create `src/Models/User.php` (Methods: `create`, `findByEmail`, `verifyPassword`).
    *   Create `api/register.php`: Handle POST requests, validate, insert user.
    *   Create `api/login.php`: Validate credentials, start session/issue token.
    *   Create `api/logout.php`.
    *   **Validation**: Test with Postman/Curl.
3.  **[x] Product Management API**
    *   Create `src/Models/Product.php` (CRUD methods).
    *   Create `api/products/list.php`: Return JSON list of products.
    *   Create `api/products/get.php`: Return single product details.
    *   Create `api/admin/product_save.php`: Handle Create/Update (Admin only).
    *   Create `api/admin/product_delete.php`: Handle Delete (Admin only).
4.  **[x] Cart & Order Logic**
    *   Create `src/Models/Cart.php`: Manage cart in Session (add, remove, clear, total).
    *   Create `api/cart.php`: Endpoints to modify cart state.
    *   Create `src/Models/Order.php`: Create order from cart, generate invoice record.
    *   Create `api/checkout.php`: Process payment (mock), save order, clear cart.

### PHASE 3: Frontend Foundation & Static Pages

*   **Goal**: Build the visual shell and "High Agency" look.
*   **Developer**: Frontend

#### Tasks
1.  **[x] Design System & Assets**
    *   Setup `public/css/style.css` (or `main.css`).
    *   Define Color Palette using CSS Variables (Dark mode focus, premium feel).
    *   Download/Link Fonts (Inter, Outfit).
2.  **[x] Shared Components**
    *   Create `public/includes/header.php` (Nav bar).
    *   Create `public/includes/footer.php`.
    *   **Note**: Using `.html` or `.php` views that fetch data via JS.
3.  **[x] Landing Page (Home)**
    *   Implement "Hero Section" from Strategic Report.
    *   Implement "Services" teaser.
    *   Implement "Featured Products" grid (initially static or skeleton loader).
4.  **[x] Homepage Overhaul (Rich Content)**
    *   **Proof of Expertise**: Add logos/tech stack section and metrics line (X actors, Y automations).
    *   **Expanded Messaging**: Integrate "From data to signal" positioning.
    *   **Trust Signals**: Add testimonials or "Why Us" comparison table (Scrapers vs Assets).
    *   **Visual Enhancements**: Better gradients, glassmorphism cards, micro-interactions using existing CSS variables.
    *   **Interactivity**: Scroll reveal animations, infinite logo marquee, hero typing effect.

### PHASE 4: Frontend-Backend Integration (Products & Cart)

*   **Goal**: Connect the UI to the Data.
*   **Developer**: Frontend (consuming Backend)

#### Tasks
1.  **[x] Product Catalog (Frontend)**
    *   **Create `public/js/catalog.js`**:
        *   `fetchProducts()`: Async function to call `GET /api/products/list.php`.
        *   `renderGrid(products)`: Generate HTML for product cards (Image, Title, Price, "Add to Cart").
        *   **Styling**: Use glassmorphism cards defined in index.css.
    *   **Update `public/products.php`**:
        *   Remove placeholder text.
        *   Add container `<div id="product-grid">` with loading state.
        *   Add script reference to `catalog.js`.
    *   **Update `public/products.php`**:
        *   Remove placeholder text.
        *   Add container `<div id="product-grid">` with loading state.
        *   Add script reference to `catalog.js`.
        *   **Bonus**: Add simple category filter sidebar (static HTML for now).
2.  **[x] Product Details Integration**
    *   **Create `public/product.php`** (or `product-detail.php`):
        *   Layout: Image (Left), Details (Right - Title, Description, Price, "Add to Cart").
        *   Container `<div id="product-detail">`.
    *   **Create `public/js/product-detail.js`**:
        *   `fetchProductDetails()`: Parse URL param `?id=X`.
        *   Call `GET /api/products/get.php?id=X`.
        *   Render details or show 404 if not found.
3.  **[x] Shopping Cart (Global & Page)**
    *   **Create `public/js/cart.js`**:
        *   `addToCart(id)`: POST to `/api/cart.php` (action: click). Show toast notification.
        *   `updateCartHeader()`: Fetch current count and update Header badge.
        *   `renderCartPage()`: For `cart.php`, fetch items and render table.
    *   **Update `public/includes/header.php`**:
        *   Add Cart Icon (SVG) with `<span id="cart-count">` badge.
    *   **Create `public/cart.php`**:
        *   Table Layout: Product, Unit Price, Quantity (Input), Total, Remove (X).
        *   Summary Card: Subtotal, Tax (0%), Total.
        *   CTA: "Proceed to Checkout" (links to `checkout.php`).
4.  **[x] Checkout Flow**
    *   **Create `public/checkout.php`**:
        *   Two-column layout: Left (Billing Form), Right (Order Summary).
        *   **Billing Form**: Name, Email, Address, City, Zip. (Pre-fill if user logged in).
        *   **Payment Mock**: "Pay with Credit Card" (Simulated).
    *   **Create `public/js/checkout.js`**:
        *   Handle Form Submit -> `POST /api/checkout.php`.
        *   On Success: Redirect to `public/success.php` or clear cart and show message.
5.  **[x] Shared Functionality**
    *   **Toast Notifications**: Simple JS utility to show "Added to cart" success messages.
    *   **Formatting**: JS helper `formatCurrency(amount)` to ensure consistent $XX.XX display.
    *   **Authentication Check**: Ensure Checkout redirects to Login if user is guest.
6.  **[x] Data Seeding**
    *   Created `tests/seed_products.php` to populate DB.`
7.  **[x] User Order History**
    *   **Create `public/orders.php`**: List user's past orders.
    *   **Create `public/order_details.php`**: Show details for specific order.
    *   **Backend**: Added `getOrdersByUserId` and `getOrderDetails` to `Order.php`.

### PHASE 3.5: Design Refresh (Current)
*   **Goal**: Elevate the design from "clean" to "wow" using modern trends (Bento Grids, Spotlight effects, dynamic backgrounds).
*   **Developer**: Frontend
*   **Tasks**:
    1.  **[x] Bento Grid Layout**:  Refactor "What We Actually Sell" section in `index.php` into a CSS Grid Bento layout.
    2.  **[x] Spotlight Effect**: Implement mouse-tracking glow effects on cards (`public/js/spotlight.js` + CSS).
    3.  **[x] Hero Enhancement**: Add animated background or "Cyber Grid" to the hero section for depth.
    4.  **[x] Typography & Spacing**: Increase contrast, refine font sizes for a more editorial look.


### PHASE 5: Admin Dashboard (Back-office)

*   **Goal**: Secure management interface for Admins to manage products and users.
*   **Developer**: Full Stack

#### Tasks
1.  **[ ] Admin Authentication & Security**
    *   **Backend**: 
        *   Update `src/Utils/Auth.php`: Ensure `isAdmin()` checks `role === 'admin'`.
        *   Update `api/login.php`: Allow admin login (standard auth).
        *   Create `api/admin/check_auth.php`: Verify admin session for frontend routing.
    *   **Frontend**:
        *   Create `public/admin/login.php`: Dedicated login form (styled differently/minimal).
        *   Create `public/admin/logout.php`: Specific redirect to admin login.
        *   **Middleware**: Create `public/js/admin-auth.js` to check session on page load and redirect to login if not authenticated.

2.  **[ ] Admin Dashboard & Layout**
    *   **Layout**: Create `public/admin/includes/header.php` and `sidebar.php`.
    *   **Dashboard**: Create `public/admin/index.php`.
        *   Display quick stats (Total Orders, Total Users, Low Stock Items).
        *   Links to Products, Users.

3.  **[ ] Product Management (CRUD)**
    *   **Backend**:
        *   Ensure `src/Models/Product.php` has `create`, `update`, `delete`, `getAll`, `getById`.
        *   Create `api/admin/products/list.php` (JSON).
        *   Create `api/admin/products/save.php`: Handle POST (Create/Update based on ID presence). Handle Image Upload.
        *   Create `api/admin/products/delete.php`: Handle DELETE.
    *   **Frontend**:
        *   Create `public/admin/products.php`: Table view of products (Image, Name, Price, Stock, Actions: Edit/Delete).
        *   Create `public/admin/product_form.php`: Form for Add/Edit (Name, Description, Price, Stock, Image).
        *   JS: `public/js/admin-products.js` to handle fetch and form submission.

4.  **[ ] User Management**
    *   **Backend**:
        *   Update `src/Models/User.php`: Add `getAll()` and `delete($id)`.
        *   Create `api/admin/users/list.php` (JSON).
        *   Create `api/admin/users/delete.php`.
    *   **Frontend**:
        *   Create `public/admin/users.php`: Table view (Name, Email, Role, Created At, Action: Delete).
        *   JS: `public/js/admin-users.js` to handle fetch and delete.

#### Validation Steps
*   **Test Admin Auth**: Verify access to `/admin/*` is blocked for guests/customers.
*   **Test Product CRUD**: Add product, verify it appears in `public/products.php`. Edit product, verify changes. Delete product, verify removal.
*   **Test User Mgmt**: List users. Delete a test user. Verify they cannot login.

## ✅ Verification Plan

### Automated Tests (Backend)
Since we are using raw PHP, valid validation will be script-based:
*   **[x]** `tests/test_db_connection.php`: Verify connection. (Passed)
*   `tests/test_models.php`: Script to create a dummy user, retrieve it, delete it.

### Manual Verification (User Acceptance)
1.  **Flow 1: Guest Visitor**
    *   Can view Home, About, Catalog.
    *   Can see Product Details.
    *   Cannot checkout without login (or prompted to login).
2.  **Flow 2: Customer**
    *   Register -> Login.
    *   Add items to cart.
    *   Checkout -> Complete Order.
    *   See Invoice data.
3.  **Flow 3: Admin**
    *   Login as Admin.
    *   Add new Product -> Appears in Catalog.
    *   View Orders.

## 📂 File Structure Target

```
/
├── config/
│   └── database.php
├── src/                  # Core Logic (Classes)
│   ├── Models/
│   │   ├── User.php
│   │   ├── Product.php
│   │   ├── Order.php
│   └── Utils/
│       ├── Auth.php
│       └── Validator.php
├── public/               # Frontend
│   ├── api/                  # JSON Endpoints
│   │   ├── login.php
│   │   ├── register.php
│   │   ├── products/
│   │   ├── cart.php
│   │   └── checkout.php
│   │   ├── admin/            # Admin APIs
│   │   │   ├── products/
│   │   │   ├── users/
│   │   │   └── check_auth.php
│   ├── css/
│   ├── js/
│   ├── index.php
│   ├── catalog.php
│   ├── login.php
│   └── admin/            # Admin UI
│       ├── index.php
│       ├── login.php
│       ├── products.php
│       ├── users.php
│       └── includes/
├── tests/
├── schema.sql
└── README.md
```
