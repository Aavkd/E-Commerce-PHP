<?php
// public/admin/users.php
require_once 'includes/header.php';
?>

<div class="admin-page-header">
    <h1 class="admin-page-title">Users</h1>
    <!-- No "Add User" for now, as registration is public or done via DB seed -->
</div>

<div class="admin-card">
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Joined</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id="user-list">
            <tr>
                <td colspan="6" style="text-align: center; color: #94a3b8;">Loading users...</td>
            </tr>
        </tbody>
    </table>
</div>

<script src="../js/admin-users.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', loadAdminUsers);
</script>

</body>
</html>
