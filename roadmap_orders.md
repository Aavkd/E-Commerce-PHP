# Roadmap: User Order History & Dashboard

This roadmap outlines the steps to implement the Order History feature, ensuring users can view their past purchases and that orders are correctly linked to authenticated users.

## Goal
Enable authenticated users to view a list of their past orders and the details of each order (products purchased, quantities, total).

## Context
- **Database**: `orders`, `order_items`, and `users` tables already exist and are correctly related.
- **Authentication**: `Auth` class and `$_SESSION['user_id']` are used.
- **Current State**: Users can place orders (backend links `user_id`), but there is no UI to view them.

---

## Phase 1: Backend Implementation (Model Enhancements)

The `Order` model needs to be expanded to support data retrieval.

### Task 1.1: Update `src/Models/Order.php`
**Goal**: Add methods to fetch orders.

**Changes**:
1.  **Add method `getOrdersByUserId($userId)`**:
    -   SQL: `SELECT * FROM orders WHERE user_id = ? ORDER BY created_at DESC`
    -   Returns: Array of orders.
    -   **[x] Completed**
2.  **Add method `getOrderDetails($orderId)`**:
    -   SQL: `SELECT oi.*, i.name, i.image FROM order_items oi JOIN items i ON oi.item_id = i.id WHERE oi.order_id = ?`
    -   Returns: Array of items for a specific order.
3.  **Add method `getOrderById($orderId)`**:
    -   SQL: `SELECT * FROM orders WHERE id = ?`
    -   Purpose: To verify order ownership before showing details.

---

## Phase 2: Frontend Implementation (UI/UX)

Create pages to display the data.

### Task 2.1: Create `public/orders.php` (Order History Page)
**Goal**: Display a list of orders for the logged-in user.

**Key Components**:
-   **Auth Check**: Redirect to `login.php` if not logged in.
-   **Fetching**: Call `Order::getOrdersByUserId($_SESSION['user_id'])`.
-   **UI**:
    -   Table or List view.
    -   Columns: Order ID, Date, Total Amount, Status, "View Details" button.
    -   **[x] Completed**

### Task 2.2: Create `public/order_details.php` (Order Details Page)
**Goal**: Show specific items in an order.

**Key Components**:
-   **Auth Check**: Ensure user is logged in.
-   **Ownership Check**: Ensure `order.user_id === $_SESSION['user_id']`. **Critical for security.**
-   **Fetching**: Call `Order::getOrderDetails($orderId)`.
-   **UI**:
    -   List of items (Image, Name, Quantity, Price).
    -   Billing Info (from `invoices` table if needed, or query `orders` if address stored there - *Note: Schema stores address in `invoices` table, so might need to join/fetch invoice too*).
    -   **Back Button**: Link back to `orders.php`.
    -   **[x] Completed**

### Task 2.3: Update `public/includes/header.php`
**Goal**: Add navigation link.

**Changes**:
-   Add "My Orders" link in the navigation menu (visible only when logged in).

---

## Phase 3: Verification Strategy

Ensure the feature works and is secure.

### Task 3.1: Automated Tests (`tests/test_models.php`)
**Action**: Update the existing test script.
-   **Step 1**: Retrieve orders for the test user created in `TEST 2`.
-   **Step 2**: Assert that the count of orders is > 0.
-   **Step 3**: Retrieve details for the created order.
-   **Step 4**: Assert that the item in the order details matches the product ID and quantity.

### Task 3.2: Manual User Verification
**Steps**:
1.  **Login** as a user.
2.  **Place an Order** via the cart/checkout flow.
3.  **Navigate** to "My Orders" (via header link or URL).
4.  **Verify** the new order appears with the correct Total and Date.
5.  **Click** "View Details".
6.  **Verify** the products listed match what was bought.
7.  **Security Test**: Try to access `order_details.php?id=X` where X is an order ID belonging to *another* user. Should show Access Denied or 404.

---

## Dependencies & Notes
-   **Files to Create**: `public/orders.php`, `public/order_details.php`.
-   **Files to Modify**: `src/Models/Order.php`, `public/includes/header.php`, `tests/test_models.php`.
-   **Database**: No schema changes required.
