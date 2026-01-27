<?php include 'includes/header.php'; ?>

<!-- Hero Section -->
<section class="hero scroll-fade">
    <div class="glow"></div>
    <div class="glow-2"></div>
    <div class="hero-bg-grid"></div>
    <div class="container">
        <div class="hero-grid">
            <div class="hero-content">
                <h1>We build revenue-driven <br> <span class="text-gradient typing-text">SaaS, Automations & Actors</span></h1>
                <p class="scroll-fade delay-100">From idea → production → monetization. <br>We turn data problems into profitable assets for data-hungry businesses.</p>
                
                <div class="hero-actions scroll-fade delay-200">
                    <a href="/contact.php" class="btn btn-primary">Book a Strategy Call</a>
                    <a href="/products.php" class="btn btn-outline">View Products</a>
                </div>
            </div>

            <div class="hero-visual scroll-fade delay-300">
                <div class="card-stack">
                    <!-- Top Card -->
                    <div class="stack-item">
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
                            <div style="display: flex; align-items: center; gap: 0.8rem;">
                                <div style="width: 40px; height: 40px; border-radius: 10px; background: rgba(99, 102, 241, 0.2); display: flex; align-items: center; justify-content: center; color: #818cf8; font-size: 1.2rem;">⚡</div>
                                <div>
                                    <div style="font-weight: 700; font-size: 1rem; color: white;">Viral Signal</div>
                                    <div style="font-size: 0.75rem; color: var(--text-muted);">TikTok Shop • Just Now</div>
                                </div>
                            </div>
                        </div>

                        <div style="background: rgba(255,255,255,0.03); border-radius: 12px; padding: 1rem; margin-bottom: 1rem; border: 1px solid rgba(255,255,255,0.05);">
                            <div style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 0.25rem;">Detected Product</div>
                            <div style="font-weight: 600; font-size: 1.1rem;">Portable Neck Fan</div>
                        </div>

                        <!-- Code Snippet -->
                        <div style="background: rgba(0,0,0,0.3); border-radius: 8px; padding: 0.75rem; font-family: monospace; font-size: 0.65rem; line-height: 1.4; color: #a5b4fc; margin-bottom: 1rem; border: 1px solid rgba(255,255,255,0.05);">
                            <div style="margin-bottom: 2px;"><span style="color: #c084fc;">const</span> trend = <span style="color: #22d3ee;">await</span> scan(<span style="color: #86efac;">'tiktok'</span>);</div>
                            <div style="margin-bottom: 2px;"><span style="color: #c084fc;">if</span> (trend.velocity > <span style="color: #fca5a5;">800</span>) {</div>
                            <div style="padding-left: 1rem; color: #64748b;">// Signal Detected 🚀</div>
                            <div style="padding-left: 1rem;">alert(<span style="color: #86efac;">'High Demand'</span>);</div>
                            <div>}</div>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: auto;">
                            <div>
                                <div style="font-size: 0.75rem; color: var(--text-muted);">Growth Rate</div>
                                <div style="color: var(--success); font-weight: 700;">+840% 📈</div>
                            </div>
                            <div>
                                <div style="font-size: 0.75rem; color: var(--text-muted);">Est. Revenue</div>
                                <div style="color: white; font-weight: 700;">$12.5k/day</div>
                            </div>
                        </div>
                    </div>
                    <!-- Middle Card -->
                    <div class="stack-item"></div>
                    <!-- Bottom Card -->
                    <div class="stack-item"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Clarity Section (What You Actually Sell) -->
<section class="section-padding">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="scroll-fade">What We Actually Build</h2>
            <p class="scroll-fade delay-100" style="color: var(--text-muted); max-width: 600px; margin: 0 auto;">We don't just write code. We build assets that generate revenue.</p>
        </div>
        
        <div class="bento-grid">
            <!-- Card 1: Apify Actors (Large) -->
            <div class="bento-item span-8 scroll-fade delay-100">
                <div class="card-icon">🕷️</div>
                <h3>Apify Actors</h3>
                <p>Production-ready scrapers and crawlers. We build robust Actors that withstand anti-scraping measures and deliver clean, structured JSON data at scale.</p>
                <div class="card-tags">
                    <span>Data Scraping</span>
                    <span>Intelligence</span>
                    <span>Monitoring</span>
                </div>
            </div>
            
            <!-- Card 2: AI & Automation (Tall) -->
            <div class="bento-item span-4 row-2 scroll-fade delay-200" style="background: linear-gradient(160deg, var(--bg-card) 0%, rgba(99,102,241,0.05) 100%);">
                <div>
                    <div class="card-icon">⚡</div>
                    <h3>AI & Automation</h3>
                    <p>N8n workflows and AI Agents that replace human loops. We automate scraping -> enrichment -> outreach pipelines to run on autopilot.</p>
                </div>
                 <div class="card-tags" style="margin-top: 2rem;">
                    <span>n8n</span>
                    <span>Agents</span>
                    <span>Pipelines</span>
                    <span>RAG</span>
                </div>
            </div>
            
            <!-- Card 3: Custom SaaS -->
            <div class="bento-item span-4 scroll-fade delay-300">
                <div class="card-icon">🚀</div>
                <h3>Custom SaaS</h3>
                <p>Full-stack products built for monetization. From "just an idea" to a stripe-integrated SaaS.</p>
                 <div class="card-tags">
                    <span>MVP</span>
                    <span>Scale</span>
                </div>
            </div>

            <!-- Card 4: Data Intelligence -->
            <div class="bento-item span-4 scroll-fade delay-400">
                <div class="card-icon">📊</div>
                <h3>Data → Value</h3>
                <p>Dashboards, alerts, and insights that help you make decisions, not just read spreadsheets.</p>
                 <div class="card-tags">
                    <span>Insights</span>
                    <span>Dashboards</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Proof of Expertise -->
<section class="scroll-fade" style="border-top: 1px solid var(--border-color); padding: 4rem 0;">
    <div class="container">
        <p class="text-center" style="color: var(--text-muted); font-size: 0.85rem; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 3rem;">Powering Data Operations With</p>
        
        <div class="logos-track">
            <!-- Slide 1 -->
            <div class="logos-slide">
                <span class="logo-item">Apify</span>
                <span class="logo-item">n8n</span>
                <span class="logo-item">OpenAI</span>
                <span class="logo-item">Python</span>
                <span class="logo-item">Node.js</span>
                <span class="logo-item">Ollama</span>
            </div>
            <!-- Slide 2 (Duplicate for infinite loop) -->
            <div class="logos-slide">
                <span class="logo-item">Apify</span>
                <span class="logo-item">n8n</span>
                <span class="logo-item">OpenAI</span>
                <span class="logo-item">Python</span>
                <span class="logo-item">Node.js</span>
                <span class="logo-item">Ollama</span>
            </div>
        </div>

        <div class="grid-2" style="margin-top: 5rem; max-width: 800px; margin-left: auto; margin-right: auto;">
            <div class="metric-card scroll-fade delay-100">
                <span class="metric-number">50+</span>
                <span class="metric-label">Actors Shipped</span>
            </div>
            <div class="metric-card scroll-fade delay-200">
                <span class="metric-number">10k+</span>
                <span class="metric-label">Automated Runs/Day</span>
            </div>
        </div>
    </div>
</section>

<!-- Comparison Section -->
<section class="section-padding">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="scroll-fade">Why We Are Different</h2>
            <p class="scroll-fade delay-100" style="color: var(--text-muted); max-width: 600px; margin: 0 auto;">Most agencies sell code. We sell business outcomes.</p>
        </div>

        <div class="comparison-table scroll-fade delay-200">
            <div class="comparison-header">
                <div class="col">Standard Scrapers</div>
                <div class="col highlight">Our Data Assets</div>
            </div>
            <div class="comparison-row">
                <div class="col text-muted">Raw HTML / Messy JSON</div>
                <div class="col highlight">Clean, LLM-Ready Data</div>
            </div>
            <div class="comparison-row">
                <div class="col text-muted">Breaks on Layout Changes</div>
                <div class="col highlight">Self-Healing & Robust</div>
            </div>
            <div class="comparison-row">
                <div class="col text-muted">Technical Complexity</div>
                <div class="col highlight">Business Signal Focus</div>
            </div>
            <div class="comparison-row">
                <div class="col text-muted">"Here is the data"</div>
                <div class="col highlight">"Here is the profit"</div>
            </div>
        </div>
    </div>
</section>

<!-- Use Cases Teaser -->
<section class="section-padding" style="background: linear-gradient(180deg, rgba(255,255,255,0.02) 0%, transparent 100%);">
    <div class="container">
         <div class="section-header scroll-fade" style="margin-bottom: 3rem;">
            <h2>Recent Impact</h2>
            <p style="color: var(--text-muted); max-width: 500px;">Real business problems solved with automation.</p>
        </div>

        <div class="grid-3">
             <div class="card scroll-fade delay-100" style="background: transparent; border: none; padding: 0;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">📈</div>
                <h3 style="font-size: 1.25rem;">Market Intelligence</h3>
                <p style="font-size: 0.95rem;"><strong>Problem:</strong> Client spent 20h/week manually checking competitor prices.</p>
                <p style="font-size: 0.95rem;"><strong>Solution:</strong> Custom Apify Actor + Slack Alerting.</p>
                <div class="text-gradient" style="font-weight: 700; margin-top: 0.5rem;">Result: Saved $4k/mo in labor</div>
            </div>

            <div class="card scroll-fade delay-200" style="background: transparent; border: none; padding: 0;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🎯</div>
                <h3 style="font-size: 1.25rem;">Lead Generation</h3>
                <p style="font-size: 0.95rem;"><strong>Problem:</strong> Sales team lacked verified emails for high-ticket prospects.</p>
                <p style="font-size: 0.95rem;"><strong>Solution:</strong> LinkedIn Scraper -> Waterfall Enrichment API.</p>
                <div class="text-gradient" style="font-weight: 700; margin-top: 0.5rem;">Result: +40% Meeting Book Rate</div>
            </div>

             <div class="card scroll-fade delay-300" style="background: transparent; border: none; padding: 0;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">🛒</div>
                <h3 style="font-size: 1.25rem;">Social Commerce</h3>
                <p style="font-size: 0.95rem;"><strong>Problem:</strong> Missed viral trends on TikTok Shop.</p>
                <p style="font-size: 0.95rem;"><strong>Solution:</strong> Real-time Monitor + Trend Prediction Algorithm.</p>
                <div class="text-gradient" style="font-weight: 700; margin-top: 0.5rem;">Result: First to market on 3 viral items</div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products -->
<section class="section-padding" style="background: rgba(255,255,255,0.02);">
    <div class="container">
        <div class="section-header scroll-fade" style="display: flex; justify-content: space-between; align-items: end; margin-bottom: 3rem;">
            <div>
                <h2>Featured Products</h2>
                <p style="color: var(--text-muted); max-width: 500px;">Ready-to-deploy assets driving revenue today. Stop building from scratch.</p>
            </div>
            <a href="/products.php" class="text-gradient" style="font-weight: 600;">View all →</a>
        </div>
        
        <div class="products-grid">
            <!-- Product 1 -->
            <a href="#" class="product-card scroll-fade delay-100">
                <div class="product-image">
                    <div style="text-align: center;">
                        <span style="font-size: 3rem; display: block; margin-bottom: 0.5rem;">🎵</span>
                        <span style="font-family: var(--font-heading); font-weight: 700;">TikTok Intelligence</span>
                    </div>
                </div>
                <div class="product-content">
                    <span class="product-tag">BESTSELLER</span>
                    <h3 class="product-title">TikTok Shop Scraper</h3>
                    <p class="product-desc">Extract sales data, trending products, and competitor revenue estimates from TikTok Shop in real-time. JSON output ready for analysis.</p>
                    <div class="product-footer">
                        <span class="price">$49/mo</span>
                        <span class="btn-outline" style="padding: 0.4rem 1rem; font-size: 0.8rem; border-radius: 6px;">View Details</span>
                    </div>
                </div>
            </a>
            
            <!-- Product 2 -->
            <a href="#" class="product-card scroll-fade delay-200">
                <div class="product-image">
                     <div style="text-align: center;">
                        <span style="font-size: 3rem; display: block; margin-bottom: 0.5rem;">🧠</span>
                        <span style="font-family: var(--font-heading); font-weight: 700;">Context Builder</span>
                    </div>
                </div>
                <div class="product-content">
                    <span class="product-tag">AI POWERED</span>
                    <h3 class="product-title">Knowledge Extractor</h3>
                    <p class="product-desc">Turn any website into a clean, markdown-formatted dataset. Perfect for feeding custom LLMs and RAG pipelines.</p>
                    <div class="product-footer">
                        <span class="price">$29/mo</span>
                        <span class="btn-outline" style="padding: 0.4rem 1rem; font-size: 0.8rem; border-radius: 6px;">View Details</span>
                    </div>
                </div>
            </a>
            
            <!-- Product 3 -->
            <a href="#" class="product-card scroll-fade delay-300">
                <div class="product-image">
                     <div style="text-align: center;">
                        <span style="font-size: 3rem; display: block; margin-bottom: 0.5rem;">🕵️‍♂️</span>
                        <span style="font-family: var(--font-heading); font-weight: 700;">Lead Watch</span>
                    </div>
                </div>
                <div class="product-content">
                    <span class="product-tag">AUTOMATION</span>
                    <h3 class="product-title">Job Change Detector</h3>
                    <p class="product-desc">Monitor LinkedIn profiles for job changes and trigger automated outreach campaigns. Never miss a warm lead again.</p>
                    <div class="product-footer">
                        <span class="price">$99/mo</span>
                        <span class="btn-outline" style="padding: 0.4rem 1rem; font-size: 0.8rem; border-radius: 6px;">View Details</span>
                    </div>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- How We Work -->
<section class="section-padding">
    <div class="container">
        <h2 class="text-center scroll-fade" style="margin-bottom: 4rem;">From Problem to Profit</h2>
        
        <div class="timeline">
            <!-- Step 1 -->
            <div class="timeline-item scroll-fade delay-100">
                <div class="timeline-number">01</div>
                <div class="timeline-content">
                    <h3>Identify Signal</h3>
                    <p>We analyze your market or data sources to find the "alpha" — the high-value signal hidden in the noise that others ignore.</p>
                </div>
            </div>

            <!-- Step 2 -->
            <div class="timeline-item scroll-fade delay-200">
                <div class="timeline-number">02</div>
                <div class="timeline-content">
                    <h3>Build Asset</h3>
                    <p>We engineer a robust Actor, AI Agent, or SaaS backend to capture this signal reliably, handling proxies, captchas, and scale.</p>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="timeline-item scroll-fade delay-300">
                <div class="timeline-number">03</div>
                <div class="timeline-content">
                    <h3>Monetize</h3>
                    <p>We package the data or utility into a sellable product (API, SaaS, or Subscription) ready for the Apify Store or your own domain.</p>
                </div>
            </div>

            <!-- Step 4 -->
            <div class="timeline-item scroll-fade delay-400">
                <div class="timeline-number">04</div>
                <div class="timeline-content">
                    <h3>Scale</h3>
                    <p>We optimize for volume and cost-efficiency, ensuring your margins stay healthy as your user base grows.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Final CTA -->
<section class="section-padding scroll-fade" style="text-align: center; background: radial-gradient(circle at center, rgba(99, 102, 241, 0.1) 0%, transparent 70%);">
    <div class="container">
        <h2 style="font-size: 3rem; margin-bottom: 2rem;">Have a data problem? <br>We'll turn it into a product.</h2>
        <a href="/contact.php" class="btn btn-primary" style="font-size: 1.2rem; padding: 1rem 2.5rem;">Start Your Project</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
