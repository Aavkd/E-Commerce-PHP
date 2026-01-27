
document.addEventListener('DOMContentLoaded', () => {
    initScrollReveal();
    initTypingEffect();
});

/**
 * Scroll Reveal Animation
 * Uses IntersectionObserver to trigger fade-up animations
 */
function initScrollReveal() {
    const observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
                observer.unobserve(entry.target); // Only animate once
            }
        });
    }, observerOptions);

    const revealElements = document.querySelectorAll('.scroll-fade');
    revealElements.forEach(el => observer.observe(el));
}

/**
 * Typing Effect for Hero Title
 * Targets .typing-text to cycle through words
 */
function initTypingEffect() {
    const textElement = document.querySelector('.typing-text');
    if (!textElement) return;

    // The static text is "SaaS, Automations & Actors"
    // We want to make it dynamic or just type it out once?
    // The design implies it might cycle. Let's make it cycle through high-value keywords.
    // Or, based on the HTML <span class="text-gradient typing-text">SaaS, Automations & Actors</span>
    // It seems the user might want this whole string to be typed out or cycled.
    // Let's implement a cycle for "SaaS", "Apify Actors", "Automations", "Data Products".

    // However, the HTML hardcodes "SaaS, Automations & Actors". 
    // If we want to keep the hardcoded text as the first state:
    const phrases = ["SaaS", "Apify Actors", "Automations", "Data Products"];
    let phraseIndex = 0;
    let charIndex = 0;
    let isDeleting = false;
    let typeSpeed = 100;

    // Clear initial content if we want to start typing from scratch
    // or keep it if we want to just start deleting after a pause.
    // Let's start by letting the user read the initial static text, then cycle.
    // textElement.textContent is currently "SaaS, Automations & Actors"

    // Actually, to be safe and avoid jarring shifts, let's just type the specific words requested if the HTML is empty, 
    // but since HTML has content, maybe we should just leave it as a simple typewriter entry effect?
    // "The Hero title will have a slick type-writer animation"
    // Let's make it type out the *initial* text on load, then maybe cycle if desired. 
    // For now, let's just make it cycle to show activity.

    // Override initial text to start the effect
    const initialText = textElement.textContent;
    if (initialText.trim().length > 0) {
        phrases.unshift(initialText); // Add original to the start
    }

    function type() {
        const currentPhrase = phrases[phraseIndex];

        if (isDeleting) {
            textElement.textContent = currentPhrase.substring(0, charIndex - 1);
            charIndex--;
            typeSpeed = 50;
        } else {
            textElement.textContent = currentPhrase.substring(0, charIndex + 1);
            charIndex++;
            typeSpeed = 100;
        }

        if (!isDeleting && charIndex === currentPhrase.length) {
            isDeleting = true;
            typeSpeed = 3000; // Pause longer to read
        } else if (isDeleting && charIndex === 0) {
            isDeleting = false;
            phraseIndex = (phraseIndex + 1) % phrases.length;
            typeSpeed = 500; // Pause before new word
        }

        setTimeout(type, typeSpeed);
    }

    // Start effect
    type();
}

/**
 * Particle Network Animation for Hero
 */
function initParticles() {
    const heroSection = document.querySelector('.hero');
    if (!heroSection) return;

    const canvas = document.createElement('canvas');
    canvas.id = 'particles-canvas';
    heroSection.appendChild(canvas);

    const ctx = canvas.getContext('2d');
    let width, height;
    let particles = [];

    // Configuration
    const particleCount = 60;
    const connectionDistance = 150;
    const mouseDistance = 200;

    let mouse = { x: null, y: null };

    window.addEventListener('mousemove', (e) => {
        const rect = heroSection.getBoundingClientRect();
        if (e.clientY >= rect.top && e.clientY <= rect.bottom) {
            mouse.x = e.clientX;
            mouse.y = e.clientY - rect.top;
        } else {
            mouse.x = null;
            mouse.y = null;
        }
    });

    window.addEventListener('mouseleave', () => {
        mouse.x = null;
        mouse.y = null;
    });

    function resize() {
        width = canvas.width = heroSection.offsetWidth;
        height = canvas.height = heroSection.offsetHeight;
    }

    class Particle {
        constructor() {
            this.x = Math.random() * width;
            this.y = Math.random() * height;
            this.vx = (Math.random() - 0.5) * 0.5;
            this.vy = (Math.random() - 0.5) * 0.5;
            this.size = Math.random() * 2 + 1;
            this.color = `rgba(99, 102, 241, ${Math.random() * 0.5})`; // Brand primary color
        }

        update() {
            this.x += this.vx;
            this.y += this.vy;

            // Bounce off edges
            if (this.x < 0 || this.x > width) this.vx *= -1;
            if (this.y < 0 || this.y > height) this.vy *= -1;

            // Mouse interaction
            if (mouse.x != null) {
                let dx = mouse.x - this.x;
                let dy = mouse.y - this.y;
                let distance = Math.sqrt(dx * dx + dy * dy);
                if (distance < mouseDistance) {
                    const forceDirectionX = dx / distance;
                    const forceDirectionY = dy / distance;
                    const force = (mouseDistance - distance) / mouseDistance;
                    const directionX = forceDirectionX * force * 0.6;
                    const directionY = forceDirectionY * force * 0.6;
                    this.vx += directionX;
                    this.vy += directionY;
                }
            }
        }

        draw() {
            ctx.beginPath();
            ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
            ctx.fillStyle = this.color;
            ctx.fill();
        }
    }

    function init() {
        particles = [];
        for (let i = 0; i < particleCount; i++) {
            particles.push(new Particle());
        }
    }

    function animate() {
        ctx.clearRect(0, 0, width, height);

        for (let i = 0; i < particles.length; i++) {
            particles[i].update();
            particles[i].draw();

            // Connections
            for (let j = i; j < particles.length; j++) {
                let dx = particles[i].x - particles[j].x;
                let dy = particles[i].y - particles[j].y;
                let distance = Math.sqrt(dx * dx + dy * dy);

                if (distance < connectionDistance) {
                    ctx.beginPath();
                    ctx.strokeStyle = `rgba(99, 102, 241, ${1 - distance / connectionDistance})`;
                    ctx.lineWidth = 1;
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.stroke();
                }
            }
        }
        requestAnimationFrame(animate);
    }

    window.addEventListener('resize', () => {
        resize();
        init();
    });

    resize();
    init();
    animate();
}

// Initialize particles
document.addEventListener('DOMContentLoaded', () => {
    // ... existing init calls ...
    initParticles();
});
