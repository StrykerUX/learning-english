<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palabras Básicas - English Trainer</title>
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
        
        .game-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .score-display {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2rem;
            gap: 1rem;
        }
        
        .score-item {
            background: #1a1a1a;
            padding: 1rem;
            border-radius: 10px;
            border: 2px solid #333;
            text-align: center;
            flex: 1;
        }
        
        .word-display {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .english-word {
            font-size: 3rem;
            color: #0ff;
            margin-bottom: 1rem;
        }
        
        .pronunciation {
            font-size: 1.2rem;
            color: #888;
            font-style: italic;
            margin-bottom: 1rem;
        }
        
        .options-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .option-button {
            padding: 1rem;
            background: #1a1a1a;
            border: 2px solid #333;
            border-radius: 10px;
            color: #fff;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .option-button:hover {
            border-color: #0ff;
            background: rgba(0, 255, 255, 0.1);
        }
        
        .option-button.correct {
            background: #22c55e;
            border-color: #16a34a;
        }
        
        .option-button.incorrect {
            background: #dc2626;
            border-color: #991b1b;
        }
        
        .game-controls {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }
        
        .control-button {
            padding: 0.8rem 1.5rem;
            border: 2px solid #0ff;
            background: transparent;
            color: #0ff;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .control-button:hover {
            background: #0ff;
            color: #000;
        }
        
        .progress-bar {
            width: 100%;
            height: 20px;
            background: #1a1a1a;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 2rem;
            border: 2px solid #333;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #0ff, #0aa);
            transition: width 0.3s ease;
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
        
        .stars-display {
            font-size: 3rem;
            margin: 1rem 0;
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
                <h1>Palabras Básicas</h1>
                <p>Aprende las 20 palabras más esenciales del inglés</p>
            </div>
            
            <div class="progress-bar">
                <div class="progress-fill" id="progress-fill"></div>
            </div>
            
            <div class="score-display">
                <div class="score-item">
                    <div class="score-label">Puntos</div>
                    <div class="score-value" id="current-score">0</div>
                </div>
                <div class="score-item">
                    <div class="score-label">Palabra</div>
                    <div class="score-value" id="current-word">1</div>
                </div>
                <div class="score-item">
                    <div class="score-label">Correctas</div>
                    <div class="score-value" id="correct-answers">0</div>
                </div>
            </div>
            
            <div class="word-display">
                <div class="english-word" id="english-word"></div>
                <div class="pronunciation" id="pronunciation"></div>
            </div>
            
            <div class="options-grid" id="options-grid">
                <!-- Options will be generated here -->
            </div>
            
            <div class="game-controls">
                <button class="control-button" id="next-button" onclick="nextWord()" style="display: none;">
                    Siguiente <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
        
        <div class="results-panel" id="results-panel">
            <h2>¡Juego Completado!</h2>
            <div class="stars-display" id="stars-display"></div>
            <p>Puntuación Final: <span id="final-score"></span></p>
            <p>Palabras Correctas: <span id="final-correct"></span>/20</p>
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
        const vocabulary = [
            { english: 'Hello', spanish: 'Hola', pronunciation: '/həˈloʊ/' },
            { english: 'Goodbye', spanish: 'Adiós', pronunciation: '/ɡʊdˈbaɪ/' },
            { english: 'Please', spanish: 'Por favor', pronunciation: '/pliːz/' },
            { english: 'Thank you', spanish: 'Gracias', pronunciation: '/θæŋk juː/' },
            { english: 'Yes', spanish: 'Sí', pronunciation: '/jɛs/' },
            { english: 'No', spanish: 'No', pronunciation: '/noʊ/' },
            { english: 'Water', spanish: 'Agua', pronunciation: '/ˈwɔːtər/' },
            { english: 'Food', spanish: 'Comida', pronunciation: '/fuːd/' },
            { english: 'House', spanish: 'Casa', pronunciation: '/haʊs/' },
            { english: 'Friend', spanish: 'Amigo', pronunciation: '/frɛnd/' },
            { english: 'Family', spanish: 'Familia', pronunciation: '/ˈfæməli/' },
            { english: 'Love', spanish: 'Amor', pronunciation: '/lʌv/' },
            { english: 'Time', spanish: 'Tiempo', pronunciation: '/taɪm/' },
            { english: 'Person', spanish: 'Persona', pronunciation: '/ˈpɜːrsən/' },
            { english: 'New', spanish: 'Nuevo', pronunciation: '/nuː/' },
            { english: 'Good', spanish: 'Bueno', pronunciation: '/ɡʊd/' },
            { english: 'Big', spanish: 'Grande', pronunciation: '/bɪɡ/' },
            { english: 'Small', spanish: 'Pequeño', pronunciation: '/smɔːl/' },
            { english: 'Help', spanish: 'Ayuda', pronunciation: '/hɛlp/' },
            { english: 'Work', spanish: 'Trabajo', pronunciation: '/wɜːrk/' }
        ];

        // Game state
        let currentWord = 0;
        let score = 0;
        let correctAnswers = 0;
        let gameCompleted = false;
        let currentOptions = [];

        // Initialize game
        function initGame() {
            currentWord = 0;
            score = 0;
            correctAnswers = 0;
            gameCompleted = false;
            updateDisplay();
            showWord();
        }

        // Show current word
        function showWord() {
            if (currentWord >= vocabulary.length) {
                endGame();
                return;
            }

            const word = vocabulary[currentWord];
            $('#english-word').text(word.english);
            $('#pronunciation').text(word.pronunciation);
            
            generateOptions();
            updateDisplay();
        }

        // Generate answer options
        function generateOptions() {
            const correctAnswer = vocabulary[currentWord].spanish;
            const allAnswers = vocabulary.map(word => word.spanish);
            
            // Get 3 incorrect answers
            const incorrectAnswers = allAnswers
                .filter(answer => answer !== correctAnswer)
                .sort(() => Math.random() - 0.5)
                .slice(0, 3);
            
            // Combine and shuffle
            currentOptions = [...incorrectAnswers, correctAnswer].sort(() => Math.random() - 0.5);
            
            // Create option buttons
            const optionsGrid = $('#options-grid');
            optionsGrid.empty();
            
            currentOptions.forEach((option, index) => {
                const button = $(`<button class="option-button" data-answer="${option}">
                    ${option}
                </button>`);
                
                button.click(() => selectAnswer(option));
                optionsGrid.append(button);
            });
        }

        // Handle answer selection
        function selectAnswer(selectedAnswer) {
            const correctAnswer = vocabulary[currentWord].spanish;
            const isCorrect = selectedAnswer === correctAnswer;
            
            // Disable all buttons
            $('.option-button').prop('disabled', true);
            
            // Show correct/incorrect feedback
            $('.option-button').each(function() {
                const buttonAnswer = $(this).data('answer');
                if (buttonAnswer === correctAnswer) {
                    $(this).addClass('correct');
                } else if (buttonAnswer === selectedAnswer && !isCorrect) {
                    $(this).addClass('incorrect');
                }
            });
            
            // Update score
            if (isCorrect) {
                correctAnswers++;
                score += 10;
            }
            
            // Show next button
            setTimeout(() => {
                $('#next-button').show();
            }, 1000);
        }

        // Next word
        function nextWord() {
            currentWord++;
            $('#next-button').hide();
            showWord();
        }

        // Update display
        function updateDisplay() {
            $('#current-score').text(score);
            $('#current-word').text(currentWord + 1);
            $('#correct-answers').text(correctAnswers);
            
            const progress = ((currentWord + 1) / vocabulary.length) * 100;
            $('#progress-fill').css('width', progress + '%');
        }

        // End game
        function endGame() {
            gameCompleted = true;
            
            // Calculate stars
            const percentage = (correctAnswers / vocabulary.length) * 100;
            let stars = 1;
            if (percentage >= 70) stars = 2;
            if (percentage >= 90) stars = 3;
            
            // Update results
            $('#final-score').text(score);
            $('#final-correct').text(correctAnswers);
            
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
                window.opener.onGameComplete(1, score, stars);
            }
        }

        // Restart game
        function restartGame() {
            $('#results-panel').removeClass('visible');
            initGame();
        }

        // Go to home
        function goHome() {
            window.location.href = '../index.php';
        }

        // Initialize game on load
        $(document).ready(() => {
            initGame();
        });
    </script>
</body>
</html>