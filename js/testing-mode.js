// ===== TESTING MODE FOR USER "STRYKER" =====
// This module adds a floating testing button when the username is "Stryker"
// It allows skipping lessons and marking them as completed with 100% score

class TestingMode {
    constructor() {
        this.enabled = false;
        this.button = null;
        this.panel = null;
        this.init();
    }

    init() {
        // Check if current user is "Stryker"
        const playerName = localStorage.getItem('playerName') || '';
        if (playerName.toLowerCase() === 'stryker') {
            this.enabled = true;
            this.createUI();
            console.log('🔧 Testing mode enabled for user: Stryker');
        }
    }

    createUI() {
        // Create floating button
        this.createFloatingButton();
        
        // Create control panel
        this.createControlPanel();
        
        // Add keyboard shortcut (Ctrl+T)
        this.addKeyboardShortcut();
    }

    createFloatingButton() {
        this.button = document.createElement('div');
        this.button.className = 'testing-floating-button';
        this.button.innerHTML = `
            <i class="fas fa-flask"></i>
            <span class="testing-tooltip">Testing Mode</span>
        `;
        
        // Add styles
        const style = document.createElement('style');
        style.textContent = `
            .testing-floating-button {
                position: fixed;
                bottom: 30px;
                right: 30px;
                width: 60px;
                height: 60px;
                background: linear-gradient(135deg, #ff6b6b, #ee5a52);
                border-radius: 50%;
                box-shadow: 0 4px 20px rgba(255, 107, 107, 0.4);
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                z-index: 9999;
                transition: all 0.3s ease;
                animation: testingPulse 2s infinite ease-in-out;
            }
            
            .testing-floating-button:hover {
                transform: scale(1.1);
                box-shadow: 0 6px 25px rgba(255, 107, 107, 0.6);
            }
            
            .testing-floating-button i {
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
            
            .testing-floating-button:hover .testing-tooltip {
                opacity: 1;
                visibility: visible;
            }
            
            @keyframes testingPulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.05); }
                100% { transform: scale(1); }
            }
        `;
        
        document.head.appendChild(style);
        document.body.appendChild(this.button);
        
        // Add click handler
        this.button.addEventListener('click', () => this.togglePanel());
    }

    createControlPanel() {
        this.panel = document.createElement('div');
        this.panel.className = 'testing-control-panel';
        this.panel.innerHTML = `
            <div class="testing-panel-header">
                <h3><i class="fas fa-flask"></i> Testing Mode</h3>
                <button class="testing-close-btn" onclick="testingMode.togglePanel()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="testing-panel-content">
                <div class="testing-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <p>Use this panel to quickly test lesson completion without doing the actual exercises.</p>
                </div>
                
                <div class="testing-controls">
                    <h4>Individual Level Controls</h4>
                    <div class="testing-level-grid" id="testingLevelGrid">
                        <!-- Levels will be generated here -->
                    </div>
                    
                    <h4>Bulk Actions</h4>
                    <div class="testing-bulk-actions">
                        <button class="testing-btn testing-btn-success" onclick="testingMode.completeAllLevels()">
                            <i class="fas fa-check-double"></i>
                            Complete All Levels
                        </button>
                        <button class="testing-btn testing-btn-warning" onclick="testingMode.resetAllProgress()">
                            <i class="fas fa-undo"></i>
                            Reset All Progress
                        </button>
                    </div>
                    
                    <h4>Quick Stats</h4>
                    <div class="testing-stats">
                        <div class="testing-stat-item">
                            <span>Total Stars:</span>
                            <span id="testingStatsStars">0</span>
                        </div>
                        <div class="testing-stat-item">
                            <span>Total Points:</span>
                            <span id="testingStatsPoints">0</span>
                        </div>
                        <div class="testing-stat-item">
                            <span>Completed Levels:</span>
                            <span id="testingStatsCompleted">0/8</span>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        // Add panel styles
        const panelStyle = document.createElement('style');
        panelStyle.textContent = `
            .testing-control-panel {
                position: fixed;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 500px;
                max-width: 90vw;
                max-height: 80vh;
                background: #2d3748;
                border-radius: 15px;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
                z-index: 10000;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
                overflow: hidden;
            }
            
            .testing-control-panel.show {
                opacity: 1;
                visibility: visible;
            }
            
            .testing-panel-header {
                background: #1a202c;
                padding: 15px 20px;
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            
            .testing-panel-header h3 {
                color: #ff6b6b;
                margin: 0;
                font-size: 18px;
            }
            
            .testing-close-btn {
                background: none;
                border: none;
                color: #a0aec0;
                font-size: 18px;
                cursor: pointer;
                padding: 5px;
                border-radius: 5px;
                transition: all 0.2s ease;
            }
            
            .testing-close-btn:hover {
                background: #4a5568;
                color: white;
            }
            
            .testing-panel-content {
                padding: 20px;
                color: #e2e8f0;
                max-height: calc(80vh - 70px);
                overflow-y: auto;
            }
            
            .testing-warning {
                background: #fed7d7;
                color: #c53030;
                padding: 12px;
                border-radius: 8px;
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 20px;
            }
            
            .testing-controls h4 {
                color: #81c784;
                margin: 20px 0 10px 0;
                font-size: 16px;
            }
            
            .testing-level-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
                gap: 10px;
                margin-bottom: 20px;
            }
            
            .testing-level-item {
                background: #4a5568;
                padding: 15px;
                border-radius: 8px;
                text-align: center;
            }
            
            .testing-level-item h5 {
                margin: 0 0 10px 0;
                color: #fff;
                font-size: 14px;
            }
            
            .testing-level-status {
                margin-bottom: 10px;
                font-size: 12px;
            }
            
            .testing-level-status.completed {
                color: #68d391;
            }
            
            .testing-level-status.incomplete {
                color: #fc8181;
            }
            
            .testing-bulk-actions {
                display: flex;
                gap: 10px;
                flex-wrap: wrap;
            }
            
            .testing-btn {
                padding: 10px 16px;
                border: none;
                border-radius: 6px;
                cursor: pointer;
                font-size: 14px;
                transition: all 0.2s ease;
                display: flex;
                align-items: center;
                gap: 8px;
            }
            
            .testing-btn-success {
                background: #68d391;
                color: #22543d;
            }
            
            .testing-btn-success:hover {
                background: #48bb78;
            }
            
            .testing-btn-warning {
                background: #fbd38d;
                color: #744210;
            }
            
            .testing-btn-warning:hover {
                background: #f6ad55;
            }
            
            .testing-btn-primary {
                background: #63b3ed;
                color: #2b6cb7;
            }
            
            .testing-btn-primary:hover {
                background: #4299e1;
            }
            
            .testing-stats {
                background: #4a5568;
                padding: 15px;
                border-radius: 8px;
            }
            
            .testing-stat-item {
                display: flex;
                justify-content: space-between;
                margin-bottom: 8px;
            }
            
            .testing-stat-item:last-child {
                margin-bottom: 0;
            }
            
            /* Overlay */
            .testing-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.7);
                z-index: 9999;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
            }
            
            .testing-overlay.show {
                opacity: 1;
                visibility: visible;
            }
        `;
        
        document.head.appendChild(panelStyle);
        document.body.appendChild(this.panel);
        
        // Create overlay
        this.overlay = document.createElement('div');
        this.overlay.className = 'testing-overlay';
        this.overlay.addEventListener('click', () => this.togglePanel());
        document.body.appendChild(this.overlay);
        
        // Generate level grid
        this.generateLevelGrid();
        this.updateStats();
    }

    generateLevelGrid() {
        const grid = document.getElementById('testingLevelGrid');
        if (!grid) return;
        
        grid.innerHTML = '';
        
        // Access gameState from global scope
        const gameState = window.gameState;
        
        for (let level = 1; level <= 8; level++) {
            const config = window.LEVELS_CONFIG[level];
            const isCompleted = gameState.isLevelCompleted(level);
            const stars = gameState.getLevelStars(level);
            
            const levelItem = document.createElement('div');
            levelItem.className = 'testing-level-item';
            levelItem.innerHTML = `
                <h5>${config.nameEs}</h5>
                <div class="testing-level-status ${isCompleted ? 'completed' : 'incomplete'}">
                    ${isCompleted ? `✅ Completado (${stars} estrellas)` : '❌ No completado'}
                </div>
                <button class="testing-btn testing-btn-primary" onclick="testingMode.completeLevel(${level})">
                    <i class="fas fa-check"></i>
                    Completar
                </button>
            `;
            
            grid.appendChild(levelItem);
        }
    }

    updateStats() {
        const gameState = window.gameState;
        
        document.getElementById('testingStatsStars').textContent = gameState.totalStars;
        document.getElementById('testingStatsPoints').textContent = gameState.totalPoints;
        
        const completedCount = Object.keys(gameState.completedLevels).length;
        document.getElementById('testingStatsCompleted').textContent = `${completedCount}/8`;
    }

    togglePanel() {
        if (this.panel.classList.contains('show')) {
            this.panel.classList.remove('show');
            this.overlay.classList.remove('show');
        } else {
            this.panel.classList.add('show');
            this.overlay.classList.add('show');
            this.updateStats();
            this.generateLevelGrid();
        }
    }

    completeLevel(level) {
        if (!confirm(`¿Completar el Nivel ${level} con 100% de aciertos?`)) {
            return;
        }
        
        const gameState = window.gameState;
        gameState.completeLevel(level, 100, 3); // 100 points, 3 stars
        
        // Update UI if functions are available
        if (typeof window.updateUI === 'function') {
            window.updateUI();
        }
        if (typeof window.setupLevelNodes === 'function') {
            window.setupLevelNodes();
        }
        if (typeof window.positionPlayerShip === 'function') {
            window.positionPlayerShip();
        }
        
        this.updateStats();
        this.generateLevelGrid();
        
        // Show notification if available
        if (typeof window.showNotification === 'function') {
            window.showNotification(`Nivel ${level} completado exitosamente!`, 'success');
        }
    }

    completeAllLevels() {
        if (!confirm('¿Completar TODOS los niveles con 100% de aciertos? Esta acción no se puede deshacer.')) {
            return;
        }
        
        const gameState = window.gameState;
        
        for (let level = 1; level <= 8; level++) {
            gameState.completeLevel(level, 100, 3);
        }
        
        // Update UI
        if (typeof window.updateUI === 'function') {
            window.updateUI();
        }
        if (typeof window.setupLevelNodes === 'function') {
            window.setupLevelNodes();
        }
        if (typeof window.positionPlayerShip === 'function') {
            window.positionPlayerShip();
        }
        
        this.updateStats();
        this.generateLevelGrid();
        
        if (typeof window.showNotification === 'function') {
            window.showNotification('¡Todos los niveles completados exitosamente!', 'success');
        }
    }

    resetAllProgress() {
        if (!confirm('¿Estás seguro de que quieres resetear TODO el progreso? Esta acción no se puede deshacer.')) {
            return;
        }
        
        // Clear all level-related localStorage
        localStorage.removeItem('completedLevels');
        localStorage.removeItem('levelStars');
        localStorage.removeItem('levelBestScores');
        localStorage.removeItem('totalStars');
        localStorage.removeItem('totalPoints');
        localStorage.setItem('highestUnlocked', '1');
        
        // Reload the page to reinitialize
        if (typeof window.showNotification === 'function') {
            window.showNotification('Progreso reseteado. Recargando página...', 'warning');
        }
        
        setTimeout(() => {
            location.reload();
        }, 1500);
    }

    addKeyboardShortcut() {
        document.addEventListener('keydown', (e) => {
            // Ctrl+T to toggle testing panel
            if (e.ctrlKey && e.key === 't') {
                e.preventDefault();
                this.togglePanel();
            }
        });
    }
}

// Initialize testing mode when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    // Add a small delay to ensure other scripts are loaded
    setTimeout(() => {
        window.testingMode = new TestingMode();
    }, 100);
});

// Make testingMode available globally for button actions
window.testingMode = null;
