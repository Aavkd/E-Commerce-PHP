<?php include 'includes/header.php'; ?>

<section class="hero">
    <div class="container">
        <h1>About <span class="text-gradient">Us</span></h1>
        <p>We are a team of engineers and builders obsessed with automation.</p>
    </div>
</section>

<section class="section-padding">
    <div class="container">
        <div class="grid-2">
            <div>
                <h2 class="mb-2">We build assets, not just code.</h2>
                <p class="mb-2" style="color: var(--text-muted);">
                    Data is useless until it creates a decision. Scraping is easy, but turning it into value is not. 
                    We positioned ourselves to bridge the gap between raw data collection and actual business revenue.
                </p>
                <p class="mb-2" style="color: var(--text-muted);">
                    Most agencies sell "hours" or "scripts". We sell <strong>software assets</strong> that you own, 
                    control, and profit from. Whether it's a TikTok scraper monitoring trends or an AI agent handling 
                    outreach, we build for ROI.
                </p>
            </div>
            <div class="glass-panel" style="padding: 2rem; border-radius: 16px;">
                <h3 class="mb-1">Our Methodology</h3>
                <ul style="color: var(--text-muted); display: flex; flex-direction: column; gap: 1rem;">
                    <li style="display: flex; gap: 1rem; align-items: start;">
                        <span style="color: var(--primary);">01.</span>
                        <span><strong>Signal First:</strong> We don't scrape everything. We identify the specific data points that drive profit.</span>
                    </li>
                    <li style="display: flex; gap: 1rem; align-items: start;">
                        <span style="color: var(--primary);">02.</span>
                        <span><strong>Robust Engineering:</strong> Built on Apify and n8n. Retries, proxy rotation, and error handling are standard.</span>
                    </li>
                    <li style="display: flex; gap: 1rem; align-items: start;">
                        <span style="color: var(--primary);">03.</span>
                        <span><strong>Monetization Ready:</strong> Outputs are clean JSON, ready for LLMs, Dashboards, or Resale.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="section-padding" style="background: rgba(255,255,255,0.02);">
    <div class="container text-center">
        <h2 class="mb-3">Why Apify & Automation?</h2>
        <div class="grid-3">
            <div class="card">
                <div class="card-icon">🏗️</div>
                <h3>Infrastructure</h3>
                <p>We leverage Apify's serverless cloud to scale from 100 to 10M pages without breaking a sweat.</p>
            </div>
            <div class="card">
                <div class="card-icon">🧠</div>
                <h3>Intelligence</h3>
                <p>We integrate LLMs (OpenAI, Ollama) directly into the pipeline to clean and enrich data instantly.</p>
            </div>
            <div class="card">
                <div class="card-icon">⏱️</div>
                <h3>Speed</h3>
                <p>Automation replaces human thinking loops. What takes a team a week, our actors do in minutes.</p>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>

