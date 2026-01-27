<?php include 'includes/header.php'; ?>

<section class="section-padding" style="min-height: 80vh; display: flex; align-items: center; position: relative; overflow: hidden;">
    <div class="glow" style="top: 50%; width: 600px; height: 600px; background: radial-gradient(circle, rgba(139, 92, 246, 0.12) 0%, rgba(0, 0, 0, 0) 70%);"></div>
    
    <div class="container">
        <div class="auth-container">
            <div class="auth-card scroll-fade">
                <div class="auth-header">
                    <h2>Create Account</h2>
                    <p>Start turning your data into revenue</p>
                </div>

                <form id="registerForm">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" class="form-control" placeholder="John Doe" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" class="form-control" placeholder="name@company.com" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" class="form-control" placeholder="••••••••" required minlength="8">
                            <button type="button" class="password-toggle-btn" aria-label="Toggle password visibility">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <div class="password-wrapper">
                            <input type="password" id="confirmPassword" class="form-control" placeholder="••••••••" required>
                            <button type="button" class="password-toggle-btn" aria-label="Toggle password visibility">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn-auth">Create Account</button>
                </form>

                <div class="auth-footer">
                    <p>Already have an account? <a href="/login.php">Sign in</a></p>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="/js/auth.js"></script>
<script>
    document.getElementById('registerForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirmPassword').value;
        const btn = e.target.querySelector('button');
        const originalText = btn.textContent;

        if (password !== confirmPassword) {
            Auth.showError('Passwords do not match');
            return;
        }

        try {
            btn.textContent = 'Creating account...';
            btn.disabled = true;

            const result = await Auth.register(name, email, password);
            
            Auth.showSuccess('Account created! Redirecting to login...');
            
            setTimeout(() => {
                window.location.href = '/login.php';
            }, 1500);

        } catch (error) {
            Auth.showError(error.message);
            btn.textContent = originalText;
            btn.disabled = false;
        }
    });
</script>

<?php include 'includes/footer.php'; ?>
