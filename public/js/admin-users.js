/**
 * public/js/admin-users.js
 * Handles admin user management
 */

async function loadAdminUsers() {
    const listEl = document.getElementById('user-list');
    if (!listEl) return;

    try {
        const response = await fetch('/api/admin/users/list.php');
        const users = await response.json();

        if (!response.ok) throw new Error(users.error || 'Failed to fetch');

        listEl.innerHTML = users.map(u => `
            <tr>
                <td>#${u.id}</td>
                <td style="font-weight: 500; color: #fff;">${escapeHtml(u.name)}</td>
                <td>${escapeHtml(u.email)}</td>
                <td>
                    <span style="
                        font-size: 0.75rem; 
                        padding: 0.2rem 0.5rem; 
                        border-radius: 4px; 
                        background: ${u.role === 'admin' ? 'rgba(99, 102, 241, 0.2)' : 'rgba(148, 163, 184, 0.2)'}; 
                        color: ${u.role === 'admin' ? '#818cf8' : '#94a3b8'};
                    ">
                        ${u.role.toUpperCase()}
                    </span>
                </td>
                <td>${new Date(u.created_at).toLocaleDateString()}</td>
                <td>
                    ${u.role !== 'admin' ?
                `<button onclick="deleteUser(${u.id})" class="action-btn btn-delete">Delete</button>` :
                `<span style="color: #64748b; font-size: 0.8rem;">Protected</span>`
            }
                </td>
            </tr>
        `).join('');

        if (users.length === 0) {
            listEl.innerHTML = '<tr><td colspan="6" class="text-center" style="padding: 2rem;">No users found.</td></tr>';
        }

    } catch (error) {
        console.error('Error:', error);
        listEl.innerHTML = `<tr><td colspan="6" style="color: #ef4444; text-align: center;">Error loading users: ${error.message}</td></tr>`;
    }
}

async function deleteUser(id) {
    if (!confirm('Are you sure you want to delete this user? This action cannot be undone.')) return;

    try {
        const response = await fetch('/api/admin/users/delete.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id })
        });

        if (response.ok) {
            loadAdminUsers();
        } else {
            const data = await response.json();
            alert('Failed to delete: ' + (data.error || 'Unknown error'));
        }
    } catch (error) {
        alert('Error deleting user');
    }
}

function escapeHtml(text) {
    if (!text) return '';
    return text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}
