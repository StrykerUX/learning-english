// ===== STARFIELD GENERATOR =====
function createStarfield() {
    const starfield = document.createElement('div');
    starfield.className = 'starfield';
    document.body.appendChild(starfield);
    
    const starCount = 150;
    
    for (let i = 0; i < starCount; i++) {
        const star = document.createElement('div');
        star.className = `star ${getRandomStarSize()}`;
        
        // Random position
        star.style.left = Math.random() * 100 + '%';
        star.style.top = Math.random() * 100 + '%';
        
        // Random animation duration
        star.style.setProperty('--duration', (Math.random() * 3 + 2) + 's');
        
        starfield.appendChild(star);
    }
}

function getRandomStarSize() {
    const sizes = ['small', 'medium', 'large'];
    const weights = [70, 25, 5]; // Probabilities: 70% small, 25% medium, 5% large
    
    const random = Math.random() * 100;
    let sum = 0;
    
    for (let i = 0; i < sizes.length; i++) {
        sum += weights[i];
        if (random <= sum) {
            return sizes[i];
        }
    }
    
    return 'small';
}

// ===== FLOATING PARTICLES =====
function createFloatingParticles() {
    const particles = document.createElement('div');
    particles.className = 'particles';
    document.body.appendChild(particles);
    
    const particleSymbols = ['✧', '⋆', '⋇', '◦', '○', '◯', '▵', '◊'];
    const particleCount = 20;
    
    for (let i = 0; i < particleCount; i++) {
        createParticle(particles, particleSymbols);
    }
    
    // Create new particles periodically
    setInterval(() => {
        if (particles.children.length < particleCount) {
            createParticle(particles, particleSymbols);
        }
    }, 3000);
}

function createParticle(container, symbols) {
    const particle = document.createElement('div');
    particle.className = 'particle';
    particle.textContent = symbols[Math.floor(Math.random() * symbols.length)];
    
    // Random horizontal position
    particle.style.left = Math.random() * 100 + '%';
    
    // Random animation duration
    particle.style.animationDuration = (Math.random() * 5 + 10) + 's';
    
    // Random delay
    particle.style.animationDelay = Math.random() * 2 + 's';
    
    container.appendChild(particle);
    
    // Remove particle after animation
    setTimeout(() => {
        if (particle.parentNode) {
            particle.parentNode.removeChild(particle);
        }
    }, 15000);
}

// ===== SMOOTH SCROLLING =====
function addSmoothScrolling() {
    const links = document.querySelectorAll('a[href^="#"]');
    
    for (const link of links) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth' });
            }
        });
    }
}

// ===== INITIALIZATION =====
document.addEventListener('DOMContentLoaded', function() {
    createStarfield();
    createFloatingParticles();
    addSmoothScrolling();
    
    // Add loading animation
    document.body.style.opacity = '0';
    setTimeout(() => {
        document.body.style.transition = 'opacity 0.5s ease';
        document.body.style.opacity = '1';
    }, 100);
});

// ===== RESPONSIVE HANDLING =====
window.addEventListener('resize', function() {
    // Regenerate starfield on large viewport changes
    const starfield = document.querySelector('.starfield');
    if (starfield && window.innerWidth !== window.lastWidth) {
        const children = Array.from(starfield.children);
        if (children.length > 0) {
            // Only recreate if children exist and width changed significantly
            if (Math.abs(window.innerWidth - (window.lastWidth || 0)) > 100) {
                starfield.innerHTML = '';
                createStarfield();
            }
        }
        window.lastWidth = window.innerWidth;
    }
});

// ===== COPY TO CLIPBOARD FUNCTION =====
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        showNotification('Copiado al portapapeles!', 'success');
    }, function() {
        console.error('Error al copiar texto');
    });
}

// ===== NOTIFICATION SYSTEM =====
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.innerHTML = `
        <div class="notification-content">
            <i class="fas fa-check-circle"></i>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.add('show');
    }, 100);
    
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 500);
    }, 3000);
}

// ===== UTILITY FUNCTIONS =====
function goBack() {
    window.history.back();
}

// ===== EXPORT FOR COMPATIBILITY =====
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        createStarfield,
        createFloatingParticles,
        addSmoothScrolling,
        copyToClipboard,
        showNotification,
        goBack
    };
}
