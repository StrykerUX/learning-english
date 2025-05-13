<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memorama - English Trainer</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Memory Game Specific Styles */
        .memory-container {
            max-width: 600px;
            margin: 0 auto;
        }
        
        .memory-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            margin: 2rem 0;
            aspect-ratio: 1;
        }
        
        .memory-card {
            aspect-ratio: 1;
            background: white;
            border: 3px solid var(--text-dark);
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            transform-style: preserve-3d;
        }
        
        .memory-card:hover:not(.flipped):not(.matched) {
            transform: scale(1.05);
            box-shadow: 4px 4px 0px var(--shadow-dark);
        }
        
        .memory-card.flipped {
            background: var(--primary-color);
        }
        
        .memory-card.matched {
            background: var(--success-color);
            opacity: 0.8;
            cursor: not-allowed;
        }
        
        .memory-card.unmatched {
            background: var(--accent-color);
            animation: shake 0.5s ease;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        .card-content {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 0.5rem;
            text-align: center;
        }
        
        .card-back {
            background: var(--secondary-color);
            opacity: 1;
            transition: opacity 0.3s ease;
        }
        
        .card-back .icon {
            font-size: 2rem;
        }
        
        .card-front {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .memory-card.flipped .card-back {
            opacity: 0;
        }
        
        .memory-card.flipped .card-front {
            opacity: 1;
        }
        
        .word-english {
            font-size: 1.1rem;
            font-weight: bold;
            color: var(--text-dark);
            margin-bottom: 0.25rem;
        }
        
        .word-spanish {
            font-size: 0.9rem;
            color: var(--text-light);
            font-style: italic;
        }
        
        .memory-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .stat-item {
            background: white;
            padding: 1rem;
            border: 2px solid var(--text-dark);
            border-radius: var(--border-radius-sm);
            text-align: center;
            box-shadow: 2px 2px 0px var(--shadow-dark);
        }
        
        .stat-value {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--text-accent);
            display: block;
        }
        
        .stat-label {
            font-size: 0.9rem;
            color: var(--text-light);
        }
        
        .level-info {
            background: var(--warning-color);
            padding: 1rem;
            border-radius: var(--border-radius-sm);
            border: 2px solid var(--text-dark);
            text-align: center;
            margin-bottom: 1rem;
        }
        
        .round-indicator {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }
        
        .round-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #E0E6ED;
            border: 2px solid var(--text-dark);
            transition: all 0.3s ease;
        }
        
        .round-dot.completed {
            background: #2ECC71;
        }
        
        .round-dot.current {
            background: var(--text-accent);
            transform: scale(1.3);
        }
        
        /* Mobile responsive */
        @media (max-width: 768px) {
            .memory-grid {
                gap: 0.75rem;
            }
            
            .word-english {
                font-size: 0.95rem;
            }
            
            .word-spanish {
                font-size: 0.8rem;
            }
            
            .memory-stats {
                grid-template-columns: repeat(3, 1fr);
                gap: 0.75rem;
            }
            
            .stat-value {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1 class="header-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                    <line x1="8" y1="21" x2="16" y2="21"></line>
                    <line x1="12" y1="17" x2="12" y2="21"></line>
                </svg>
                Memorama
            </h1>
            <div class="score-display">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                </svg>
                <span id="score">0</span> puntos
            </div>
        </header>

        <main class="main">
            <div class="game-container">
                <div class="memory-container">
                    <div class="level-info">
                        <h3>Ronda <span id="current-round">1</span> de 3</h3>
                        <p>Encuentra las parejas de palabras en inglés y español</p>
                    </div>
                    
                    <div class="round-indicator" id="round-indicator">
                        <div class="round-dot current"></div>
                        <div class="round-dot"></div>
                        <div class="round-dot"></div>
                    </div>
                    
                    <div class="memory-stats">
                        <div class="stat-item">
                            <span class="stat-value" id="matches">0</span>
                            <span class="stat-label">Parejas</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value" id="attempts">0</span>
                            <span class="stat-label">Intentos</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value" id="accuracy">100</span>
                            <span class="stat-label">% Precisión</span>
                        </div>
                    </div>
                    
                    <div class="memory-grid" id="memory-grid">
                        <!-- Cards will be generated here -->
                    </div>
                </div>
                
                <div class="nav-buttons" style="display: none;" id="result-section">
                    <div class="btn" id="result-message" style="background: var(--secondary-color); cursor: default;"></div>
                    <button class="btn success" id="next-round">
                        Siguiente Ronda
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </main>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../js/main.js"></script>
    <script>
        $(document).ready(function() {
            let currentRound = 1;
            let score = 0;
            let matches = 0;
            let attempts = 0;
            let flippedCards = [];
            let matchedPairs = [];
            let wordsLearned = new Set();
            let isChecking = false;

            const wordSets = [
                // Round 1 - Basic vocabulary
                {
                    icon: '🌈',
                    words: [
                        { english: 'HOUSE', spanish: 'CASA' },
                        { english: 'CAR', spanish: 'CARRO' },
                        { english: 'BOOK', spanish: 'LIBRO' },
                        { english: 'WATER', spanish: 'AGUA' },
                        { english: 'FOOD', spanish: 'COMIDA' }
                    ]
                },
                // Round 2 - Animals & Nature
                {
                    icon: '🐾',
                    words: [
                        { english: 'TREE', spanish: 'ÁRBOL' },
                        { english: 'FLOWER', spanish: 'FLOR' },
                        { english: 'BIRD', spanish: 'PÁJARO' },
                        { english: 'FISH', spanish: 'PEZ' },
                        { english: 'SUN', spanish: 'SOL' }
                    ]
                },
                // Round 3 - Actions & Adjectives
                {
                    icon: '⚡',
                    words: [
                        { english: 'BIG', spanish: 'GRANDE' },
                        { english: 'SMALL', spanish: 'PEQUEÑO' },
                        { english: 'HAPPY', spanish: 'FELIZ' },
                        { english: 'SAD', spanish: 'TRISTE' },
                        { english: 'FAST', spanish: 'RÁPIDO' }
                    ]
                }
            ];

            function initializeRound() {
                const currentSet = wordSets[currentRound - 1];
                $('#current-round').text(currentRound);
                
                // Update round indicator
                updateRoundIndicator();
                
                // Reset stats
                matches = 0;
                attempts = 0;
                flippedCards = [];
                matchedPairs = [];
                
                updateStats();
                
                // Create cards
                createCards(currentSet);
                
                $('#result-section').hide();
            }

            function updateRoundIndicator() {
                $('.round-dot').each(function(index) {
                    $(this).removeClass('current completed');
                    if (index < currentRound - 1) {
                        $(this).addClass('completed');
                    } else if (index === currentRound - 1) {
                        $(this).addClass('current');
                    }
                });
            }

            function createCards(wordSet) {
                const grid = $('#memory-grid');
                grid.empty();
                
                // Create pairs array (English and Spanish cards)
                const cards = [];
                
                wordSet.words.forEach((pair, index) => {
                    // English card
                    cards.push({
                        id: `en-${index}`,
                        type: 'english',
                        word: pair.english,
                        translation: pair.spanish,
                        pairId: index
                    });
                    
                    // Spanish card
                    cards.push({
                        id: `es-${index}`,
                        type: 'spanish',
                        word: pair.spanish,
                        translation: pair.english,
                        pairId: index
                    });
                });
                
                // Shuffle cards
                shuffleArray(cards);
                
                // Create card elements
                cards.forEach(card => {
                    const cardElement = $(`
                        <div class="memory-card" data-id="${card.id}" data-pair="${card.pairId}">
                            <div class="card-content card-back">
                                <span class="icon">${wordSet.icon}</span>
                            </div>
                            <div class="card-content card-front">
                                <div class="word-${card.type}">
                                    ${card.word}
                                </div>
                                <div class="word-${card.type === 'english' ? 'spanish' : 'english'}">
                                    ${card.translation}
                                </div>
                            </div>
                        </div>
                    `);
                    grid.append(cardElement);
                });
            }

            function shuffleArray(array) {
                for (let i = array.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [array[i], array[j]] = [array[j], array[i]];
                }
            }

            function updateStats() {
                $('#matches').text(matches);
                $('#attempts').text(attempts);
                
                const accuracy = attempts > 0 ? Math.round((matches / attempts) * 100) : 100;
                $('#accuracy').text(accuracy);
            }

            function flipCard(card) {
                if (isChecking || card.hasClass('flipped') || card.hasClass('matched')) {
                    return;
                }
                
                card.addClass('flipped');
                flippedCards.push(card);
                
                if (flippedCards.length === 2) {
                    attempts++;
                    checkMatch();
                }
            }

            function checkMatch() {
                isChecking = true;
                const [card1, card2] = flippedCards;
                const pair1 = card1.data('pair');
                const pair2 = card2.data('pair');
                
                setTimeout(() => {
                    if (pair1 === pair2) {
                        // Match found
                        card1.addClass('matched');
                        card2.addClass('matched');
                        matchedPairs.push(pair1);
                        matches++;
                        score += 20;
                        
                        // Add words to learned set
                        const currentSet = wordSets[currentRound - 1];
                        const wordPair = currentSet.words[pair1];
                        wordsLearned.add(wordPair.english);
                        wordsLearned.add(wordPair.spanish);
                        
                        $('#score').text(score);
                        englishTrainer.showNotification('¡Pareja encontrada! +20 puntos', 'success');
                        
                        // Check if round is complete
                        if (matches === 5) {
                            completeRound();
                        }
                    } else {
                        // No match
                        card1.removeClass('flipped').addClass('unmatched');
                        card2.removeClass('flipped').addClass('unmatched');
                        
                        setTimeout(() => {
                            card1.removeClass('unmatched');
                            card2.removeClass('unmatched');
                        }, 500);
                        
                        englishTrainer.showNotification('No es pareja, intenta de nuevo', 'error');
                    }
                    
                    flippedCards = [];
                    isChecking = false;
                    updateStats();
                }, 1000);
            }

            function completeRound() {
                // Bonus for completing round
                const accuracy = Math.round((matches / attempts) * 100);
                let bonus = 0;
                
                if (accuracy >= 90) {
                    bonus = 50;
                } else if (accuracy >= 80) {
                    bonus = 30;
                } else if (accuracy >= 70) {
                    bonus = 20;
                }
                
                score += bonus;
                $('#score').text(score);
                
                // Show round complete message
                $('#result-message').text(`¡Ronda ${currentRound} completada! Precisión: ${accuracy}%` + (bonus > 0 ? ` +${bonus} puntos bonus` : ''));
                $('#result-message').css('background', 'var(--success-color)');
                
                if (currentRound < 3) {
                    $('#next-round').text('Siguiente Ronda');
                } else {
                    $('#next-round').text('Ver Resultados');
                }
                
                $('#result-section').show();
            }

            function nextRound() {
                if (currentRound < 3) {
                    currentRound++;
                    initializeRound();
                } else {
                    showFinalResults();
                }
            }

            function showFinalResults() {
                const totalWords = wordsLearned.size;
                const maxWords = 15; // 5 words per round × 3 rounds
                const percentage = (totalWords / maxWords) * 100;
                
                // Update progress
                englishTrainer.updateGameProgress(2, {
                    wordsLearned: totalWords,
                    score: score,
                    pointsGained: score
                });
                
                const resultsContainer = $('.game-container');
                resultsContainer.html(`
                    <div class="theory-container">
                        <div class="theory-content text-center">
                            <h2>¡Juego Completado!</h2>
                            <div class="score-display" style="font-size: 1.5rem; margin: 1rem 0;">
                                ${score} puntos
                            </div>
                            <p>Palabras aprendidas: ${totalWords}/${maxWords}</p>
                            <p>Porcentaje: ${percentage.toFixed(1)}%</p>
                            ${percentage >= 70 ? '<p style="color: #2ECC71; font-weight: 600;">¡Has completado el juego!</p>' : '<p>Sigue practicando para mejorar tu memoria.</p>'}
                        </div>
                    </div>
                    <div class="nav-buttons">
                        <a href="../index.php" class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 7v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2z"></path>
                                <line x1="8" y1="12" x2="16" y2="12"></line>
                            </svg>
                            Regresar al Dashboard
                        </a>
                        <button class="btn primary" onclick="location.reload()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 2v6h6"></path>
                                <path d="M21 22v-6h-6"></path>
                                <path d="M2 14a10 10 0 0 0 20 0"></path>
                                <path d="M22 10a10 10 0 0 0-20 0"></path>
                            </svg>
                            Jugar de Nuevo
                        </button>
                    </div>
                `);
            }

            // Event handlers
            $(document).on('click', '.memory-card', function() {
                flipCard($(this));
            });

            $('#next-round').click(function() {
                nextRound();
            });

            // Initialize game
            initializeRound();
        });
    </script>
</body>
</html>