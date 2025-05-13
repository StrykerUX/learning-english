// ===== STORAGE CHANGE DETECTION =====
window.addEventListener('storage', handleStorageChange);
window.addEventListener('focus', handleWindowFocus);
window.addEventListener('gameComplete', handleGameComplete);

function handleStorageChange(e) {
    // Reload game state when localStorage changes
    if (e.key && (e.key.startsWith('completed') || e.key.startsWith('level') || e.key.startsWith('total'))) {
        reloadGameState();
    }
}

function handleWindowFocus() {
    // Check for updates when window gains focus (returning from game)
    reloadGameState();
}

function handleGameComplete(e) {
    // Handle the custom game complete event
    const { levelId, score, stars } = e.detail;
    console.log(`Dashboard received game complete event: Level ${levelId}, Score: ${score}, Stars: ${stars}`);
    reloadGameState();
}

function reloadGameState() {
    // Create new gameState instance with updated localStorage data
    gameState = new GameState();
    
    // Update UI with fresh data
    updateUI();
    setupLevelNodes();
    positionPlayerShip();
    
    console.log('Game state reloaded:', {
        completedLevels: gameState.completedLevels,
        totalStars: gameState.totalStars,
        totalPoints: gameState.totalPoints,
        highestUnlocked: gameState.highestUnlocked
    });
}// ===== GAME STATE MANAGEMENT =====
class GameState {
    constructor() {
        this.playerName = localStorage.getItem('playerName') || '';
        this.totalPoints = parseInt(localStorage.getItem('totalPoints')) || 0;
        this.totalStars = parseInt(localStorage.getItem('totalStars')) || 0;
        this.completedLevels = JSON.parse(localStorage.getItem('completedLevels')) || {};
        this.levelStars = JSON.parse(localStorage.getItem('levelStars')) || {};
        this.levelBestScores = JSON.parse(localStorage.getItem('levelBestScores')) || {};
        this.highestUnlocked = parseInt(localStorage.getItem('highestUnlocked')) || 1;
    }

    save() {
        localStorage.setItem('playerName', this.playerName);
        localStorage.setItem('totalPoints', this.totalPoints.toString());
        localStorage.setItem('totalStars', this.totalStars.toString());
        localStorage.setItem('completedLevels', JSON.stringify(this.completedLevels));
        localStorage.setItem('levelStars', JSON.stringify(this.levelStars));
        localStorage.setItem('levelBestScores', JSON.stringify(this.levelBestScores));
        localStorage.setItem('highestUnlocked', this.highestUnlocked.toString());
    }

    completeLevel(level, score, stars) {
        this.completedLevels[level] = true;
        this.levelStars[level] = Math.max(this.levelStars[level] || 0, stars);
        this.levelBestScores[level] = Math.max(this.levelBestScores[level] || 0, score);
        this.totalPoints += score;
        this.totalStars = Object.values(this.levelStars).reduce((a, b) => a + b, 0);
        this.highestUnlocked = Math.max(this.highestUnlocked, level + 1);
        this.save();
    }

    isLevelUnlocked(level) {
        return level <= this.highestUnlocked;
    }

    isLevelCompleted(level) {
        return this.completedLevels[level] || false;
    }

    getLevelStars(level) {
        return this.levelStars[level] || 0;
    }

    getLevelBestScore(level) {
        return this.levelBestScores[level] || 0;
    }
}

// ===== LEVEL CONFIGURATION =====
const LEVELS_CONFIG = {
    1: {
        name: 'Basic Words',
        nameEs: 'Palabras Básicas',
        description: 'Learn essential English vocabulary with 40 basic words.',
        descriptionEs: 'Aprende vocabulario esencial del inglés con 40 palabras básicas.',
        icon: 'fas fa-book-open',
        gameFile: 'vocabulary-basic.php',
        theoryFile: 'basic-words.php'
    },
    2: {
        name: 'Memory Game',
        nameEs: 'Juego de Memoria',
        description: 'Match English words with their Spanish translations.',
        descriptionEs: 'Relaciona palabras en inglés con sus traducciones en español.',
        icon: 'fas fa-puzzle-piece',
        gameFile: 'memory-game.php',
        theoryFile: 'memory-tips.php'
    },
    3: {
        name: 'Hangman',
        nameEs: 'Ahorcado',
        description: 'Guess the word letter by letter in this classic game.',
        descriptionEs: 'Adivina la palabra letra por letra en este juego clásico.',
        icon: 'fas fa-spell-check',
        gameFile: 'hangman.php',
        theoryFile: 'spelling-tips.php'
    },
    4: {
        name: 'Present Simple',
        nameEs: 'Presente Simple',
        description: 'Master the present simple tense with interactive exercises.',
        descriptionEs: 'Domina el presente simple con ejercicios interactivos.',
        icon: 'fas fa-clock',
        gameFile: 'present-simple.php',
        theoryFile: 'present-simple.php'
    },
    5: {
        name: 'Present Continuous',
        nameEs: 'Presente Continuo',
        description: 'Learn about actions happening right now.',
        descriptionEs: 'Aprende sobre acciones que suceden ahora mismo.',
        icon: 'fas fa-running',
        gameFile: 'present-continuous.php',
        theoryFile: 'present-continuous.php'
    },
    6: {
        name: 'Past Simple',
        nameEs: 'Pasado Simple',
        description: 'Practice talking about past events and actions.',
        descriptionEs: 'Practica hablando sobre eventos y acciones del pasado.',
        icon: 'fas fa-history',
        gameFile: 'past-simple.php',
        theoryFile: 'past-simple.php'
    },
    7: {
        name: 'Future Simple',
        nameEs: 'Futuro Simple',
        description: 'Express future plans and predictions.',
        descriptionEs: 'Expresa planes futuros y predicciones.',
        icon: 'fas fa-rocket',
        gameFile: 'future-simple.php',
        theoryFile: 'future-simple.php'
    },
    8: {
        name: 'Prepositions',
        nameEs: 'Preposiciones',
        description: 'Learn where things are with prepositions of place.',
        descriptionEs: 'Aprende dónde están las cosas con preposiciones de lugar.',
        icon: 'fas fa-location-arrow',
        gameFile: 'prepositions.php',
        theoryFile: 'prepositions.php'
    }
};

// ===== GLOBAL STATE =====
let gameState = new GameState();
let isInitialized = false;
let currentSelectedLevel = null;

// ===== DOM ELEMENTS =====
const welcomeModal = document.getElementById('welcomeModal');
const playerNameInput = document.getElementById('playerName');
const playerNameDisplay = document.getElementById('playerNameDisplay');
const totalStarsDisplay = document.getElementById('totalStars');
const totalPointsDisplay = document.getElementById('totalPoints');
const levelPanel = document.getElementById('levelPanel');
const notification = document.getElementById('notification');
const playerShip = document.getElementById('playerShip');

// ===== INITIALIZATION =====
document.addEventListener('DOMContentLoaded', () => {
    createStarfield();
    createAsteroids();
    
    if (gameState.playerName) {
        welcomeModal.style.display = 'none';
        initializeDashboard();
    } else {
        welcomeModal.style.display = 'flex';
    }
});

// ===== STARFIELD ANIMATION =====
function createStarfield() {
    const starfield = document.getElementById('starfield');
    const numStars = 100;
    
    for (let i = 0; i < numStars; i++) {
        const star = document.createElement('div');
        star.className = `star ${Math.random() > 0.5 ? 'small' : Math.random() > 0.7 ? 'medium' : 'large'}`;
        star.style.left = Math.random() * 100 + '%';
        star.style.top = Math.random() * 100 + '%';
        star.style.setProperty('--duration', (Math.random() * 3 + 1) + 's');
        starfield.appendChild(star);
    }
}

// ===== FLOATING ASTEROIDS =====
function createAsteroids() {
    const asteroids = document.getElementById('asteroids');
    const asteroidIcons = ['fa-meteor', 'fa-star', 'fa-sun', 'fa-moon'];
    
    function createAsteroid() {
        const asteroid = document.createElement('div');
        asteroid.className = 'asteroid';
        asteroid.innerHTML = `<i class="fas ${asteroidIcons[Math.floor(Math.random() * asteroidIcons.length)]}"></i>`;
        asteroid.style.top = Math.random() * 100 + '%';
        asteroid.style.left = '-100px';
        asteroid.style.animationDuration = (Math.random() * 10 + 5) + 's';
        asteroid.style.animationDelay = Math.random() * 2 + 's';
        
        asteroids.appendChild(asteroid);
        
        setTimeout(() => {
            asteroid.remove();
        }, 15000);
    }
    
    // Create asteroid every 3-6 seconds
    setInterval(createAsteroid, Math.random() * 3000 + 3000);
}

// ===== WELCOME MODAL FUNCTIONS =====
function startJourney() {
    const playerName = playerNameInput.value.trim();
    
    if (!playerName) {
        showNotification('¡Por favor, ingresa tu nombre para comenzar!', 'warning');
        return;
    }
    
    if (playerName.length > 15) {
        showNotification('El nombre debe tener máximo 15 caracteres', 'warning');
        return;
    }
    
    gameState.playerName = playerName;
    gameState.save();
    
    welcomeModal.style.display = 'none';
    initializeDashboard();
    showNotification(`¡Bienvenido, ${playerName}! Tu aventura espacial comienza ahora 🚀`, 'success');
}

// Allow Enter key to start journey
playerNameInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        startJourney();
    }
});

// ===== DASHBOARD INITIALIZATION =====
function initializeDashboard() {
    if (isInitialized) return;
    
    console.log('Initializing dashboard...');
    console.log('Current gameState:', {
        completedLevels: gameState.completedLevels,
        totalStars: gameState.totalStars,
        totalPoints: gameState.totalPoints,
        highestUnlocked: gameState.highestUnlocked
    });
    
    updateUI();
    setupLevelNodes();
    positionPlayerShip();
    
    isInitialized = true;
    console.log('Dashboard initialized successfully');
}

// ===== UI UPDATES =====
function updateUI() {
    playerNameDisplay.textContent = gameState.playerName;
    totalStarsDisplay.textContent = gameState.totalStars;
    totalPointsDisplay.textContent = gameState.totalPoints;
}

// ===== LEVEL NODES SETUP =====
function setupLevelNodes() {
    const levelNodes = document.querySelectorAll('.level-node');
    
    levelNodes.forEach((node, index) => {
        const level = index + 1;
        const config = LEVELS_CONFIG[level];
        
        // Update node appearance based on state
        updateNodeState(node, level);
        
        // Update node label with bilingual text
        const nodeLabel = node.querySelector('.node-label');
        if (nodeLabel && config) {
            nodeLabel.innerHTML = `
                <div class="label-english">${config.name}</div>
                <div class="label-spanish">${config.nameEs}</div>
            `;
        }
        
        // Add click handler
        node.addEventListener('click', () => handleLevelClick(level));
        
        // Add keyboard navigation
        node.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                handleLevelClick(level);
            }
        });
        
        // Make focusable
        node.setAttribute('tabindex', '0');
    });
}

// ===== NODE STATE MANAGEMENT =====
function updateNodeState(node, level) {
    const isUnlocked = gameState.isLevelUnlocked(level);
    const isCompleted = gameState.isLevelCompleted(level);
    const stars = gameState.getLevelStars(level);
    
    // Reset classes
    node.classList.remove('unlocked', 'completed', 'locked');
    
    if (isCompleted) {
        node.classList.add('completed');
        // Update stars display
        const starElements = node.querySelectorAll('.node-stars i');
        starElements.forEach((star, index) => {
            if (index < stars) {
                star.classList.remove('far');
                star.classList.add('fas');
            }
        });
    } else if (isUnlocked) {
        node.classList.add('unlocked');
    } else {
        node.classList.add('locked');
    }
}

// ===== LEVEL CLICK HANDLER =====
function handleLevelClick(level) {
    if (!gameState.isLevelUnlocked(level)) {
        showNotification('¡Este nivel está bloqueado! Completa los niveles anteriores primero.', 'warning');
        return;
    }
    
    // Va directo a la teoría del nivel
    const config = LEVELS_CONFIG[level];
    window.location.href = `theory/${config.theoryFile}`;
}

// ===== LEVEL PANEL FUNCTIONS =====
// Removido porque ya no usamos el panel

// ===== NAVIGATION FUNCTIONS =====
// Removido porque ya no necesitamos estas funciones

// ===== PLAYER SHIP POSITIONING =====
function positionPlayerShip() {
    const currentLevel = gameState.highestUnlocked;
    const levelNodes = document.querySelectorAll('.level-node');
    
    if (levelNodes[currentLevel - 1]) {
        const targetNode = levelNodes[currentLevel - 1];
        const rect = targetNode.getBoundingClientRect();
        const containerRect = document.querySelector('.level-nodes').getBoundingClientRect();
        
        const x = rect.left - containerRect.left + rect.width / 2;
        const y = rect.top - containerRect.top + rect.height / 2;
        
        playerShip.style.left = x + 'px';
        playerShip.style.top = y + 'px';
    }
}

// ===== NOTIFICATION SYSTEM =====
function showNotification(message, type = 'info') {
    const notificationContent = notification.querySelector('.notification-content');
    const icon = notification.querySelector('.notification-icon');
    const text = notification.querySelector('.notification-text');
    
    // Reset classes
    notification.classList.remove('show');
    notification.className = 'notification';
    
    // Set icon based on type
    switch (type) {
        case 'success':
            notification.classList.add('success');
            icon.className = 'notification-icon fas fa-check-circle';
            break;
        case 'warning':
            notification.classList.add('warning');
            icon.className = 'notification-icon fas fa-exclamation-triangle';
            break;
        case 'error':
            notification.classList.add('error');
            icon.className = 'notification-icon fas fa-times-circle';
            break;
        default:
            notification.classList.add('info');
            icon.className = 'notification-icon fas fa-info-circle';
    }
    
    text.textContent = message;
    
    // Show notification
    setTimeout(() => {
        notification.classList.add('show');
    }, 100);
    
    // Hide after 4 seconds
    setTimeout(() => {
        notification.classList.remove('show');
    }, 4000);
}

// ===== GAME COMPLETION CALLBACK =====
window.onGameComplete = function(level, score, stars) {
    console.log(`Dashboard received onGameComplete: Level ${level}, Score: ${score}, Stars: ${stars}`);
    gameState.completeLevel(level, score, stars);
    updateUI();
    setupLevelNodes();
    positionPlayerShip();
    
    showNotification(`¡Nivel ${level} completado! ${stars} estrella${stars !== 1 ? 's' : ''} obtenida${stars !== 1 ? 's' : ''}! ✨`, 'success');
};

// ===== KEYBOARD NAVIGATION =====
document.addEventListener('keydown', (e) => {
    // Close panel with Escape
    if (e.key === 'Escape' && levelPanel.classList.contains('show')) {
        closeLevelPanel();
    }
    
    // Navigate levels with arrow keys
    if (!levelPanel.classList.contains('show')) {
        const levelNodes = document.querySelectorAll('.level-node');
        const focusedIndex = Array.from(levelNodes).findIndex(node => node === document.activeElement);
        
        if (focusedIndex !== -1) {
            let nextIndex = focusedIndex;
            
            switch (e.key) {
                case 'ArrowUp':
                case 'ArrowLeft':
                    nextIndex = Math.max(0, focusedIndex - 1);
                    break;
                case 'ArrowDown':
                case 'ArrowRight':
                    nextIndex = Math.min(levelNodes.length - 1, focusedIndex + 1);
                    break;
            }
            
            if (nextIndex !== focusedIndex) {
                e.preventDefault();
                levelNodes[nextIndex].focus();
            }
        }
    }
});

// ===== RESPONSIVE FUNCTIONS =====
window.addEventListener('resize', () => {
    if (isInitialized) {
        positionPlayerShip();
    }
});

// ===== DEBUGGING FUNCTIONS (Development only) =====
if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
    window.debugGame = {
        reset: () => {
            localStorage.clear();
            location.reload();
        },
        unlockAll: () => {
            gameState.highestUnlocked = 8;
            gameState.save();
            location.reload();
        },
        completeLevel: (level, score = 100, stars = 3) => {
            gameState.completeLevel(level, score, stars);
            updateUI();
            setupLevelNodes();
            positionPlayerShip();
        },
        showStorage: () => {
            console.log('LocalStorage contents:', {
                completedLevels: localStorage.getItem('completedLevels'),
                levelStars: localStorage.getItem('levelStars'),
                totalPoints: localStorage.getItem('totalPoints'),
                totalStars: localStorage.getItem('totalStars'),
                highestUnlocked: localStorage.getItem('highestUnlocked')
            });
        }
    };
    
    console.log('Debug functions available:');
    console.log('- debugGame.reset() - Reset all progress');
    console.log('- debugGame.unlockAll() - Unlock all levels');
    console.log('- debugGame.completeLevel(level, score, stars) - Complete a level');
    console.log('- debugGame.showStorage() - Show localStorage contents');
}
