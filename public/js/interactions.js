document.addEventListener("DOMContentLoaded", () => {

    // --- Parallax Hero Effect ---
    const heroSection = document.querySelector('.hero');
    const cardStack = document.querySelector('.card-stack');

    if (heroSection && cardStack) {
        heroSection.addEventListener('mousemove', (e) => {
            const x = e.clientX / window.innerWidth;
            const y = e.clientY / window.innerHeight;

            // Calculate rotation based on cursor position (centered at 0.5)
            // Range: -15deg base + offset
            const rotateY = -15 + (x - 0.5) * 20; // -25 to -5
            const rotateX = 10 + (y - 0.5) * -20;  // 20 to 0

            cardStack.style.transform = `rotateY(${rotateY}deg) rotateX(${rotateX}deg)`;
        });

        // Reset on mouse leave
        heroSection.addEventListener('mouseleave', () => {
            cardStack.style.transform = `rotateY(-15deg) rotateX(10deg)`;
        });
    }

    // --- Magnetic Buttons ---
    const magneticButtons = document.querySelectorAll('.btn-primary');

    magneticButtons.forEach(btn => {
        btn.addEventListener('mousemove', (e) => {
            const rect = btn.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            // Calculate distance from center
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;

            const deltaX = (x - centerX) * 0.4; // Magnetic strength
            const deltaY = (y - centerY) * 0.4;

            btn.style.transform = `translate(${deltaX}px, ${deltaY}px)`;
        });

        btn.addEventListener('mouseleave', () => {
            btn.style.transform = `translate(0px, 0px)`;
        });
    });

    // --- Lenis Smooth Scroll ---
    if (typeof Lenis !== 'undefined') {
        const lenis = new Lenis({
            duration: 1.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            direction: 'vertical',
            gestureDirection: 'vertical',
            smooth: true,
            mouseMultiplier: 1,
            smoothTouch: false,
            touchMultiplier: 2,
        });

        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }

        requestAnimationFrame(raf);
    }

    // --- Animated Counters ---
    const counters = document.querySelectorAll('.counter');

    const counterObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const target = +counter.getAttribute('data-target');
                const duration = 2000; // 2 seconds
                const increment = target / (duration / 16); // 60fps

                let current = 0;

                const updateCounter = () => {
                    current += increment;
                    if (current < target) {
                        // Format: If decimal, show 1 decimal place, else integer
                        counter.innerText = Number.isInteger(target) ? Math.ceil(current) : current.toFixed(1);
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.innerText = target;
                    }
                };

                updateCounter();
                observer.unobserve(counter);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(counter => counterObserver.observe(counter));

    // --- Scroll Reveal Text Observer ---
    const revealElements = document.querySelectorAll('.reveal-text');

    const revealObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, { threshold: 0.1 });

    revealElements.forEach(el => revealObserver.observe(el));
});
