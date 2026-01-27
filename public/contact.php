<?php include 'includes/header.php'; ?>

<section class="hero">
    <div class="container">
        <h1>Contact <span class="text-gradient">Us</span></h1>
        <p>Ready to automate? Let's talk.</p>
    </div>
</section>

<section class="section-padding">
    <div class="container" style="max-width: 600px;">
        <div class="card">
            <h3 style="margin-bottom: 2rem; text-align: center;">Book a Strategy Call</h3>
            <p style="text-align: center; margin-bottom: 2rem; color: var(--text-muted);">
                Fill out the form below or email us at hello@moneymaker.agency
            </p>
            <!-- Placeholder Form -->
            <form action="" method="POST" style="display: flex; flex-direction: column; gap: 1rem;">
                <input type="text" placeholder="Name" style="padding: 1rem; background: rgba(0,0,0,0.2); border: 1px solid var(--border-color); color: white; border-radius: 8px;">
                <input type="email" placeholder="Email" style="padding: 1rem; background: rgba(0,0,0,0.2); border: 1px solid var(--border-color); color: white; border-radius: 8px;">
                <textarea placeholder="Tell us about your project" rows="5" style="padding: 1rem; background: rgba(0,0,0,0.2); border: 1px solid var(--border-color); color: white; border-radius: 8px;"></textarea>
                <button type="submit" class="btn btn-primary" style="width: 100%;">Send Message</button>
            </form>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
