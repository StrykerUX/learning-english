<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ahorcado - English Trainer</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .game-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: rgba(0, 0, 0, 0.8);
            border: 3px solid #0ff;
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }
        
        .hangman-display {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .hangman-art {
            font-family: 'Space Mono', monospace;
            font-size: 1.5rem;
            color: #0ff;
            white-space: pre-line;
            margin-bottom: 1rem;
        }
        
        .word-display {
            font-size: 3rem;
            letter-spacing: 10px;
            color: #ffd700;
            margin-bottom: 1rem;
        }
        
        .hint-display {
            color: #888;
            font-style: italic;
            margin-bottom: 2rem;
        }
        
        .alphabet-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 10px;
            margin-bottom: 2rem;
        }
        
        .letter-button {
            aspect-ratio: 1;
            background: #1a1a1a;
            border: 2px solid #333;
            border-radius: 10px;
            color: #fff;
            font-size: 1.5rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .letter-button:hover {
            border-color: #0ff;
            background: rgba(0, 255, 255, 0.1);
        }
        
        .letter-button.correct {
            background: #22c55e;
            border-color: #16a34a;
        }
        
        .letter-button.incorrect {
            background: #dc2626;
            border-color: #991b1b;
        }
        
        .letter-button:disabled {
            cursor: not-allowed;
            opacity: 0.6;
        }
        
        .game-stats {
            display: flex;
            justify-content: space-around;
            margin-bottom: 2rem;
        }
        
        .stat-item {
            text-align: center;
            background: #1a1a1a;
            padding: 1rem;
            border-radius: 10px;
            border: 2px solid #333;
        }
        
        .results-panel {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            background: rgba(0, 0, 0, 0.95);
            border: 3px solid #0ff;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            z-index: 1000;
            transition: transform 0.3s ease;
        }
        
        .results-panel.visible {
            transform: translate(-50%, -50%) scale(1);
        }
        
        .next-button {
            padding: 0.8rem 1.5rem;
            border: 2px solid #10b981;
            background: transparent;
            color: #10b981;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 1rem;
        }
        
        .next-button:hover {
            background: #10b981;
            color: #000;
        }
    </style>
</head>
<body>
    <div class="universe">
        <div class="stars-bg"></div>
        
        <div class="game-container">
            <button class="back-button control-button" onclick="goHome()">
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
            
            <div class="hangman-display">
                <div class="hangman-art" id="hangman-art"></div>
                <div class="word-display" id="word-display"></div>
                <div class="hint-display" id="hint-display"></div>
            </div>
            
            <div class="alphabet-grid" id="alphabet-grid">
                <!-- Alphabet buttons will be generated here -->
            </div>
            
            <div class="game-controls">
                <button class="next-button" id="next-button" onclick="nextWord()" style="display: none;">
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
                <button class="control-button" onclick="goHome()">
                    <i class="fas fa-home"></i> Menú Principal
                </button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

            updateDisplay();
            createAlphabet();
            $('#next-button').hide();
        }

        // Create alphabet buttons
        function createAlphabet() {
            const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            const grid = $('#alphabet-grid');
            grid.empty();

            for (let letter of alphabet) {
                const button = $(`<button class="letter-button" data-letter="${letter}">${letter}</button>`);
                button.click(() => guessLetter(letter));
                grid.append(button);
            }
        }

        // Guess a letter
        function guessLetter(letter) {
            if (guessedLetters.includes(letter) || gameOver) return;

            guessedLetters.push(letter);
            const button = $(`.letter-button[data-letter="${letter}"]`);
            button.prop('disabled', true);

            if (currentWord.includes(letter)) {
                // Correct guess
                correctGuesses.push(letter);
                button.addClass('correct');
                score += 10;

                // Check if word is complete
                if (currentWord.split('').every(l => correctGuesses.includes(l))) {
                    // Word completed!
                    wordsCompleted++;
                    score += 50; // Bonus for completing word
                    setTimeout(() => {
                        $('#next-button').show();
                    }, 1000);
                }
            } else {
                // Wrong guess
                wrongGuesses.push(letter);
                button.addClass('incorrect');
                score = Math.max(0, score - 5);

                // Check if game over for this word
                if (wrongGuesses.length >= 8) {
                    gameOver = true;
                    revealWord();
                    setTimeout(() => {
                        $('#next-button').show();
                    }, 1000);
                }
            }

            updateDisplay();
        }

        // Reveal word when game over
        function revealWord() {
            // Disable all buttons
            $('.letter-button').prop('disabled', true);
            
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
            $('#current-word').text(currentWordIndex + 1);
            $('#current-score').text(score);
            $('#wrong-guesses').text(wrongGuesses.length);

            // Update hangman art
            $('#hangman-art').text(hangmanStates[wrongGuesses.length]);

            // Update word display
            let displayWord = currentWord
                .split('')
                .map(letter => correctGuesses.includes(letter) ? letter : '_')
                .join(' ');
            $('#word-display').text(displayWord);

            // Update hint
            $('#hint-display').text(words[currentWordIndex].hint);
        }

        // End game
        function endGame() {
            // Calculate stars
            const percentage = (wordsCompleted / words.length) * 100;
            let stars = 1;
            if (percentage >= 60) stars = 2;
            if (percentage >= 80) stars = 3;

            // Final score bonus
            score += wordsCompleted * 25;

            // Update results
            $('#final-score').text(score);
            $('#words-completed').text(wordsCompleted);

            let starsHtml = '';
            for (let i = 0; i < 3; i++) {
                if (i < stars) {
                    starsHtml += '<i class="fas fa-star" style="color: #ffd700;"></i>';
                } else {
                    starsHtml += '<i class="far fa-star" style="color: #333;"></i>';
                }
            }
            $('#stars-display').html(starsHtml);

            // Show results panel
            $('#results-panel').addClass('visible');

            // Notify parent window about completion
            if (window.opener && window.opener.onGameComplete) {
                window.opener.onGameComplete(3, score, stars);
            }
        }

        // Restart game
        function restartGame() {
            $('#results-panel').removeClass('visible');
            initGame();
        }

        // Go to home
        function goHome() {
            window.location.href = '../index.html';
        }

        // Initialize game on load
        $(document).ready(() => {
            initGame();
        });

        // Keyboard support
        $(document).keydown(function(e) {
            const letter = String.fromCharCode(e.keyCode);
            if (letter >= 'A' && letter <= 'Z') {
                guessLetter(letter);
            }
        });
    </script>
</body>
</html>