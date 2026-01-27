<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - SaaS Agency</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@500;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #0f172a; /* Darker background for admin */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .admin-login-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 2.5rem;
            border-radius: 1rem;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
        .admin-login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .admin-login-header h1 {
            font-family: 'Outfit', sans-serif;
            color: #fff;
            margin-bottom: 0.5rem;
        }
        .admin-login-header p {
            color: #94a3b8;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="admin-login-card">
    <div class="admin-login-header">
        <h1>Admin Portal</h1>
        <p>Restricted Access</p>
    </div>
    
    <form id="admin-login-form" class="auth-form">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required placeholder="admin@example.com">
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required placeholder="••••••••">
        </div>
        
        <button type="submit" class="btn btn-primary btn-block">
            <span>Login to Dashboard</span>
        </button>
        
        <div id="login-message" class="message"></div>
    </form>
</div>

<script>
document.getElementById('admin-login-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const messageEl = document.getElementById('login-message');
    
    messageEl.textContent = 'Authenticating...';
    messageEl.className = 'message';
    
    try {
        const response = await fetch('../api/login.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ email, password })
        });
        
        const data = await response.json();
        
        if (response.ok) {
            if (data.user.role === 'admin') {
                messageEl.textContent = 'Login successful. Redirecting...';
                messageEl.className = 'message success';
                setTimeout(() => window.location.href = 'index.php', 1000);
            } else {
                messageEl.textContent = 'Access Denied: Not an Administrator.';
                messageEl.className = 'message error';
                // Optional: Logout immediately if we don't want them logged in as customer here
            }
        } else {
            messageEl.textContent = data.error || 'Login failed';
            messageEl.className = 'message error';
        }
    } catch (error) {
        console.error('Error:', error);
        messageEl.textContent = 'An error occurred. Please try again.';
        messageEl.className = 'message error';
    }
});
</script>

</body>
</html>
