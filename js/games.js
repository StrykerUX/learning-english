// ===== GAMES JAVASCRIPT =====
// Common functionality for all games

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
    const particleCount = 15;
    
    for (let i = 0; i < particleCount; i++) {
        createParticle(particles, particleSymbols);
    }
    
    // Create new particles periodically
    setInterval(() => {
        if (particles.children.length < particleCount) {
            createParticle(particles, particleSymbols);
        }
    }, 5000);
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

// ===== NOTIFICATION SYSTEM =====
function showNotification(message, type = 'info') {
    // Remove existing notifications
    const existingNotification = document.querySelector('.notification');
    if (existingNotification) {
        existingNotification.remove();
    }
    
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    
    // Get appropriate icon and color for type
    let icon = 'fas fa-info-circle';
    let bgColor = 'var(--blue-pastel)';
    
    switch(type) {
        case 'success':
            icon = 'fas fa-check-circle';
            bgColor = 'var(--green-pastel)';
            break;
        case 'error':
            icon = 'fas fa-times-circle';
            bgColor = 'rgba(220, 38, 38, 0.9)';
            break;
        case 'warning':
            icon = 'fas fa-exclamation-triangle';
            bgColor = 'var(--yellow-pastel)';
            break;
    }
    
    notification.innerHTML = `
        <div class="notification-content">
            <i class="${icon}"></i>
            <span>${message}</span>
        </div>
    `;
    
    // Add styles
    notification.style.cssText = `
        position: fixed;
        top: 80px;
        left: 50%;
        transform: translateX(-50%) translateY(-100px);
        background: ${bgColor};
        color: var(--bg-space);
        padding: var(--space-md) var(--space-lg);
        border-radius: var(--radius-soft);
        box-shadow: var(--shadow-soft);
        z-index: 2000;
        transition: all 0.5s ease;
        border: 3px solid var(--bg-space);
        font-weight: 600;
    `;
    
    notification.querySelector('.notification-content').style.cssText = `
        display: flex;
        align-items: center;
        gap: var(--space-sm);
    `;
    
    notification.querySelector('i').style.cssText = `
        font-size: var(--font-size-lg);
        color: var(--bg-space);
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.transform = 'translateX(-50%) translateY(0)';
    }, 100);
    
    setTimeout(() => {
        notification.style.transform = 'translateX(-50%) translateY(-100px)';
        setTimeout(() => {
            notification.remove();
        }, 500);
    }, 3000);
}

// ===== SOUND MANAGER =====
class SoundManager {
    constructor() {
        this.sounds = {};
        this.enabled = true;
        this.volume = 0.5;
    }
    
    loadSound(name, url) {
        this.sounds[name] = new Audio(url);
        this.sounds[name].volume = this.volume;
    }
    
    play(name) {
        if (this.enabled && this.sounds[name]) {
            this.sounds[name].currentTime = 0;
            this.sounds[name].play().catch(e => console.log('Audio play failed:', e));
        }
    }
    
    setVolume(volume) {
        this.volume = Math.max(0, Math.min(1, volume));
        Object.values(this.sounds).forEach(sound => {
            sound.volume = this.volume;
        });
    }
    
    toggle() {
        this.enabled = !this.enabled;
        return this.enabled;
    }
}

// Create global sound manager instance
const soundManager = new SoundManager();

// ===== GAME UTILITY FUNCTIONS =====
function shuffleArray(array) {
    const shuffled = [...array];
    for (let i = shuffled.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [shuffled[i], shuffled[j]] = [shuffled[j], shuffled[i]];
    }
    return shuffled;
}

function randomChoice(array) {
    return array[Math.floor(Math.random() * array.length)];
}

function formatTime(milliseconds) {
    const totalSeconds = Math.floor(milliseconds / 1000);
    const minutes = Math.floor(totalSeconds / 60);
    const seconds = totalSeconds % 60;
    return `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
}

function calculateScore(correct, incorrect, timeBonus = 0) {
    const baseScore = correct * 15 - incorrect * 5;
    return Math.max(0, baseScore + timeBonus);
}

function calculateStars(score, maxScore) {
    const percentage = (score / maxScore) * 100;
    if (percentage >= 90) return 3;
    if (percentage >= 70) return 2;
    return 1;
}

// ===== LEVEL COMPLETION HANDLER =====
function handleLevelCompletion(levelId, score, stars) {
    // Save progress to localStorage directly (compatible with dashboard.js)
    const gameState = {
        playerName: localStorage.getItem('playerName') || '',
        totalPoints: parseInt(localStorage.getItem('totalPoints')) || 0,
        totalStars: parseInt(localStorage.getItem('totalStars')) || 0,
        completedLevels: JSON.parse(localStorage.getItem('completedLevels')) || {},
        levelStars: JSON.parse(localStorage.getItem('levelStars')) || {},
        levelBestScores: JSON.parse(localStorage.getItem('levelBestScores')) || {},
        highestUnlocked: parseInt(localStorage.getItem('highestUnlocked')) || 1
    };
    
    // Update game state
    gameState.completedLevels[levelId] = true;
    gameState.levelStars[levelId] = Math.max(gameState.levelStars[levelId] || 0, stars);
    gameState.levelBestScores[levelId] = Math.max(gameState.levelBestScores[levelId] || 0, score);
    gameState.totalPoints += score;
    gameState.totalStars = Object.values(gameState.levelStars).reduce((a, b) => a + b, 0);
    gameState.highestUnlocked = Math.max(gameState.highestUnlocked, levelId + 1);
    
    // Save back to localStorage
    localStorage.setItem('playerName', gameState.playerName);
    localStorage.setItem('totalPoints', gameState.totalPoints.toString());
    localStorage.setItem('totalStars', gameState.totalStars.toString());
    localStorage.setItem('completedLevels', JSON.stringify(gameState.completedLevels));
    localStorage.setItem('levelStars', JSON.stringify(gameState.levelStars));
    localStorage.setItem('levelBestScores', JSON.stringify(gameState.levelBestScores));
    localStorage.setItem('highestUnlocked', gameState.highestUnlocked.toString());
    
    // Save old format as well for compatibility
    const gameStats = JSON.parse(localStorage.getItem('gameStats') || '{}');
    
    if (!gameStats[levelId] || gameStats[levelId].score < score) {
        gameStats[levelId] = {
            score: score,
            stars: stars,
            completed: true,
            completedAt: new Date().toISOString()
        };
        
        localStorage.setItem('gameStats', JSON.stringify(gameStats));
    }
    
    // Try to notify parent window (for iframe contexts)
    try {
        if (window.parent && window.parent !== window && window.parent.onGameComplete) {
            window.parent.onGameComplete(levelId, score, stars);
        }
    } catch (e) {
        console.log('Could not notify parent window:', e);
    }
    
    // Try to notify opener window (for popup contexts)
    try {
        if (window.opener && window.opener.onGameComplete) {
            window.opener.onGameComplete(levelId, score, stars);
        }
    } catch (e) {
        console.log('Could not notify opener window:', e);
    }
}

// ===== NAVIGATION FUNCTIONS =====
function goHome() {
    window.location.href = '../index.html';
}

function goToTheory(theortyPage) {
    window.location.href = `../theory/${theortyPage}`;
}

function goToMenu() {
    showNotification('Regresando al menú principal...', 'info');
    setTimeout(() => {
        window.location.href = '../index.html';
    }, 1000);
}

function continueToNextLevel(currentLevel) {
    // Check if all levels are completed
    if (currentLevel >= 8) {
        window.location.href = '../congratulations.html';
        return;
    }
    
    // Go to the next level's theory page
    const nextLevel = currentLevel + 1;
    const levelMap = {
        2: '../theory/memory-tips.php',
        3: '../theory/spelling-tips.php', 
        4: '../theory/present-simple.php',
        5: '../theory/present-continuous.php',
        6: '../theory/past-simple.php',
        7: '../theory/future-simple.php',
        8: '../theory/prepositions.php'
    };
    
    if (levelMap[nextLevel]) {
        showNotification(`Avanzando al nivel ${nextLevel}...`, 'success');
        setTimeout(() => {
            window.location.href = levelMap[nextLevel];
        }, 1000);
    } else {
        window.location.href = '../congratulations.html';
    }
}

// ===== RESPONSIVE HELPERS =====
function getScreenSize() {
    const width = window.innerWidth;
    if (width < 480) return 'mobile';
    if (width < 768) return 'tablet';
    return 'desktop';
}

function adaptGridCols(baseColumns) {
    const screenSize = getScreenSize();
    switch(screenSize) {
        case 'mobile': return Math.max(1, Math.floor(baseColumns / 2));
        case 'tablet': return Math.max(2, Math.floor(baseColumns * 0.75));
        default: return baseColumns;
    }
}

// ===== SMOOTH ANIMATIONS =====
function animateElement(element, animation, duration = 300) {
    element.style.transition = `all ${duration}ms ease`;
    element.style.transform = animation;
    
    setTimeout(() => {
        element.style.transition = '';
        element.style.transform = '';
    }, duration);
}

function pulseElement(element, color = 'var(--green-bright)') {
    const originalBgColor = element.style.backgroundColor;
    const originalBorderColor = element.style.borderColor;
    
    element.style.backgroundColor = color;
    element.style.borderColor = color;
    element.style.transform = 'scale(1.05)';
    element.style.transition = 'all 0.3s ease';
    
    setTimeout(() => {
        element.style.backgroundColor = originalBgColor;
        element.style.borderColor = originalBorderColor;
        element.style.transform = 'scale(1)';
        
        setTimeout(() => {
            element.style.transition = '';
        }, 300);
    }, 300);
}

// ===== LOADING SCREEN =====
function showLoadingScreen() {
    const loading = document.createElement('div');
    loading.id = 'loading-screen';
    loading.innerHTML = `
        <div class="loading-content">
            <div class="loading-spinner"></div>
            <p>Cargando...</p>
        </div>
    `;
    
    loading.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(26, 26, 46, 0.95);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
    `;
    
    loading.querySelector('.loading-content').style.cssText = `
        text-align: center;
        color: white;
    `;
    
    loading.querySelector('.loading-spinner').style.cssText = `
        width: 50px;
        height: 50px;
        border: 4px solid var(--purple-pastel);
        border-top: 4px solid var(--purple-bright);
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto var(--space-md);
    `;
    
    // Add spinning animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    `;
    document.head.appendChild(style);
    
    document.body.appendChild(loading);
    return loading;
}

function hideLoadingScreen() {
    const loading = document.getElementById('loading-screen');
    if (loading) {
        loading.style.opacity = '0';
        setTimeout(() => loading.remove(), 300);
    }
}

// ===== KEYBOARD SHORTCUTS =====
function setupKeyboardShortcuts() {
    document.addEventListener('keydown', (e) => {
        // ESC to go back/close modals
        if (e.key === 'Escape') {
            const modal = document.querySelector('.results-panel.visible');
            if (modal) {
                modal.classList.remove('visible');
            } else {
                goHome();
            }
        }
        
        // Space to restart game
        if (e.key === ' ' && e.target.tagName !== 'INPUT') {
            e.preventDefault();
            const restartBtn = document.querySelector('[onclick*="restart"]');
            if (restartBtn) restartBtn.click();
        }
    });
}

// ===== INITIALIZATION =====
document.addEventListener('DOMContentLoaded', function() {
    // Create visual effects
    createStarfield();
    createFloatingParticles();
    
    // Setup keyboard shortcuts
    setupKeyboardShortcuts();
    
    // Add loading animation
    document.body.style.opacity = '0';
    
    // Show page with animation after a brief delay
    setTimeout(() => {
        document.body.style.transition = 'opacity 0.5s ease';
        document.body.style.opacity = '1';
    }, 100);
});

// ===== WINDOW RESIZE HANDLER =====
window.addEventListener('resize', function() {
    // Regenerate starfield on large viewport changes
    const starfield = document.querySelector('.starfield');
    if (starfield && Math.abs(window.innerWidth - (window.lastWidth || 0)) > 100) {
        starfield.remove();
        createStarfield();
        window.lastWidth = window.innerWidth;
    }
});

// ===== EXPORT FOR COMPATIBILITY =====
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        createStarfield,
        createFloatingParticles,
        showNotification,
        SoundManager,
        shuffleArray,
        randomChoice,
        formatTime,
        calculateScore,
        calculateStars,
        handleLevelCompletion,
        goHome,
        goToMenu,
        continueToNextLevel,
        getScreenSize,
        adaptGridCols,
        animateElement,
        pulseElement,
        showLoadingScreen,
        hideLoadingScreen
    };
}
