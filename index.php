<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>English Trainer - Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1 class="header-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                    <circle cx="12" cy="12" r="11"></circle>
                    <path d="M9 12l2 2 4-4"></path>
                </svg>
                English Trainer
            </h1>
            <div class="user-stats">
                <div class="stat-card">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="12,2 15.09,8.26 22,9.27 17,14.14 18.18,21.02 12,17.77 5.82,21.02 7,14.14 2,9.27 8.91,8.26"></polygon>
                    </svg>
                    <span id="total-points">0</span> Puntos
                </div>
                <div class="stat-card">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v10z"></path>
                    </svg>
                    <span id="words-learned">0</span>/100 Palabras
                </div>
                <div class="stat-card">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 12l2 2 4-4"></path>
                        <circle cx="12" cy="12" r="11"></circle>
                    </svg>
                    <span id="completed-levels">0</span>/8 Completados
                </div>
            </div>
        </header>

        <main class="main">
            <!-- Vocabulary Games Category -->
            <section class="category-section">
                <h2 class="category-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v10z"></path>
                    </svg>
                    Juegos de Vocabulario
                </h2>
                <div class="games-grid">
                    <div class="game-card" data-category="vocabulary" data-game="1" data-status="unlocked">
                        <div class="game-header">
                            <div class="game-icon vocabulary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2v10z"></path>
                                </svg>
                            </div>
                            <div class="game-info">
                                <h3>Palabras Básicas</h3>
                                <p>20 palabras esenciales</p>
                            </div>
                            <div class="game-status">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="11"></circle>
                                    <path d="M9 12l2 2 4-4"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="game-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 0%"></div>
                            </div>
                            <span class="progress-text">0 palabras</span>
                        </div>
                    </div>

                    <div class="game-card" data-category="vocabulary" data-game="2" data-status="locked">
                        <div class="game-header">
                            <div class="game-icon memory">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                                    <line x1="8" y1="21" x2="16" y2="21"></line>
                                    <line x1="12" y1="17" x2="12" y2="21"></line>
                                </svg>
                            </div>
                            <div class="game-info">
                                <h3>Memorama</h3>
                                <p>Encuentra las parejas</p>
                            </div>
                            <div class="game-status">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="m7 11 5-5 5 5"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="game-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 0%"></div>
                            </div>
                            <span class="progress-text">0 palabras</span>
                        </div>
                    </div>

                    <div class="game-card" data-category="vocabulary" data-game="3" data-status="locked">
                        <div class="game-header">
                            <div class="game-icon hangman">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="9" cy="7" r="2"></circle>
                                    <path d="m9 9v6"></path>
                                    <path d="m9 15h-3"></path>
                                    <path d="m9 15h3"></path>
                                    <path d="M21 2v6h-6"></path>
                                </svg>
                            </div>
                            <div class="game-info">
                                <h3>Ahorcado</h3>
                                <p>Adivina la palabra</p>
                            </div>
                            <div class="game-status">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="m7 11 5-5 5 5"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="game-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 0%"></div>
                            </div>
                            <span class="progress-text">0 palabras</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Grammar Games Category -->
            <section class="category-section">
                <h2 class="category-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12,6 12,12 16,14"></polyline>
                    </svg>
                    Tiempos Verbales
                </h2>
                <div class="games-grid">
                    <div class="game-card" data-category="grammar" data-game="4" data-status="locked">
                        <div class="game-header">
                            <div class="game-icon present-simple">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12,6 12,12 16,14"></polyline>
                                </svg>
                            </div>
                            <div class="game-info">
                                <h3>Presente Simple</h3>
                                <p>Rutinas y hechos</p>
                            </div>
                            <div class="game-status">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="m7 11 5-5 5 5"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="game-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 0%"></div>
                            </div>
                            <span class="progress-text">0 completado</span>
                        </div>
                    </div>

                    <div class="game-card" data-category="grammar" data-game="5" data-status="locked">
                        <div class="game-header">
                            <div class="game-icon present-continuous">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="8,12 13,17 20,10"></polyline>
                                    <path d="M21 12c0 2-1 4-3 6s-4 3-6 3-4-1-6-3-3-4-3-6 1-4 3-6 4-3 6-3"></path>
                                </svg>
                            </div>
                            <div class="game-info">
                                <h3>Presente Continuo</h3>
                                <p>Acciones presentes</p>
                            </div>
                            <div class="game-status">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="m7 11 5-5 5 5"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="game-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 0%"></div>
                            </div>
                            <span class="progress-text">0 completado</span>
                        </div>
                    </div>

                    <div class="game-card" data-category="grammar" data-game="6" data-status="locked">
                        <div class="game-header">
                            <div class="game-icon past-simple">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 3v18h18"></path>
                                    <path d="M4 18l4-4 4 2 4-4 4 4"></path>
                                </svg>
                            </div>
                            <div class="game-info">
                                <h3>Pasado Simple</h3>
                                <p>Eventos pasados</p>
                            </div>
                            <div class="game-status">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="m7 11 5-5 5 5"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="game-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 0%"></div>
                            </div>
                            <span class="progress-text">0 completado</span>
                        </div>
                    </div>

                    <div class="game-card" data-category="grammar" data-game="7" data-status="locked">
                        <div class="game-header">
                            <div class="game-icon future-simple">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 7v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2z"></path>
                                    <line x1="8" y1="12" x2="16" y2="12"></line>
                                    <line x1="12" y1="8" x2="12" y2="16"></line>
                                </svg>
                            </div>
                            <div class="game-info">
                                <h3>Futuro Simple</h3>
                                <p>Planes y predicciones</p>
                            </div>
                            <div class="game-status">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="m7 11 5-5 5 5"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="game-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 0%"></div>
                            </div>
                            <span class="progress-text">0 completado</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Special Games Category -->
            <section class="category-section">
                <h2 class="category-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 14v6a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-6"></path>
                        <path d="M12 2v8"></path>
                        <path d="m7 10-4-4 4-4"></path>
                        <path d="m17 10 4-4-4-4"></path>
                    </svg>
                    Juegos Especiales
                </h2>
                <div class="games-grid">
                    <div class="game-card" data-category="special" data-game="8" data-status="locked">
                        <div class="game-header">
                            <div class="game-icon prepositions">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 14v6a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-6"></path>
                                    <path d="M12 2v8"></path>
                                    <path d="m7 10-4-4 4-4"></path>
                                    <path d="m17 10 4-4-4-4"></path>
                                </svg>
                            </div>
                            <div class="game-info">
                                <h3>Preposiciones</h3>
                                <p>Encuentra la posición</p>
                            </div>
                            <div class="game-status">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="m7 11 5-5 5 5"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="game-progress">
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 0%"></div>
                            </div>
                            <span class="progress-text">0 preposiciones</span>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- Modal for game access -->
    <div id="game-modal" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-title">¿Listo para empezar?</h3>
                <button class="modal-close" id="modal-close">×</button>
            </div>
            <div class="modal-body">
                <p id="modal-description">Estás a punto de empezar el juego.</p>
            </div>
            <div class="modal-footer">
                <button class="btn" id="modal-cancel">Cancelar</button>
                <button class="btn primary" id="modal-confirm">Empezar Juego</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>