# 📘 SaaS Agency & Automation Platform

> **"We build revenue-driven SaaS, automations & Apify actors for data-hungry businesses."**

## 🎯 Project Overview
This project is a high-performance web platform designed to generate qualified leads and sell technical assets including:
*   **Apify Actors** (Data scraping, intelligence, monitoring)
*   **Automations & Workflows** (n8n, AI Agents, Data Pipelines)
*   **Custom SaaS Solutions** (MVP to monetized product)

The goal is to create technical trust and demonstrate business value through a premium, "High Agency" aesthetic.

---

## 🏗️ Architecture & Tech Stack

The architecture is designed to decouple the **Backend (Database & Logic)** from the **Frontend (UI/UX)**, enabling parallel development and a clean separation of concerns.

*   **Pattern**: API-Driven Architecture.
*   **Backend**: Pure PHP (No heavy frameworks). Exposes data via JSON APIs.
*   **Frontend**: HTML5, Modern CSS3 (Vanilla), Vanilla JS. Consumes Backend APIs.
*   **Database**: MySQL.

### File Structure
```
/
├── api/                  # JSON Endpoints (Login, Products, Cart, etc.)
├── config/               # Database and Environment Configuration
├── src/                  # Core Logic (Models, Utils, Auth)
├── public/               # Frontend Assets (CSS, JS, Images, HTML/PHP Views)
├── tests/                # Verification Scripts
└── schema.sql            # Database Schema and Migrations
```

---

## 🛠️ Setup & Installation

### Prerequisites
*   **PHP 7.4+** (Recommended: 8.0+)
*   **MySQL 5.7+** or MariaDB
*   **Web Server** (Apache, Nginx, or PHP's built-in server)

**Recommended Tools for Beginners:**
*   **Windows**: [XAMPP](https://www.apachefriends.org/index.html) or [Laragon](https://laragon.org/)
*   **Mac**: [MAMP](https://www.mamp.info/) or [DBngin](https://dbngin.com/) + PHP
*   **Linux**: Standard LAMP/LEMP stack

### 1. Database Setup
1.  **Start your MySQL Server** (via XAMPP Control Panel, MAMP, etc.).
2.  Open your database management tool (phpMyAdmin, TablePlus, DBeaver).
    *   *XAMPP/MAMP default URL*: http://localhost/phpmyadmin
3.  **Create a new database** named `agency_db`.
    *   Character set: `utf8mb4_unicode_ci` (Recommended)
4.  **Import the schema**:
    *   Select `agency_db` on the left.
    *   Go to the **Import** tab.
    *   Choose the file `schema.sql` from the project root.
    *   Click **Go** (or Import).

### 2. Configuration
1.  Open `config/database.php`.
2.  Update the database credentials to match your local environment.

**Standard Default Credentials:**

**XAMPP (Windows):**
```php
$host = 'localhost';
$db_name = 'agency_db';
$username = 'root';
$password = ''; // Default is empty
```

**MAMP (Mac):**
```php
$host = 'localhost';
$db_name = 'agency_db';
$username = 'root';
$password = 'root'; // Default is 'root'
```
### 3. Running the Project
Serve the project from the `public` directory.

**Using PHP Built-in Server (Easiest):**
```bash
php -S localhost:8000 -t public
```
Access the site at `http://localhost:8000`.

---

## ❓ Troubleshooting

**Error: "Erreur de connexion..." or JSON Syntax Error during Registration**
*   This usually means the database credentials in `config/database.php` are incorrect.
*   The application returns a connection error as text, which breaks the frontend's JSON expectation.
*   **Fix**: Check your username/password in `config/database.php`. If using XAMPP, password is usually empty string `''`. If MAMP, it is usually `'root'`.



## Endpoints API

### Auth
- `POST /api/register.php`
- `POST /api/login.php`
- `GET  /api/logout.php`

### Produits
- `GET  /api/products/list.php`
- `GET  /api/products/get.php?id={id}`
- `POST /api/admin/product_save.php` (Admin)
- `POST /api/admin/product_delete.php` (Admin)

### Panier / Commande
- `POST /api/cart.php` (Action: add/remove/clear)
- `POST /api/checkout.php` (Nécessite connexion)

### 2. Configuration
1.  Open `config/database.php`.
2.  Update the database credentials to match your local environment:
    ```php
    private $host = '127.0.0.1';
    private $db   = 'agency_db';
    private $user = 'root'; // Your MySQL User
    private $pass = '';     // Your MySQL Password
    ```

Access the site at `http://localhost:8000`.

