<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>English Trainer - Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Space+Mono:wght@400;700&display=swap">
</head>
<body>
    <div class="universe">
        <div class="stars-bg"></div>
        <div class="floating-objects">
            <i class="fas fa-star star star-1"></i>
            <i class="fas fa-planet-mars planet planet-1"></i>
            <i class="fas fa-star star star-2"></i>
            <i class="fas fa-satellite satellite"></i>
            <i class="fas fa-star star star-3"></i>
        </div>
        
        <header class="main-header">
            <h1 class="game-title">English Trainer</h1>
            <div class="user-stats">
                <div class="stat">
                    <i class="fas fa-star"></i>
                    <span id="total-stars">0</span>
                </div>
                <div class="stat">
                    <i class="fas fa-rocket"></i>
                    <span id="total-points">0</span>
                </div>
            </div>
        </header>

        <main class="game-board">
            <div class="game-path">
                <!-- Vocabulario Levels -->
                <div class="level-node level-1" data-level="1" data-game="vocabulary-basic" data-required="none">
                    <div class="level-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div class="level-info">
                        <span class="level-number">1</span>
                        <span class="level-name">Palabras Básicas</span>
                    </div>
                </div>

                <div class="level-connector"></div>

                <div class="level-node level-2" data-level="2" data-game="memory-game" data-required="1">
                    <div class="level-icon">
                        <i class="fas fa-puzzle-piece"></i>
                    </div>
                    <div class="level-info">
                        <span class="level-number">2</span>
                        <span class="level-name">Memorama</span>
                    </div>
                </div>

                <div class="level-connector"></div>

                <div class="level-node level-3" data-level="3" data-game="hangman" data-required="2">
                    <div class="level-icon">
                        <i class="fas fa-spell-check"></i>
                    </div>
                    <div class="level-info">
                        <span class="level-number">3</span>
                        <span class="level-name">Ahorcado</span>
                    </div>
                </div>

                <div class="level-connector big-connector"></div>

                <!-- Grammar Levels -->
                <div class="level-node level-4" data-level="4" data-game="present-simple" data-required="3">
                    <div class="level-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="level-info">
                        <span class="level-number">4</span>
                        <span class="level-name">Presente Simple</span>
                    </div>
                </div>

                <div class="level-connector"></div>

                <div class="level-node level-5" data-level="5" data-game="present-continuous" data-required="4">
                    <div class="level-icon">
                        <i class="fas fa-running"></i>
                    </div>
                    <div class="level-info">
                        <span class="level-number">5</span>
                        <span class="level-name">Presente Continuo</span>
                    </div>
                </div>

                <div class="level-connector"></div>

                <div class="level-node level-6" data-level="6" data-game="past-simple" data-required="5">
                    <div class="level-icon">
                        <i class="fas fa-history"></i>
                    </div>
                    <div class="level-info">
                        <span class="level-number">6</span>
                        <span class="level-name">Pasado Simple</span>
                    </div>
                </div>

                <div class="level-connector"></div>

                <div class="level-node level-7" data-level="7" data-game="future-simple" data-required="6">
                    <div class="level-icon">
                        <i class="fas fa-forward"></i>
                    </div>
                    <div class="level-info">
                        <span class="level-number">7</span>
                        <span class="level-name">Futuro Simple</span>
                    </div>
                </div>

                <div class="level-connector"></div>

                <!-- Special Level -->
                <div class="level-node level-8" data-level="8" data-game="prepositions" data-required="7">
                    <div class="level-icon">
                        <i class="fas fa-location-arrow"></i>
                    </div>
                    <div class="level-info">
                        <span class="level-number">8</span>
                        <span class="level-name">Preposiciones</span>
                    </div>
                </div>

                <!-- Progress Ship -->
                <div class="progress-ship" id="progress-ship">
                    <i class="fas fa-rocket"></i>
                </div>
            </div>
        </main>

        <!-- Tooltips -->
        <div class="tooltip" id="level-tooltip"></div>

        <!-- Game Info Panel -->
        <div class="game-info-panel" id="game-info-panel">
            <div class="panel-content">
                <button class="close-panel" id="close-panel">
                    <i class="fas fa-times"></i>
                </button>
                <h3 class="panel-title"></h3>
                <p class="panel-description"></p>
                <div class="panel-stats">
                    <div class="stat-item">
                        <span class="stat-label">Mejor Puntuación:</span>
                        <span class="stat-value" id="panel-best-score">0</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Estrellas:</span>
                        <span class="stat-value" id="panel-stars">0</span>
                    </div>
                </div>
                <div class="panel-actions">
                    <button class="game-button theory-button" id="view-theory">
                        <i class="fas fa-book"></i>
                        Ver Teoría
                    </button>
                    <button class="game-button play-button" id="play-game">
                        <i class="fas fa-play"></i>
                        Jugar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>