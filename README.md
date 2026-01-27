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
*   PHP 7.4+
*   MySQL 5.7+
*   Web Server (Apache/Nginx/Built-in PHP server)

### 1. Database Setup
1.  Create a MySQL database named `agency_db`.
2.  Import the provided schema:
    ```bash
    mysql -u root -p agency_db < schema.sql
    ```
    *(Or use a GUI tool like phpMyAdmin/Workbench to import `schema.sql`)*

### 2. Configuration
1.  Open `config/database.php`.
2.  Update the database credentials to match your local environment:
    ```php
    private $host = '127.0.0.1';
    private $db   = 'agency_db';
    private $user = 'root'; // Your MySQL User
    private $pass = '';     // Your MySQL Password
    ```

### 3. Running the Project
Serve the project from the `public` directory.

**Using PHP Built-in Server:**
```bash
php -S localhost:8000 -t public
```

Access the site at `http://localhost:8000`.

---

## 🗺️ Roadmap & Features

### Phase 1: Foundation (Completed)
- [x] Project Structure & Environment
- [x] Database Schema Design (Users, Items, Orders, Invoices)
- [x] DB Connection Layer

### Phase 2: Core Backend (Current)
- [ ] User Authentication API (Register/Login)
- [ ] Product Management API
- [ ] Cart & Order Logic

### Phase 3: Frontend & Design
- [x] Premium "High Agency" UI/UX
- [ ] Dynamic Product Catalog (Static Placeholder Implemented)
- [x] Service Pages (Apify Actors, Automation, AI)

### Phase 4: Integration
- [ ] Connect Frontend to API
- [ ] Cart & Checkout Implementation
- [ ] Admin Dashboard methods
