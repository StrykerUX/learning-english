<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ahorcado - English Trainer</title>
    <link rel="stylesheet" href="../css/games.css">
    <link rel="stylesheet" href="../css/hangman.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="game-container">
        <button class="back-button" onclick="goHome()">
            <i class="fas fa-arrow-left"></i> Volver
        </button>
        
        <div class="game-header">
            <h1>Ahorcado</h1>
            <p>Adivina la palabra en inglés letra por letra</p>
        </div>
        
        <div class="game-stats">
            <div class="stat-item">
                <div class="score-label">Palabra</div>
                <div class="score-value" id="current-word">1</div>
            </div>
            <div class="stat-item">
                <div class="score-label">Puntos</div>
                <div class="score-value" id="current-score">0</div>
            </div>
            <div class="stat-item">
                <div class="score-label">Errores</div>
                <div class="score-value" id="wrong-guesses">0</div>
            </div>
        </div>
        
        <div class="hangman-progress" id="hangman-progress">
            <div class="progress-step"></div>
            <div class="progress-step"></div>
            <div class="progress-step"></div>
            <div class="progress-step"></div>
            <div class="progress-step"></div>
            <div class="progress-step"></div>
            <div class="progress-step"></div>
            <div class="progress-step"></div>
        </div>
        
        <div class="hangman-art" id="hangman-art"></div>
        
        <div class="word-display">
            <div class="word-letters" id="word-letters"></div>
            <div class="hint-display" id="hint-display"></div>
        </div>
        
        <div class="alphabet-grid" id="alphabet-grid">
            <!-- Alphabet buttons will be generated here -->
        </div>
        
        <div class="game-controls">
            <button class="next-button control-button" id="next-button" onclick="nextWord()" style="display: none;">
                Siguiente Palabra <i class="fas fa-arrow-right"></i>
            </button>
        </div>
    </div>
    
    <div class="results-panel" id="results-panel">
        <h2 id="result-title">¡Juego Completado!</h2>
        <div class="stars-display" id="stars-display"></div>
        <p>Puntuación Final: <span id="final-score"></span></p>
        <p>Palabras Completadas: <span id="words-completed"></span>/10</p>
        <div class="game-controls">
            <button class="control-button" onclick="restartGame()">
                <i class="fas fa-redo"></i> Jugar de Nuevo
            </button>
            <button class="control-button" onclick="continueToNextLevel(3)">
                <i class="fas fa-arrow-right"></i> Siguiente Nivel
            </button>
        </div>
    </div>

    <script src="../js/games.js"></script>
    <script>
        // Game data
        const words = [
            { word: 'HELLO', hint: 'Saludo común en inglés' },
            { word: 'WORLD', hint: 'El planeta donde vivimos' },
            { word: 'FRIEND', hint: 'Persona querida y cercana' },
            { word: 'FAMILY', hint: 'Grupo de personas emparentadas' },
            { word: 'SCHOOL', hint: 'Lugar donde se estudia' },
            { word: 'WATER', hint: 'Líquido esencial para la vida' },
            { word: 'HAPPY', hint: 'Sentimiento de alegría' },
            { word: 'HOUSE', hint: 'Lugar donde vives' },
            { word: 'MUSIC', hint: 'Arte de combinar sonidos' },
            { word: 'SMILE', hint: 'Expresión facial de felicidad' }
        ];

        // Hangman art states
        const hangmanStates = [
            '',
            '   +---+\n       |\n       |\n       |\n       |\n       |\n=========',
            '   +---+\n   |   |\n       |\n       |\n       |\n       |\n=========',
            '   +---+\n   |   |\n   O   |\n       |\n       |\n       |\n=========',
            '   +---+\n   |   |\n   O   |\n   |   |\n       |\n       |\n=========',
            '   +---+\n   |   |\n   O   |\n  /|   |\n       |\n       |\n=========',
            '   +---+\n   |   |\n   O   |\n  /|\\  |\n       |\n       |\n=========',
            '   +---+\n   |   |\n   O   |\n  /|\\  |\n  /    |\n       |\n=========',
            '   +---+\n   |   |\n   O   |\n  /|\\  |\n  / \\  |\n       |\n========='
        ];

        // Game state
        let currentWordIndex = 0;
        let currentWord = '';
        let guessedLetters = [];
        let correctGuesses = [];
        let wrongGuesses = [];
        let score = 0;
        let wordsCompleted = 0;
        let gameOver = false;

        // Initialize game
        function initGame() {
            currentWordIndex = 0;
            score = 0;
            wordsCompleted = 0;
            startNewWord();
        }

        // Start new word
        function startNewWord() {
            if (currentWordIndex >= words.length) {
                endGame();
                return;
            }

            currentWord = words[currentWordIndex].word;
            guessedLetters = [];
            correctGuesses = [];
            wrongGuesses = [];
            gameOver = false;

            document.getElementById('game-container')?.classList.remove('game-over', 'word-complete');

            updateDisplay();
            createAlphabet();
            document.getElementById('next-button').style.display = 'none';
        }

        // Create alphabet buttons
        function createAlphabet() {
            const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            const grid = document.getElementById('alphabet-grid');
            grid.innerHTML = '';

            for (let letter of alphabet) {
                const button = document.createElement('button');
                button.className = 'letter-button';
                button.textContent = letter;
                button.dataset.letter = letter;
                button.onclick = () => guessLetter(letter);
                grid.appendChild(button);
            }
        }

        // Guess a letter
        function guessLetter(letter) {
            if (guessedLetters.includes(letter) || gameOver) return;

            guessedLetters.push(letter);
            const button = document.querySelector(`.letter-button[data-letter="${letter}"]`);
            button.disabled = true;

            if (currentWord.includes(letter)) {
                // Correct guess
                correctGuesses.push(letter);
                button.classList.add('correct');
                pulseElement(button, 'var(--green-bright)');
                score += 10;

                showNotification('¡Correcto!', 'success');

                // Check if word is complete
                if (currentWord.split('').every(l => correctGuesses.includes(l))) {
                    // Word completed!
                    wordsCompleted++;
                    score += 50; // Bonus for completing word
                    document.querySelector('.game-container').classList.add('word-complete');
                    showNotification('¡Palabra completada!', 'success');
                    
                    setTimeout(() => {
                        document.getElementById('next-button').style.display = 'inline-flex';
                    }, 1000);
                }
            } else {
                // Wrong guess
                wrongGuesses.push(letter);
                button.classList.add('incorrect');
                animateElement(button, 'translateX(-10px)');
                score = Math.max(0, score - 5);

                showNotification('Letra incorrecta', 'warning');

                // Check if game over for this word
                if (wrongGuesses.length >= 8) {
                    gameOver = true;
                    document.querySelector('.game-container').classList.add('game-over');
                    revealWord();
                    showNotification('¡Palabra no completada!', 'error');
                    
                    setTimeout(() => {
                        document.getElementById('next-button').style.display = 'inline-flex';
                    }, 1000);
                }
            }

            updateDisplay();
        }

        // Reveal word when game over
        function revealWord() {
            // Disable all buttons
            document.querySelectorAll('.letter-button').forEach(button => {
                button.disabled = true;
            });
            
            // Mark all letters as revealed
            currentWord.split('').forEach(letter => {
                if (!correctGuesses.includes(letter)) {
                    correctGuesses.push(letter);
                }
            });
        }

        // Next word
        function nextWord() {
            currentWordIndex++;
            startNewWord();
        }

        // Update display
        function updateDisplay() {
            // Update stats
            document.getElementById('current-word').textContent = currentWordIndex + 1;
            document.getElementById('current-score').textContent = score;
            document.getElementById('wrong-guesses').textContent = wrongGuesses.length;

            // Update hangman art
            document.getElementById('hangman-art').textContent = hangmanStates[wrongGuesses.length];

            // Update progress steps
            document.querySelectorAll('.progress-step').forEach((step, index) => {
                if (index < wrongGuesses.length) {
                    step.classList.add('danger');
                } else {
                    step.classList.remove('danger');
                }
            });

            // Update word display
            let displayWord = currentWord
                .split('')
                .map(letter => correctGuesses.includes(letter) ? letter : '_')
                .join(' ');
            document.getElementById('word-letters').textContent = displayWord;

            // Update hint
            document.getElementById('hint-display').textContent = words[currentWordIndex].hint;
        }

        // End game
        function endGame() {
            // Calculate stars
            const percentage = (wordsCompleted / words.length) * 100;
            let stars = calculateStars(score, words.length * 60);

            // Final score bonus
            score += wordsCompleted * 25;

            // Update results
            document.getElementById('final-score').textContent = score;
            document.getElementById('words-completed').textContent = wordsCompleted;

            let starsHtml = '';
            for (let i = 0; i < 3; i++) {
                if (i < stars) {
                    starsHtml += '<i class="fas fa-star" style="color: #ffd700;"></i>';
                } else {
                    starsHtml += '<i class="far fa-star" style="color: rgba(255, 255, 255, 0.3);"></i>';
                }
            }
            document.getElementById('stars-display').innerHTML = starsHtml;

            // Show results panel
            document.getElementById('results-panel').classList.add('visible');

            // Handle level completion
            handleLevelCompletion(3, score, stars);

            showNotification('¡Juego completado!', 'success');
        }

        // Restart game
        function restartGame() {
            document.getElementById('results-panel').classList.remove('visible');
            initGame();
        }

        // Keyboard support
        document.addEventListener('keydown', function(e) {
            if (!gameOver) {
                const letter = e.key.toUpperCase();
                if (letter >= 'A' && letter <= 'Z') {
                    guessLetter(letter);
                }
            }
        });

        // Initialize game on load
        document.addEventListener('DOMContentLoaded', () => {
            initGame();
        });
    </script>
</body>
</html>