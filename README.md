# TechStore - Backend API

Ce dépôt contient la partie **Backend** (API & Base de données) du projet E-commerce.
L'architecture est orientée API (Headless PHP).

## Installation

1.  Importer `database.sql` dans MySQL (`ecommerce_db`).
2.  Configurer `config/database.php`.
3.  Placer le dossier dans votre serveur web (ex: `htdocs/techstore`).

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

## Structure des Dossiers

- `/api` : Points d'entrée JSON.
- `/src` : Classes PHP (Models, Utils).
- `/config` : Configuration.
- `/assets/uploads` : Images des produits.
