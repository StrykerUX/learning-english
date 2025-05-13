// ===== SIMPLE TESTING MODE FOR USER "STRYKER" =====
// This module adds a simple floating button when the username is "Stryker"
// It completes the Basic Words level with 2 stars (70% score)

class SimpleTestingMode {
    constructor() {
        this.enabled = false;
        this.button = null;
        this.checkAndInit();
    }

    checkAndInit() {
        // Wait for page to load and localStorage to be available
        const checkUser = () => {
            const playerName = localStorage.getItem('playerName') || '';
            if (playerName.toLowerCase() === 'stryker') {
                this.enabled = true;
                this.createButton();
                console.log('🔧 Simple Testing mode enabled for user: Stryker');
            }
        };

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', checkUser);
        } else {
            checkUser();
        }
    }

    createButton() {
        this.button = document.createElement('div');
        this.button.className = 'simple-testing-button';
        this.button.innerHTML = `
            <i class="fas fa-magic"></i>
            <span class="testing-tooltip">Complete Basic Words</span>
        `;
        
        // Add styles
        const style = document.createElement('style');
        style.textContent = `
            .simple-testing-button {
                position: fixed;
                bottom: 30px;
                right: 30px;
                width: 60px;
                height: 60px;
                background: linear-gradient(135deg, #10b981, #047857);
                border-radius: 50%;
                box-shadow: 0 4px 20px rgba(16, 185, 129, 0.4);
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                z-index: 9999;
                transition: all 0.3s ease;
                animation: simplePulse 2s infinite ease-in-out;
            }
            
            .simple-testing-button:hover {
                transform: scale(1.1);
                box-shadow: 0 6px 25px rgba(16, 185, 129, 0.6);
            }
            
            .simple-testing-button i {
                color: white;
                font-size: 24px;
            }
            
            .testing-tooltip {
                position: absolute;
                bottom: 75px;
                right: 0;
                background: #333;
                color: white;
                padding: 8px 12px;
                border-radius: 6px;
                font-size: 12px;
                white-space: nowrap;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
                pointer-events: none;
            }
            
            .testing-tooltip::after {
                content: '';
                position: absolute;
                top: 100%;
                right: 20px;
                width: 0;
                height: 0;
                border-left: 5px solid transparent;
                border-right: 5px solid transparent;
                border-top: 5px solid #333;
            }
            
            .simple-testing-button:hover .testing-tooltip {
                opacity: 1;
                visibility: visible;
            }
            
            @keyframes simplePulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.05); }
                100% { transform: scale(1); }
            }
        `;
        
        document.head.appendChild(style);
        document.body.appendChild(this.button);
        
        // Add click handler
        this.button.addEventListener('click', () => this.completeBasicWords());
    }

    completeBasicWords() {
        // Check if already completed
        const completedLevels = JSON.parse(localStorage.getItem('completedLevels') || '{}');
        if (completedLevels['1']) {
            if (confirm('El nivel Basic Words ya está completado. ¿Quieres completarlo de nuevo?')) {
                this.markAsCompleted();
            }
        } else {
            if (confirm('¿Completar el nivel Basic Words con 2 estrellas (70% de aciertos)?')) {
                this.markAsCompleted();
            }
        }
    }

    markAsCompleted() {
        try {
            // Get current data
            let completedLevels = JSON.parse(localStorage.getItem('completedLevels') || '{}');
            let levelStars = JSON.parse(localStorage.getItem('levelStars') || '{}');
            let levelBestScores = JSON.parse(localStorage.getItem('levelBestScores') || '{}');
            let totalPoints = parseInt(localStorage.getItem('totalPoints') || '0');
            let totalStars = parseInt(localStorage.getItem('totalStars') || '0');
            let highestUnlocked = parseInt(localStorage.getItem('highestUnlocked') || '1');

            // Mark level 1 as completed with 2 stars
            const wasCompleted = completedLevels['1'];
            const oldStars = levelStars['1'] || 0;
            const oldScore = levelBestScores['1'] || 0;

            completedLevels['1'] = true;
            levelStars['1'] = 2; // 2 stars for 70% score
            levelBestScores['1'] = 70; // 70% score

            // Update totals only if not already counted
            if (!wasCompleted) {
                totalPoints += 70;
                totalStars += 2;
                highestUnlocked = Math.max(highestUnlocked, 2); // Unlock level 2
            } else {
                // If already completed, adjust totals
                totalPoints = totalPoints - oldScore + 70;
                totalStars = totalStars - oldStars + 2;
            }

            // Recalculate total stars from all levels
            totalStars = Object.values(levelStars).reduce((sum, stars) => sum + (parseInt(stars) || 0), 0);

            // Save to localStorage
            localStorage.setItem('completedLevels', JSON.stringify(completedLevels));
            localStorage.setItem('levelStars', JSON.stringify(levelStars));
            localStorage.setItem('levelBestScores', JSON.stringify(levelBestScores));
            localStorage.setItem('totalPoints', totalPoints.toString());
            localStorage.setItem('totalStars', totalStars.toString());
            localStorage.setItem('highestUnlocked', highestUnlocked.toString());

            // Show confirmation
            alert('✅ Basic Words completado con 2 estrellas! Recarga la página para ver los cambios.');

            // If we're on the main page, try to update the UI
            if (typeof window.gameState !== 'undefined') {
                setTimeout(() => {
                    location.reload();
                }, 500);
            }

        } catch (error) {
            console.error('Error completing level:', error);
            alert('❌ Error al completar el nivel. Inténtalo de nuevo.');
        }
    }
}

// Global variable
window.simpleTestingMode = null;

// Initialize when ready
function initSimpleTestingMode() {
    if (window.simpleTestingMode) return;
    window.simpleTestingMode = new SimpleTestingMode();
}

// Multiple init attempts
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSimpleTestingMode);
} else {
    initSimpleTestingMode();
}

// Fallback
setTimeout(initSimpleTestingMode, 500);
