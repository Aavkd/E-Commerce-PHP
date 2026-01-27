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
4.  **[ ] Homepage Overhaul (Rich Content)**
    *   **Proof of Expertise**: Add logos/tech stack section and metrics line (X actors, Y automations).
    *   **Expanded Messaging**: Integrate "From data to signal" positioning.
    *   **Trust Signals**: Add testimonials or "Why Us" comparison table (Scrapers vs Assets).
    *   **Visual Enhancements**: Better gradients, glassmorphism cards, micro-interactions using existing CSS variables.
    *   **Interactivity**: Scroll reveal animations, infinite logo marquee, hero typing effect.

### PHASE 4: Frontend-Backend Integration

*   **Goal**: Connect the UI to the Data.
*   **Developer**: Frontend (consuming Backend)

#### Tasks
1.  **[ ] Product Catalog Integration**
    *   Create `public/js/catalog.js`.
    *   Fetch data from `api/products/list.php`.
    *   Render product cards dynamically on `catalog.php`.
2.  **[ ] Product Details Integration**
    *   Create `public/js/product-detail.js`.
    *   Parse URL param `?id=X`.
    *   Fetch details from `api/products/get.php` and render.
3.  **[ ] Authentication Flows**
    *   Build Login/Register Forms (`login.php`, `register.php`).
    *   JS fetch to POST data to API.
    *   Handle success (redirect) or error messages (UI alerts).
4.  **[ ] Cart & Checkout UI**
    *   Implement "Add to Cart" button (AJAX request to `api/cart.php`).
    *   Build `cart.php` page: List items, update quantities.
    *   Build `checkout.php`: Form for billing info -> POST to `api/checkout.php`.

### PHASE 5: Admin Dashboard (Back-office)

*   **Goal**: Management interface for Admins.
*   **Developer**: Full Stack

#### Tasks
1.  **[ ] Admin Layout**
    *   Protected route (check `Auth::isAdmin()`).
    *   Sidebar navigation (Users, Products, Orders).
2.  **[ ] Product Management UI**
    *   List view with Edit/Delete buttons.
    *   Modal or Page for "Add/Edit Product" form.
    *   Image upload handling.
3.  **[ ] User & Order View**
    *   Read-only lists of users and orders.

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
├── api/                  # JSON Endpoints
│   ├── login.php
│   ├── register.php
│   ├── products/
│   ├── cart.php
│   └── checkout.php
├── config/
│   └── database.php
├── src/                  # Core Logic (Classes)
│   ├── Models/
│   │   ├── User.php
│   │   ├── Product.php
│   │   └── Order.php
│   └── Utils/
│       ├── Auth.php
│       └── Validator.php
├── public/               # Frontend
│   ├── css/
│   ├── js/
│   ├── index.php
│   ├── catalog.php
│   ├── login.php
│   └── admin/
├── tests/
├── schema.sql
└── README.md
```
