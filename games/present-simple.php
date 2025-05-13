<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presente Simple - English Trainer</title>
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
            <h1>Presente Simple</h1>
            <p>Completa las oraciones con la forma correcta del verbo</p>
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
            <button class="control-button" onclick="continueToNextLevel(4)">
                <i class="fas fa-arrow-right"></i> Siguiente Nivel
            </button>
        </div>
    </div>

    <script src="../js/games.js"></script>
    <script>
        // Game data for Present Simple
        const sentences = [
            {
                sentence: "I _____ to school every day.",
                translation: "Yo voy a la escuela todos los días.",
                correct: "go",
                options: ["go", "goes", "going", "went"],
                explanation: "Usamos 'go' con I/you/we/they en presente simple."
            },
            {
                sentence: "She _____ her homework at night.",
                translation: "Ella hace su tarea por la noche.",
                correct: "does",
                options: ["do", "does", "doing", "did"],
                explanation: "Usamos 'does' con he/she/it en presente simple."
            },
            {
                sentence: "They _____ football on weekends.",
                translation: "Ellos juegan fútbol los fines de semana.",
                correct: "play",
                options: ["play", "plays", "playing", "played"],
                explanation: "Usamos 'play' con they en presente simple."
            },
            {
                sentence: "He _____ coffee every morning.",
                translation: "Él bebe café cada mañana.",
                correct: "drinks",
                options: ["drink", "drinks", "drinking", "drank"],
                explanation: "Agregamos 's' a los verbos con he/she/it en presente simple."
            },
            {
                sentence: "We _____ English at school.",
                translation: "Nosotros estudiamos inglés en la escuela.",
                correct: "study",
                options: ["study", "studies", "studying", "studied"],
                explanation: "Usamos 'study' con we en presente simple."
            },
            {
                sentence: "The cat _____ on the sofa.",
                translation: "El gato duerme en el sofá.",
                correct: "sleeps",
                options: ["sleep", "sleeps", "sleeping", "slept"],
                explanation: "Agregamos 's' a los verbos con sujetos de tercera persona singular."
            },
            {
                sentence: "I _____ my teeth twice a day.",
                translation: "Yo me cepillo los dientes dos veces al día.",
                correct: "brush",
                options: ["brush", "brushes", "brushing", "brushed"],
                explanation: "Usamos 'brush' con I en presente simple."
            },
            {
                sentence: "She _____ the bus to work.",
                translation: "Ella toma el autobús para ir al trabajo.",
                correct: "takes",
                options: ["take", "takes", "taking", "took"],
                explanation: "Agregamos 's' a 'take' con she en presente simple."
            },
            {
                sentence: "You _____ very well.",
                translation: "Tú cantas muy bien.",
                correct: "sing",
                options: ["sing", "sings", "singing", "sang"],
                explanation: "Usamos 'sing' con you en presente simple."
            },
            {
                sentence: "The dog _____ in the park.",
                translation: "El perro corre en el parque.",
                correct: "runs",
                options: ["run", "runs", "running", "ran"],
                explanation: "Agregamos 's' a los verbos con sujetos de tercera persona singular."
            },
            {
                sentence: "We _____ TV in the evening.",
                translation: "Nosotros vemos TV por la noche.",
                correct: "watch",
                options: ["watch", "watches", "watching", "watched"],
                explanation: "Usamos 'watch' con we en presente simple."
            },
            {
                sentence: "She _____ her room every week.",
                translation: "Ella limpia su cuarto cada semana.",
                correct: "cleans",
                options: ["clean", "cleans", "cleaning", "cleaned"],
                explanation: "Agregamos 's' a los verbos con she en presente simple."
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
                const option = button.textContent;
                if (option === sentence.correct) {
                    button.classList.add('correct');
                    if (isCorrect) {
                        pulseElement(button, 'var(--green-bright)');
                    }
                } else if (option === selectedOption && !isCorrect) {
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
            handleLevelCompletion(4, score, stars);
            
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