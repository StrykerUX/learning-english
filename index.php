<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>English Trainer - Learning Adventure</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&family=Righteous:wght@400&display=swap">
</head>
<body>
    <div class="adventure-world">
        <!-- Animated Background -->
        <div class="world-bg">
            <div class="clouds cloud-1"></div>
            <div class="clouds cloud-2"></div>
            <div class="clouds cloud-3"></div>
            <div class="mountains mountain-1"></div>
            <div class="mountains mountain-2"></div>
        </div>
        
        <!-- Header -->
        <header class="adventure-header">
            <div class="header-content">
                <div class="app-logo">
                    <i class="fas fa-graduation-cap"></i>
                    <h1>English Adventure</h1>
                </div>
                <div class="stats-container">
                    <div class="stat-bubble stars">
                        <i class="fas fa-star"></i>
                        <span id="total-stars">0</span>
                    </div>
                    <div class="stat-bubble coins">
                        <i class="fas fa-coins"></i>
                        <span id="total-points">0</span>
                    </div>
                    <div class="stat-bubble achievements">
                        <i class="fas fa-trophy"></i>
                        <span id="total-achievements">0</span>/<span>8</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Game World Map -->
        <main class="world-map">
            <svg class="path-svg" width="100%" height="100%" viewBox="0 0 1200 700" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="pathPattern" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                        <circle cx="10" cy="10" r="8" fill="none" stroke="#8B5CF6" stroke-width="2" opacity="0.3"/>
                    </pattern>
                </defs>
                <path id="adventure-path" d="M 100 600 Q 200 500 300 450 Q 400 400 500 380 Q 600 360 700 400 Q 800 440 900 380 Q 1000 320 1100 280" 
                      stroke="url(#pathPattern)" 
                      stroke-width="40" 
                      fill="none" 
                      stroke-linecap="round"/>
            </svg>
            
            <!-- Level Nodes -->
            <div class="level-nodes">
                <!-- Level 1: Basic Words -->
                <div class="level-node level-1 unlocked" 
                     data-level="1" 
                     data-game="vocabulary-basic" 
                     data-required="none"
                     style="left: 6%; top: 80%;">
                    <div class="node-wrapper">
                        <div class="node-circle">
                            <div class="node-icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <div class="node-number">1</div>
                        </div>
                        <div class="node-label">Words</div>
                        <div class="node-progress">
                            <div class="progress-stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Level 2: Memory Game -->
                <div class="level-node level-2 locked" 
                     data-level="2" 
                     data-game="memory-game" 
                     data-required="1"
                     style="left: 20%; top: 65%;">
                    <div class="node-wrapper">
                        <div class="node-circle">
                            <div class="node-icon">
                                <i class="fas fa-puzzle-piece"></i>
                            </div>
                            <div class="node-number">2</div>
                        </div>
                        <div class="node-label">Memory</div>
                        <div class="node-progress">
                            <div class="progress-stars">
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Level 3: Hangman -->
                <div class="level-node level-3 locked" 
                     data-level="3" 
                     data-game="hangman" 
                     data-required="2"
                     style="left: 35%; top: 55%;">
                    <div class="node-wrapper">
                        <div class="node-circle">
                            <div class="node-icon">
                                <i class="fas fa-spell-check"></i>
                            </div>
                            <div class="node-number">3</div>
                        </div>
                        <div class="node-label">Spelling</div>
                        <div class="node-progress">
                            <div class="progress-stars">
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Level 4: Present Simple -->
                <div class="level-node level-4 locked" 
                     data-level="4" 
                     data-game="present-simple" 
                     data-required="3"
                     style="left: 50%; top: 52%;">
                    <div class="node-wrapper">
                        <div class="node-circle">
                            <div class="node-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="node-number">4</div>
                        </div>
                        <div class="node-label">Present</div>
                        <div class="node-progress">
                            <div class="progress-stars">
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Level 5: Present Continuous -->
                <div class="level-node level-5 locked" 
                     data-level="5" 
                     data-game="present-continuous" 
                     data-required="4"
                     style="left: 65%; top: 60%;">
                    <div class="node-wrapper">
                        <div class="node-circle">
                            <div class="node-icon">
                                <i class="fas fa-running"></i>
                            </div>
                            <div class="node-number">5</div>
                        </div>
                        <div class="node-label">Continuous</div>
                        <div class="node-progress">
                            <div class="progress-stars">
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Level 6: Past Simple -->
                <div class="level-node level-6 locked" 
                     data-level="6" 
                     data-game="past-simple" 
                     data-required="5"
                     style="left: 80%; top: 52%;">
                    <div class="node-wrapper">
                        <div class="node-circle">
                            <div class="node-icon">
                                <i class="fas fa-history"></i>
                            </div>
                            <div class="node-number">6</div>
                        </div>
                        <div class="node-label">Past</div>
                        <div class="node-progress">
                            <div class="progress-stars">
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Level 7: Future Simple -->
                <div class="level-node level-7 locked" 
                     data-level="7" 
                     data-game="future-simple" 
                     data-required="6"
                     style="left: 90%; top: 42%;">
                    <div class="node-wrapper">
                        <div class="node-circle">
                            <div class="node-icon">
                                <i class="fas fa-rocket"></i>
                            </div>
                            <div class="node-number">7</div>
                        </div>
                        <div class="node-label">Future</div>
                        <div class="node-progress">
                            <div class="progress-stars">
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Level 8: Prepositions -->
                <div class="level-node level-8 locked special-level" 
                     data-level="8" 
                     data-game="prepositions" 
                     data-required="7"
                     style="left: 95%; top: 25%;">
                    <div class="node-wrapper">
                        <div class="node-circle">
                            <div class="node-icon">
                                <i class="fas fa-location-arrow"></i>
                            </div>
                            <div class="node-number">8</div>
                        </div>
                        <div class="node-label">Positions</div>
                        <div class="node-progress">
                            <div class="progress-stars">
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Player Character -->
                <div class="player-character" id="player-character">
                    <div class="character-avatar">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                </div>
            </div>
        </main>

        <!-- Level Info Panel -->
        <div class="level-panel" id="level-panel">
            <div class="panel-header">
                <button class="close-btn" id="close-level-panel">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="panel-content">
                <div class="level-icon-big" id="panel-icon">
                    <i class="fas fa-book-open"></i>
                </div>
                <h2 class="level-title" id="panel-title">Level Name</h2>
                <p class="level-description" id="panel-description">Level description goes here</p>
                <div class="level-stats">
                    <div class="stat-item">
                        <span class="stat-label">Best Score</span>
                        <span class="stat-value" id="panel-best-score">0</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Stars</span>
                        <div class="stars-display" id="panel-stars">
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                    </div>
                </div>
                <div class="panel-actions">
                    <button class="action-btn theory-btn" id="theory-btn">
                        <i class="fas fa-book"></i>
                        Theory
                    </button>
                    <button class="action-btn play-btn" id="play-btn">
                        <i class="fas fa-play"></i>
                        Play
                    </button>
                </div>
            </div>
        </div>

        <!-- Notification -->
        <div class="notification" id="notification">
            <div class="notification-content">
                <i class="fas fa-info-circle"></i>
                <span id="notification-text">Notification text here</span>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>