# IMPLEMENATION PLAN - Authentication UI & Integration

This plan focuses on implementing the "Login" and "Register" user interface and connecting it to the existing backend API.

## 🎯 Goal
Create a modern, sleek Login and Register experience that integrates with the existing `api/login.php` and `api/register.php` endpoints. Add navigation entries to the main header.

## 🏗️ Proposed Changes

### 1. Shared Components
#### [MODIFY] [header.php](file:///d:/Documents/PROJECTS/MONEY%20MAKER/PHP/public/includes/header.php)
*   **Purpose**: Add "Login" and "Register" links to the navigation.
*   **Change**: Insert links in the `.header-cta` or `.nav-links` section.

### 2. Frontend Pages (New)
#### [NEW] [login.php](file:///d:/Documents/PROJECTS/MONEY%20MAKER/PHP/public/login.php)
*   **Purpose**: User login interface.
*   **Content**:
    *   HTML5 Form (Email, Password).
    *   "High Agency" aesthetic (glassmorphism, dark mode).
    *   JavaScript to capture submit, call `POST /api/login.php`.
    *   Handle success: Redirect to `/` (or dashboard if we had one).
    *   Handle error: Show error message toast/alert.

#### [NEW] [register.php](file:///d:/Documents/PROJECTS/MONEY%20MAKER/PHP/public/register.php)
*   **Purpose**: User registration interface.
*   **Content**:
    *   HTML5 Form (Name, Email, Password, Confirm Password).
    *   JavaScript to call `POST /api/register.php`.
    *   Handle success: Auto-login or redirect to Login.
    *   Handle error: Show validation errors.

### 3. Styles & Scripts
#### [MODIFY] [style.css](file:///d:/Documents/PROJECTS/MONEY%20MAKER/PHP/public/css/style.css)
*   **Purpose**: Add styles for auth forms.
*   **Content**:
    *   `.auth-container`: Centered card layout.
    *   `.form-group`: Modern input styling with floating labels or distinct borders.
    *   `.btn-auth`: Specific gradients for auth actions.

#### [NEW] [auth.js](file:///d:/Documents/PROJECTS/MONEY%20MAKER/PHP/public/js/auth.js)
*   **Purpose**: Encapsulate authentication logic.
*   **Content**:
    *   `login(email, password)`
    *   `register(name, email, password)`
    *   Helper to handle API responses.

## 📋 Step-by-Step Execution Tasks

1.  **Create Auth Styles**
    *   Update `public/css/style.css` with classes for a centered, modern login card (Glassmorphism effect recommended).
    
2.  **Create Login Page**
    *   Create `public/login.php`.
    *   Include `header.php` and `footer.php`.
    *   Add the HTML form.
    *   Add `<script>` to handle submission via `fetch` to `/api/login.php`.

3.  **Create Register Page**
    *   Create `public/register.php`.
    *   Similar layout to Login.
    *   Wire up form to `/api/register.php`.

4.  **Update Header**
    *   Edit `public/includes/header.php`.
    *   Add "Login" / "Register" buttons next to "Book a Call".

5.  **Validation**
    *   Test successful login (should alert success/redirect).
    *   Test failed login (should show error).
    *   Test registration.

## ✅ Verification Plan

### Manual Verification
1.  **Register Flow**
    *   Go to `/register.php`.
    *   Enter valid Name, Email, Password.
    *   Click Register.
    *   **Expect**: Success message and redirect to Login or Home.
    *   **Verify DB**: Check `users` table via CLI or PHP script to confirm user creation.

2.  **Login Flow**
    *   Go to `/login.php`.
    *   Enter the created credentials.
    *   Click Login.
    *   **Expect**: Success JSON response handled (e.g., "Welcome [Name]").

3.  **Navigation**
    *   Check Home page.
    *   Click "Login" button in header -> Goes to `/login.php`.
