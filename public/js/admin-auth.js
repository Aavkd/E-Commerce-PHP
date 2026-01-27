/**
 * public/js/admin-auth.js
 * Include this script on every Admin Dashboard page to restrict access.
 */
(async function () {
    try {
        const response = await fetch('/api/admin/check_auth.php');
        if (!response.ok) {
            // Not authorized or not logged in
            window.location.href = '/admin/login.php';
        } else {
            const data = await response.json();
            if (data.role !== 'admin') {
                window.location.href = '/admin/login.php';
            }
            // If authorized, do nothing and let page load
        }
    } catch (error) {
        console.error('Auth Check Failed:', error);
        window.location.href = '/admin/login.php';
    }
})();
