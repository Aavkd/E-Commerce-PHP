<?php include 'includes/header.php'; ?>

<section class="section-padding" style="min-height: 80vh; display: flex; align-items: center; position: relative; overflow: hidden;">
    <div class="glow" style="top: 50%; width: 600px; height: 600px;"></div>
    
    <div class="container">
        <div class="auth-container">
            <div class="auth-card scroll-fade">
                <div class="auth-header">
                    <h2>Welcome Back</h2>
                    <p>Enter your credentials to access your dashboard</p>
                </div>

                <form id="loginForm">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" class="form-control" placeholder="name@company.com" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" class="form-control" placeholder="••••••••" required>
                    </div>

                    <div style="text-align: right; margin-bottom: 1.5rem;">
                        <a href="#" style="color: var(--text-muted); font-size: 0.85rem;">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn-auth">Sign In</button>
                </form>

                <div class="auth-footer">
                    <p>Don't have an account? <a href="/register.php">Create one</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="/js/auth.js"></script>
<script>
    document.getElementById('loginForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const btn = e.target.querySelector('button');
        const originalText = btn.textContent;

        try {
            btn.textContent = 'Signing in...';
            btn.disabled = true;

            const result = await Auth.login(email, password);
            
            Auth.showSuccess('Login successful! Redirecting...');
            
            setTimeout(() => {
                window.location.href = result.redirect || '/';
            }, 1000);

        } catch (error) {
            Auth.showError(error.message);
            btn.textContent = originalText;
            btn.disabled = false;
        }
    });
</script>

<?php include 'includes/footer.php'; ?>
