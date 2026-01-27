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
                        <div class="password-wrapper">
                            <input type="password" id="password" class="form-control" placeholder="••••••••" required>
                            <button type="button" class="password-toggle-btn" aria-label="Toggle password visibility">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
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
