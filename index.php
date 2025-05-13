<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>English Trainer - Adventure Map</title>
    <link rel="stylesheet" href="css/style_mario.css?v=1.1">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One:wght@400&display=swap" rel="stylesheet">
</head>
<body>
    <div class="game-world">
        <!-- Sky Background -->
        <div class="sky-background">
            <div class="clouds">
                <div class="cloud cloud-1"></div>
                <div class="cloud cloud-2"></div>
                <div class="cloud cloud-3"></div>
            </div>
        </div>
        
        <!-- Header Stats -->
        <header class="header-stats">
            <div class="logo">
                <img src="https://img.icons8.com/fluency/48/000000/graduation-cap.png" alt="Logo">
                <h1>English Adventure</h1>
            </div>
            <div class="stats">
                <div class="stat-item coins">
                    <img src="https://img.icons8.com/fluency/32/000000/star.png" alt="Star">
                    <span id="total-points">130</span>
                </div>
                <div class="stat-item words">
                    <img src="https://img.icons8.com/fluency/32/000000/chat.png" alt="Words">
                    <span id="words-learned">0/100</span>
                </div>
                <div class="stat-item levels">
                    <img src="https://img.icons8.com/fluency/32/000000/checkmark.png" alt="Completed">
                    <span id="completed-levels">2/8</span>
                </div>
            </div>
        </header>

        <!-- Game Map -->
        <div class="game-map">
            <!-- Path Line -->
            <svg class="path-svg" viewBox="0 0 1200 800" preserveAspectRatio="xMidYMid meet">
                <path d="M100,700 C300,700 400,600 600,600 C800,600 900,500 1100,400" 
                      class="game-path" stroke="#4A90E2" stroke-width="8" fill="none"/>
            </svg>

            <!-- Level Nodes -->
            <div class="level-node" data-level="1" data-status="completed" style="left: 8%; top: 75%;">
                <div class="node-container">
                    <div class="node-circle completed">
                        <img src="https://img.icons8.com/cute-clipart/64/000000/speech-bubble.png" alt="Words">
                        <div class="crown">👑</div>
                    </div>
                    <div class="level-popup">
                        <h3>Palabras Básicas</h3>
                        <p class="level-description">20 palabras esenciales</p>
                        <div class="progress-info">
                            <div class="stars">
                                <span class="star filled">⭐</span>
                                <span class="star filled">⭐</span>
                                <span class="star filled">⭐</span>
                            </div>
                            <div class="points">+50 puntos</div>
                        </div>
                        <button class="level-btn replay-btn">Jugar de Nuevo</button>
                    </div>
                </div>
            </div>

            <div class="level-node" data-level="2" data-status="completed" style="left: 25%; top: 68%;">
                <div class="node-container">
                    <div class="node-circle completed">
                        <img src="https://img.icons8.com/cute-clipart/64/000000/memory-game.png" alt="Memory">
                        <div class="crown">👑</div>
                    </div>
                    <div class="level-popup">
                        <h3>Memorama</h3>
                        <p class="level-description">Encuentra las parejas</p>
                        <div class="progress-info">
                            <div class="stars">
                                <span class="star filled">⭐</span>
                                <span class="star filled">⭐</span>
                                <span class="star">⭐</span>
                            </div>
                            <div class="points">+30 puntos</div>
                        </div>
                        <button class="level-btn replay-btn">Jugar de Nuevo</button>
                    </div>
                </div>
            </div>

            <div class="level-node" data-level="3" data-status="unlocked" style="left: 50%; top: 60%;">
                <div class="node-container">
                    <div class="node-circle unlocked">
                        <img src="https://img.icons8.com/cute-clipart/64/000000/hangman.png" alt="Hangman">
                    </div>
                    <div class="level-popup">
                        <h3>Ahorcado</h3>
                        <p class="level-description">Adivina la palabra</p>
                        <div class="progress-info">
                            <div class="difficulty">
                                <span class="difficulty-icon">⚡</span>
                                <span>Moderado</span>
                            </div>
                            <div class="estimated-points">+40 puntos posibles</div>
                        </div>
                        <button class="level-btn play-btn">¡Jugar!</button>
                    </div>
                </div>
            </div>

            <div class="level-node" data-level="4" data-status="locked" style="left: 70%; top: 52%;">
                <div class="node-container">
                    <div class="node-circle locked">
                        <img src="https://img.icons8.com/cute-clipart/64/000000/clock.png" alt="Present">
                        <div class="lock">🔒</div>
                    </div>
                    <div class="level-popup">
                        <h3>Presente Simple</h3>
                        <p class="level-description">Rutinas y hechos</p>
                        <div class="progress-info">
                            <div class="unlock-requirement">
                                <span>🔓 Completa nivel anterior</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="level-node" data-level="5" data-status="locked" style="left: 75%; top: 42%;">
                <div class="node-container">
                    <div class="node-circle locked">
                        <img src="https://img.icons8.com/cute-clipart/64/000000/running.png" alt="Continuous">
                        <div class="lock">🔒</div>
                    </div>
                    <div class="level-popup">
                        <h3>Presente Continuo</h3>
                        <p class="level-description">Acciones presentes</p>
                        <div class="progress-info">
                            <div class="unlock-requirement">
                                <span>🔓 Completa nivel anterior</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="level-node" data-level="6" data-status="locked" style="left: 85%; top: 35%;">
                <div class="node-container">
                    <div class="node-circle locked">
                        <img src="https://img.icons8.com/cute-clipart/64/000000/time-machine.png" alt="Past">
                        <div class="lock">🔒</div>
                    </div>
                    <div class="level-popup">
                        <h3>Pasado Simple</h3>
                        <p class="level-description">Eventos pasados</p>
                        <div class="progress-info">
                            <div class="unlock-requirement">
                                <span>🔓 Completa nivel anterior</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="level-node" data-level="7" data-status="locked" style="left: 90%; top: 25%;">
                <div class="node-container">
                    <div class="node-circle locked">
                        <img src="https://img.icons8.com/cute-clipart/64/000000/crystal-ball.png" alt="Future">
                        <div class="lock">🔒</div>
                    </div>
                    <div class="level-popup">
                        <h3>Futuro Simple</h3>
                        <p class="level-description">Planes y predicciones</p>
                        <div class="progress-info">
                            <div class="unlock-requirement">
                                <span>🔓 Completa nivel anterior</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="level-node" data-level="8" data-status="locked" style="left: 92%; top: 15%;">
                <div class="node-container">
                    <div class="node-circle locked">
                        <img src="https://img.icons8.com/cute-clipart/64/000000/geography.png" alt="Prepositions">
                        <div class="lock">🔒</div>
                    </div>
                    <div class="level-popup">
                        <h3>Preposiciones</h3>
                        <p class="level-description">Encuentra la posición</p>
                        <div class="progress-info">
                            <div class="unlock-requirement">
                                <span>🔓 Completa nivel anterior</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Character -->
            <div class="character" style="left: 45%; top: 55%;">
                <img src="https://img.icons8.com/cute-clipart/64/000000/graduation-cap.png" alt="Character">
            </div>
        </div>

        <!-- Progress Modal (for when a level is completed) -->
        <div id="progressModal" class="modal" style="display: none;">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>¡Nivel Completado!</h2>
                    <button class="modal-close" onclick="closeModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="celebration">
                        <div class="stars-celebration">⭐⭐⭐</div>
                        <h3 id="modalTitle">Palabras Básicas</h3>
                        <p id="modalDescription">¡Excelente trabajo!</p>
                        <div class="rewards">
                            <div class="reward-item">
                                <img src="https://img.icons8.com/fluency/48/000000/star.png" alt="Points">
                                <span id="earnedPoints">+50 puntos</span>
                            </div>
                            <div class="reward-item">
                                <img src="https://img.icons8.com/fluency/48/000000/trophy.png" alt="Achievement">
                                <span>¡Nuevo logro desbloqueado!</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn secondary" onclick="closeModal()">Continuar</button>
                    <button class="btn primary" onclick="playAgain()">Jugar de Nuevo</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/main_mario.js?v=1.1"></script>
</body>
</html>