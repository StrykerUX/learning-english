<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presente Continuo - English Trainer</title>
    <link rel="stylesheet" href="../css/games.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="game-container">
        <button class="back-button" onclick="goHome()">
            <i class="fas fa-arrow-left"></i> Volver
        </button>
        
        <div class="game-header">
            <h1>Presente Continuo</h1>
            <p>Completa las oraciones con la forma correcta del presente continuo</p>
        </div>
        
        <div class="game-stats">
            <div class="stat-item">
                <div class="score-label">Oración</div>
                <div class="score-value" id="current-sentence">1</div>
            </div>
            <div class="stat-item">
                <div class="score-label">Puntos</div>
                <div class="score-value" id="current-score">0</div>
            </div>
            <div class="stat-item">
                <div class="score-label">Correctas</div>
                <div class="score-value" id="correct-answers">0</div>
            </div>
        </div>
        
        <div class="sentence-display">
            <div class="sentence-text" id="sentence-text"></div>
            <div class="sentence-translation" id="sentence-translation"></div>
        </div>
        
        <div class="explanation-panel" id="explanation-panel">
            <h3>Explicación</h3>
            <p id="explanation-text"></p>
        </div>
        
        <div class="options-container" id="options-container">
            <!-- Options will be generated here -->
        </div>
        
        <div class="game-controls">
            <button class="next-button control-button" id="next-button" onclick="nextSentence()" style="display: none;">
                Siguiente <i class="fas fa-arrow-right"></i>
            </button>
        </div>
    </div>
    
    <div class="results-panel" id="results-panel">
        <h2>¡Juego Completado!</h2>
        <div class="stars-display" id="stars-display"></div>
        <p>Puntuación Final: <span id="final-score"></span></p>
        <p>Correctas: <span id="final-correct"></span>/12</p>
        <div class="game-controls">
            <button class="control-button" onclick="restartGame()">
                <i class="fas fa-redo"></i> Jugar de Nuevo
            </button>
            <button class="control-button" onclick="continueToNextLevel(5)">
                <i class="fas fa-arrow-right"></i> Siguiente Nivel
            </button>
        </div>
    </div>

    <script src="../js/games.js"></script>
    <script>
        // Game data for Present Continuous
        const sentences = [
            {
                sentence: "I _____ watching TV right now.",
                translation: "Estoy viendo TV ahora mismo.",
                correct: "am",
                options: ["am", "is", "are", "was"],
                explanation: "Usamos 'am' con 'I' en presente continuo."
            },
            {
                sentence: "She _____ cooking dinner.",
                translation: "Ella está cocinando la cena.",
                correct: "is",
                options: ["am", "is", "are", "were"],
                explanation: "Usamos 'is' con he/she/it en presente continuo."
            },
            {
                sentence: "They _____ playing football.",
                translation: "Ellos están jugando fútbol.",
                correct: "are",
                options: ["am", "is", "are", "is not"],
                explanation: "Usamos 'are' con they/we/you en presente continuo."
            },
            {
                sentence: "I am _____ to music.",
                translation: "Estoy escuchando música.",
                correct: "listening",
                options: ["listen", "listening", "listened", "listens"],
                explanation: "En presente continuo usamos verbo + -ing."
            },
            {
                sentence: "He _____ studying English.",
                translation: "Él está estudiando inglés.",
                correct: "is",
                options: ["am", "is", "are", "was"],
                explanation: "Usamos 'is' con he/she/it en presente continuo."
            },
            {
                sentence: "We are _____ our homework.",
                translation: "Estamos haciendo nuestra tarea.",
                correct: "doing",
                options: ["do", "doing", "did", "does"],
                explanation: "En presente continuo usamos be + verbo + -ing."
            },
            {
                sentence: "The cat _____ sleeping on the bed.",
                translation: "El gato está durmiendo en la cama.",
                correct: "is",
                options: ["am", "is", "are", "were"],
                explanation: "Usamos 'is' con sujetos de tercera persona singular."
            },
            {
                sentence: "You are _____ very fast.",
                translation: "Estás corriendo muy rápido.",
                correct: "running",
                options: ["run", "running", "ran", "runs"],
                explanation: "Para verbos que terminan en consonante + vocal + consonante, doblamos la última consonante antes de agregar -ing."
            },
            {
                sentence: "My friends _____ coming to the party.",
                translation: "Mis amigos están viniendo a la fiesta.",
                correct: "are",
                options: ["am", "is", "are", "was"],
                explanation: "Usamos 'are' con sujetos plurales como 'friends'."
            },
            {
                sentence: "She is _____ a book.",
                translation: "Ella está leyendo un libro.",
                correct: "reading",
                options: ["read", "reading", "reads", "readed"],
                explanation: "En presente continuo usamos be + verbo + -ing."
            },
            {
                sentence: "It _____ raining outside.",
                translation: "Está lloviendo afuera.",
                correct: "is",
                options: ["am", "is", "are", "were"],
                explanation: "Usamos 'is' con 'it' en presente continuo."
            },
            {
                sentence: "We are _____ to school.",
                translation: "Estamos caminando a la escuela.",
                correct: "walking",
                options: ["walk", "walking", "walked", "walks"],
                explanation: "En presente continuo usamos be + verbo + -ing."
            }
        ];

        // Game state
        let currentSentence = 0;
        let score = 0;
        let correctAnswers = 0;
        let gameCompleted = false;

        // Initialize game
        function initGame() {
            currentSentence = 0;
            score = 0;
            correctAnswers = 0;
            gameCompleted = false;
            updateDisplay();
            showSentence();
        }

        // Show current sentence
        function showSentence() {
            if (currentSentence >= sentences.length) {
                endGame();
                return;
            }

            const sentence = sentences[currentSentence];
            
            // Display sentence with blank
            const sentenceWithBlank = sentence.sentence.replace(/_____/, '<span class="missing-word">_____</span>');
            document.getElementById('sentence-text').innerHTML = sentenceWithBlank;
            document.getElementById('sentence-translation').textContent = sentence.translation;
            
            // Hide explanation panel
            document.getElementById('explanation-panel').classList.remove('visible');
            
            // Generate options
            generateOptions();
            updateDisplay();
        }

        // Generate answer options
        function generateOptions() {
            const sentence = sentences[currentSentence];
            const container = document.getElementById('options-container');
            container.innerHTML = '';
            
            // Shuffle options
            const shuffledOptions = shuffleArray(sentence.options);
            
            shuffledOptions.forEach(option => {
                const button = document.createElement('button');
                button.className = 'option-button';
                button.textContent = option;
                button.onclick = () => selectOption(option);
                container.appendChild(button);
            });
        }

        // Handle option selection
        function selectOption(selectedOption) {
            const sentence = sentences[currentSentence];
            const isCorrect = selectedOption === sentence.correct;
            
            // Disable all buttons
            const buttons = document.querySelectorAll('.option-button');
            buttons.forEach(button => {
                button.disabled = true;
                if (button.textContent === sentence.correct) {
                    button.classList.add('correct');
                    if (isCorrect) {
                        pulseElement(button, 'var(--green-bright)');
                    }
                } else if (button.textContent === selectedOption && !isCorrect) {
                    button.classList.add('incorrect');
                    animateElement(button, 'translateX(-5px)');
                }
            });
            
            // Show explanation
            document.getElementById('explanation-text').textContent = sentence.explanation;
            document.getElementById('explanation-panel').classList.add('visible');
            
            // Update score
            if (isCorrect) {
                correctAnswers++;
                score += 15;
                showNotification('¡Correcto!', 'success');
            } else {
                score = Math.max(0, score - 3);
                showNotification('Incorrecto. Inténtalo de nuevo.', 'error');
            }
            
            // Show next button
            setTimeout(() => {
                document.getElementById('next-button').style.display = 'inline-flex';
            }, 1000);
            
            updateDisplay();
        }

        // Next sentence
        function nextSentence() {
            currentSentence++;
            document.getElementById('next-button').style.display = 'none';
            showSentence();
        }

        // Update display
        function updateDisplay() {
            document.getElementById('current-score').textContent = score;
            document.getElementById('current-sentence').textContent = currentSentence + 1;
            document.getElementById('correct-answers').textContent = correctAnswers;
        }

        // End game
        function endGame() {
            gameCompleted = true;
            
            // Calculate stars
            const percentage = (correctAnswers / sentences.length) * 100;
            let stars = calculateStars(score, sentences.length * 15);
            
            // Update results
            document.getElementById('final-score').textContent = score;
            document.getElementById('final-correct').textContent = correctAnswers;
            
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
            handleLevelCompletion(5, score, stars);
            
            showNotification('¡Juego completado!', 'success');
        }

        // Restart game
        function restartGame() {
            document.getElementById('results-panel').classList.remove('visible');
            initGame();
        }

        // Initialize game on load
        document.addEventListener('DOMContentLoaded', () => {
            initGame();
        });
    </script>
</body>
</html>