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
                        <input type="password" id="password" class="form-control" placeholder="••••••••" required minlength="8">
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" id="confirmPassword" class="form-control" placeholder="••••••••" required>
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
