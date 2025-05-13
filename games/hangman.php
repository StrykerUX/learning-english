<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ahorcado - English Trainer</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Hangman Game Specific Styles */
        .hangman-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2rem;
        }
        
        .gallows {
            background: white;
            border: 3px solid var(--text-dark);
            border-radius: var(--border-radius);
            padding: 2rem;
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        
        .hangman-svg {
            width: 200px;
            height: 250px;
        }
        
        .word-container {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin: 1rem 0;
        }
        
        .letter-slot {
            width: 40px;
            height: 50px;
            border-bottom: 3px solid var(--text-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: bold;
            color: var(--text-dark);
        }
        
        .category-hint {
            background: var(--secondary-color);
            padding: 0.75rem 1.5rem;
            border-radius: var(--border-radius-sm);
            border: 2px solid var(--text-dark);
            text-align: center;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .alphabet-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 0.75rem;
            max-width: 400px;
            margin: 0 auto;
        }
        
        .letter-btn {
            width: 50px;
            height: 50px;
            border: 2px solid var(--text-dark);
            border-radius: var(--border-radius-sm);
            background: white;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: bold;
            font-size: 1.2rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .letter-btn:hover:not(.used):not(.correct):not(.incorrect) {
            transform: translateY(-2px);
            box-shadow: 2px 2px 0px var(--shadow-dark);
            background: var(--primary-color);
        }
        
        .letter-btn.correct {
            background: var(--success-color);
            color: #2ECC71;
            cursor: not-allowed;
        }
        
        .letter-btn.incorrect {
            background: var(--accent-color);
            color: #E74C3C;
            cursor: not-allowed;
        }
        
        .letter-btn.used {
            opacity: 0.5;
            cursor: not-allowed;
        }
        
        .lives-container {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: var(--warning-color);
            border-radius: var(--border-radius-sm);
            border: 2px solid var(--text-dark);
        }
        
        .lives-text {
            font-weight: bold;
            font-size: 1.1rem;
        }
        
        .hearts {
            display: flex;
            gap: 0.25rem;
        }
        
        .heart {
            font-size: 1.5rem;
            color: #E74C3C;
            transition: all 0.3s ease;
        }
        
        .heart.lost {
            color: #ccc;
            opacity: 0.5;
        }
        
        @keyframes heartBeat {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
        
        .heart.warning {
            animation: heartBeat 1s infinite;
        }
        
        /* Mobile responsive */
        @media (max-width: 768px) {
            .alphabet-grid {
                grid-template-columns: repeat(4, 1fr);
                max-width: 300px;
            }
            
            .letter-btn {
                width: 45px;
                height: 45px;
            }
            
            .letter-slot {
                width: 35px;
                height: 45px;
                font-size: 1.5rem;
            }
            
            .hangman-svg {
                width: 150px;
                height: 200px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1 class="header-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                    <circle cx="9" cy="7" r="2"></circle>
                    <path d="m9 9v6"></path>
                    <path d="m9 15h-3"></path>
                    <path d="m9 15h3"></path>
                    <path d="M21 2v6h-6"></path>
                </svg>
                Ahorcado
            </h1>
            <div class="score-display">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                </svg>
                <span id="score">0</span> puntos | <span id="word-counter">1</span>/20
            </div>
        </header>

        <main class="main">
            <div class="game-container">
                <div class="hangman-container">
                    <div class="lives-container">
                        <span class="lives-text">Vidas:</span>
                        <div class="hearts" id="hearts-container">
                            <span class="heart">♥</span>
                            <span class="heart">♥</span>
                            <span class="heart">♥</span>
                            <span class="heart">♥</span>
                            <span class="heart">♥</span>
                            <span class="heart">♥</span>
                            <span class="heart">♥</span>
                            <span class="heart">♥</span>
                        </div>
                    </div>
                    
                    <div class="gallows">
                        <svg class="hangman-svg" id="hangman-svg" viewBox="0 0 200 250">
                            <!-- Base -->
                            <rect id="base" x="10" y="230" width="120" height="15" fill="var(--text-dark)" style="opacity: 0;"/>
                            <!-- Pole -->
                            <rect id="pole" x="70" y="15" width="10" height="215" fill="var(--text-dark)" style="opacity: 0;"/>
                            <!-- Top beam -->
                            <rect id="beam" x="70" y="15" width="80" height="10" fill="var(--text-dark)" style="opacity: 0;"/>
                            <!-- Noose -->
                            <rect id="noose" x="140" y="15" width="3" height="30" fill="var(--text-dark)" style="opacity: 0;"/>
                            <!-- Head -->
                            <circle id="head" cx="141" cy="60" r="15" fill="none" stroke="var(--text-dark)" stroke-width="3" style="opacity: 0;"/>
                            <!-- Body -->
                            <line id="body" x1="141" y1="75" x2="141" y2="150" stroke="var(--text-dark)" stroke-width="3" style="opacity: 0;"/>
                            <!-- Left arm -->
                            <line id="leftArm" x1="141" y1="95" x2="116" y2="120" stroke="var(--text-dark)" stroke-width="3" style="opacity: 0;"/>
                            <!-- Right arm -->
                            <line id="rightArm" x1="141" y1="95" x2="166" y2="120" stroke="var(--text-dark)" stroke-width="3" style="opacity: 0;"/>
                        </svg>
                    </div>
                    
                    <div class="category-hint" id="category-hint">
                        Categoría: Animales
                    </div>
                    
                    <div class="word-container" id="word-container">
                        <!-- Letter slots will be added here -->
                    </div>
                    
                    <div class="alphabet-grid" id="alphabet-grid">
                        <!-- Letter buttons will be added here -->
                    </div>
                </div>
                
                <div class="nav-buttons" style="display: none;" id="result-section">
                    <div class="btn" id="result-message" style="background: var(--secondary-color); cursor: default;"></div>
                    <button class="btn success" id="next-word">
                        Siguiente Palabra
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
            let currentWord = 0;
            let score = 0;
            let correctGuesses = 0;
            let incorrectGuesses = 0;
            let livesLeft = 8;
            let guessedLetters = [];
            let currentWordData = null;
            let wordsLearned = new Set();

            const words = [
                { word: 'CAT', category: 'Animales', hint: 'Mascota que dice "meow"' },
                { word: 'DOG', category: 'Animales', hint: 'Mejor amigo del hombre' },
                { word: 'BIRD', category: 'Animales', hint: 'Animal que vuela' },
                { word: 'FISH', category: 'Animales', hint: 'Nada en el agua' },
                { word: 'HORSE', category: 'Animales', hint: 'Cabalga y dice "neigh"' },
                { word: 'RED', category: 'Colores', hint: 'Color del fuego' },
                { word: 'BLUE', category: 'Colores', hint: 'Color del cielo' },
                { word: 'GREEN', category: 'Colores', hint: 'Color de las plantas' },
                { word: 'YELLOW', category: 'Colores', hint: 'Color del sol' },
                { word: 'BLACK', category: 'Colores', hint: 'Ausencia de color' },
                { word: 'WHITE', category: 'Colores', hint: 'Color de la nieve' },
                { word: 'ONE', category: 'Números', hint: 'El primer número' },
                { word: 'TWO', category: 'Números', hint: 'Un par' },
                { word: 'THREE', category: 'Números', hint: 'Después de dos' },
                { word: 'FOUR', category: 'Números', hint: 'Cuatro patas tiene una mesa' },
                { word: 'FIVE', category: 'Números', hint: 'Dedos en una mano' },
                { word: 'MOTHER', category: 'Familia', hint: 'Mamá en inglés' },
                { word: 'FATHER', category: 'Familia', hint: 'Papá en inglés' },
                { word: 'SISTER', category: 'Familia', hint: 'Hermana en inglés' },
                { word: 'BROTHER', category: 'Familia', hint: 'Hermano en inglés' }
            ];

            const hangmanParts = ['#base', '#pole', '#beam', '#noose', '#head', '#body', '#leftArm', '#rightArm'];

            function initializeGame() {
                // Create alphabet buttons
                const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                const alphabetGrid = $('#alphabet-grid');
                alphabetGrid.empty();
                
                for (let letter of alphabet) {
                    const btn = $(`<button class="letter-btn" data-letter="${letter}">${letter}</button>`);
                    alphabetGrid.append(btn);
                }
                
                loadNextWord();
            }

            function loadNextWord() {
                if (currentWord >= words.length) {
                    showFinalResults();
                    return;
                }
                
                currentWordData = words[currentWord];
                $('#word-counter').text(currentWord + 1);
                $('#category-hint').text(`Categoría: ${currentWordData.category}`);
                
                // Reset game state
                incorrectGuesses = 0;
                livesLeft = 8;
                guessedLetters = [];
                
                // Reset hangman drawing
                hangmanParts.forEach(part => {
                    $(part).css('opacity', '0');
                });
                
                // Reset alphabet buttons
                $('.letter-btn').removeClass('correct incorrect used');
                
                // Reset hearts
                $('.heart').removeClass('lost warning');
                
                // Create word slots
                createWordSlots();
                
                $('#result-section').hide();
            }

            function createWordSlots() {
                const wordContainer = $('#word-container');
                wordContainer.empty();
                
                for (let i = 0; i < currentWordData.word.length; i++) {
                    const slot = $('<div class="letter-slot"></div>');
                    wordContainer.append(slot);
                }
            }

            function updateWordDisplay() {
                const slots = $('.letter-slot');
                for (let i = 0; i < currentWordData.word.length; i++) {
                    const letter = currentWordData.word[i];
                    if (guessedLetters.includes(letter)) {
                        slots.eq(i).text(letter);
                    }
                }
            }

            function updateHangman() {
                if (incorrectGuesses > 0 && incorrectGuesses <= hangmanParts.length) {
                    $(hangmanParts[incorrectGuesses - 1]).css('opacity', '1');
                }
                
                // Update hearts
                const hearts = $('.heart');
                for (let i = 0; i < incorrectGuesses; i++) {
                    hearts.eq(i).addClass('lost');
                }
                
                // Warning animation on last heart
                if (livesLeft === 1) {
                    hearts.eq(hearts.length - 1).addClass('warning');
                }
            }

            function checkGameEnd() {
                // Check if word is complete
                const allLettersGuessed = currentWordData.word.split('').every(letter => guessedLetters.includes(letter));
                
                if (allLettersGuessed) {
                    // Word completed successfully
                    wordsLearned.add(currentWordData.word);
                    score += 20; // Bonus for completing word
                    $('#score').text(score);
                    englishTrainer.showNotification('¡Palabra completada! +20 puntos', 'success');
                    showWordComplete();
                } else if (incorrectGuesses >= 8) {
                    // Game over
                    showWordFailed();
                }
            }

            function showWordComplete() {
                $('#result-message').text(`¡Felicidades! La palabra era: ${currentWordData.word}`);
                $('#result-message').css('background', 'var(--success-color)');
                $('#next-word').text('Siguiente Palabra');
                $('#result-section').show();
            }

            function showWordFailed() {
                $('#result-message').text(`¡Ups! La palabra era: ${currentWordData.word}`);
                $('#result-message').css('background', 'var(--accent-color)');
                $('#next-word').text('Intentar Siguiente');
                $('#result-section').show();
            }

            function showFinalResults() {
                const percentage = (wordsLearned.size / words.length) * 100;
                
                // Update progress
                englishTrainer.updateGameProgress(3, {
                    wordsLearned: wordsLearned.size,
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
                            <p>Palabras completadas: ${wordsLearned.size}/${words.length}</p>
                            <p>Porcentaje de éxito: ${percentage.toFixed(1)}%</p>
                            ${percentage >= 70 ? '<p style="color: #2ECC71; font-weight: 600;">¡Has completado el juego!</p>' : '<p>Sigue practicando para mejorar tu puntuación.</p>'}
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
            $(document).on('click', '.letter-btn', function() {
                const letter = $(this).data('letter');
                const btn = $(this);
                
                if (btn.hasClass('used')) return;
                
                btn.addClass('used');
                guessedLetters.push(letter);
                
                if (currentWordData.word.includes(letter)) {
                    // Correct guess
                    btn.addClass('correct');
                    correctGuesses++;
                    score += 5;
                    $('#score').text(score);
                    updateWordDisplay();
                    englishTrainer.showNotification('¡Letra correcta! +5 puntos', 'success');
                } else {
                    // Incorrect guess
                    btn.addClass('incorrect');
                    incorrectGuesses++;
                    livesLeft--;
                    updateHangman();
                    englishTrainer.showNotification('Letra incorrecta', 'error');
                }
                
                checkGameEnd();
            });

            $('#next-word').click(function() {
                currentWord++;
                loadNextWord();
            });

            // Initialize game
            initializeGame();
        });
    </script>
</body>
</html>