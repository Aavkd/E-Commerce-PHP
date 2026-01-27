<?php include 'includes/header.php'; ?>

<section class="hero">
    <div class="container">
        <h1>Our <span class="text-gradient">Services</span></h1>
        <p>Premium development services for the modern data economy.</p>
    </div>
</section>

<!-- Service Overview -->
<section class="section-padding">
    <div class="container">
        <div class="grid-3">
            <a href="#actors" class="card">
                <div class="card-icon">🕷️</div>
                <h3>Apify Actors</h3>
                <p>Production-ready scrapers and crawlers. Built to withstand anti-scraping and scale infinitely.</p>
            </a>
            
            <a href="#automation" class="card">
                <div class="card-icon">⚙️</div>
                <h3>Workflows</h3>
                <p>End-to-end automation using n8n. Connect your data to your decision-making tools.</p>
            </a>
            
            <a href="#saas" class="card">
                <div class="card-icon">💻</div>
                <h3>Custom SaaS</h3>
                <p>Full-stack development. We build the architecture, you own the revenue stream.</p>
            </a>
        </div>
    </div>
</section>

<!-- Apify Actors Detail -->
<section id="actors" class="section-padding" style="background: rgba(255,255,255,0.02);">
    <div class="container">
        <div class="grid-2">
            <div>
                <span class="product-tag">DATA COLLECTION</span>
                <h2 class="mb-2">Apify Actors</h2>
                <p class="mb-2" style="color: var(--text-muted);">
                    We don't just write scripts; we build <strong>Actors designed as products</strong>. 
                    Most scraping projects fail because they focus on raw data. We focus on the <em>signal</em>.
                </p>
                <ul style="margin-bottom: 2rem;">
                    <li class="mb-1">✅ <strong>Market Intelligence:</strong> Track competitors, pricing, and trends.</li>
                    <li class="mb-1">✅ <strong>Social Commerce:</strong> Monitor TikTok Shop, Instagram, and LinkedIn.</li>
                    <li class="mb-1">✅ <strong>Lead Detection:</strong> Identify high-intent leads before they look for you.</li>
                </ul>
                <a href="/contact.php" class="btn btn-primary">Request an Actor</a>
            </div>
            <div class="glass-panel" style="padding: 2rem; border-radius: 16px;">
                <h3 class="mb-1">Why our Actors are different</h3>
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <div>
                        <h4 style="color: var(--text-main);">LLM-Ready Output</h4>
                        <p style="font-size: 0.9rem; color: var(--text-muted);">Clean JSON/Markdown, not messy HTML. Ready for AI analysis.</p>
                    </div>
                    <div>
                        <h4 style="color: var(--text-main);">Business Logic Included</h4>
                        <p style="font-size: 0.9rem; color: var(--text-muted);">We calculate metrics and filter noise before the data hits your DB.</p>
                    </div>
                    <div>
                        <h4 style="color: var(--text-main);">Anti-Detect Standard</h4>
                        <p style="font-size: 0.9rem; color: var(--text-muted);">Fingerprint rotation and proxy management built-in.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Automations Detail -->
<section id="automation" class="section-padding">
    <div class="container">
        <div class="grid-2">
            <div class="glass-panel" style="padding: 2rem; border-radius: 16px;">
                 <h3 class="mb-1">Our Stack</h3>
                 <div class="grid-2" style="gap: 1rem;">
                    <div style="background: rgba(255,255,255,0.05); padding: 1rem; border-radius: 8px; text-align: center;">n8n</div>
                    <div style="background: rgba(255,255,255,0.05); padding: 1rem; border-radius: 8px; text-align: center;">Apify</div>
                    <div style="background: rgba(255,255,255,0.05); padding: 1rem; border-radius: 8px; text-align: center;">OpenAI</div>
                    <div style="background: rgba(255,255,255,0.05); padding: 1rem; border-radius: 8px; text-align: center;">Slack/CRM</div>
                 </div>
            </div>
            <div>
                <span class="product-tag">OPERATIONS</span>
                <h2 class="mb-2">Automations & Workflows</h2>
                <p class="mb-2" style="color: var(--text-muted);">
                    Automation that replaces human thinking loops, not just tasks. We build autonomous systems that watch your data and act on it.
                </p>
                <p class="mb-2" style="color: var(--text-muted);">
                    Imagine a system that scrapes new leads, enriches them with LinkedIn data, qualifies them using GPT-4, and drafts a personalized email for your sales team.
                </p>
                <a href="/contact.php" class="btn btn-outline">Automate Your Operations</a>
            </div>
        </div>
    </div>
</section>

<!-- SaaS Detail -->
<section id="saas" class="section-padding" style="background: rgba(255,255,255,0.02);">
    <div class="container text-center">
        <span class="product-tag">FULL STACK</span>
        <h2 class="mb-2">Custom SaaS Development</h2>
        <p style="color: var(--text-muted); max-width: 600px; margin: 0 auto 3rem;">
            From idea to monetized product without burning months of dev time. 
            We handle the architecture, authentication, and payments so you can launch.
        </p>
        
        <div class="grid-3">
            <div class="card">
                <h3>MVP Fast</h3>
                <p>Launch in weeks, not months. Validate your idea with real users.</p>
            </div>
            <div class="card">
                <h3>Scalable</h3>
                <p>Built on solid foundations (PHP/MySQL or Node) that grow with you.</p>
            </div>
            <div class="card">
                <h3>Monetized</h3>
                <p>Stripe/LemonSqueezy integration baked in from day one.</p>
            </div>
        </div>
        
        <div style="margin-top: 3rem;">
             <a href="/contact.php" class="btn btn-primary">Start Your Project</a>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

