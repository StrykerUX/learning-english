<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futuro Simple - English Trainer</title>
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
            <h1>Futuro Simple</h1>
            <p>Completa las oraciones con la forma correcta del futuro simple</p>
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
            <button class="control-button" onclick="continueToNextLevel(7)">
                <i class="fas fa-arrow-right"></i> Siguiente Nivel
            </button>
        </div>
    </div>

    <script src="../js/games.js"></script>
    <script>
        // Game data for Future Simple
        const sentences = [
            {
                sentence: "I _____ go to the movies tomorrow.",
                translation: "Iré al cine mañana.",
                correct: "will",
                options: ["will", "was", "am", "were"],
                explanation: "Usamos 'will' para hablar de planes futuros y predicciones."
            },
            {
                sentence: "She _____ cook dinner tonight.",
                translation: "Ella cocinará la cena esta noche.",
                correct: "will",
                options: ["will", "would", "is", "was"],
                explanation: "Para todos los sujetos usamos 'will' antes del verbo base en futuro simple."
            },
            {
                sentence: "They _____ travel next month.",
                translation: "Ellos viajarán el próximo mes.",
                correct: "will",
                options: ["will", "are", "were", "would"],
                explanation: "'Will' no cambia con different sujetos en futuro simple."
            },
            {
                sentence: "It _____ be sunny tomorrow.",
                translation: "Estará soleado mañana.",
                correct: "will",
                options: ["will", "is", "was", "would"],
                explanation: "Usamos 'will be' para predicciones sobre el tiempo."
            },
            {
                sentence: "We _____ not be late for class.",
                translation: "No llegaremos tarde a clase.",
                correct: "will",
                options: ["will", "won't", "are", "were"],
                explanation: "La forma negativa del futuro simple es 'will not' o 'won't'."
            },
            {
                sentence: "I think the team _____ win the game.",
                translation: "Creo que el equipo ganará el juego.",
                correct: "will",
                options: ["will", "going to", "would", "is"],
                explanation: "Usamos 'will' con expresiones como 'I think' para predicciones."
            },
            {
                sentence: "_____ you help me with this?",
                translation: "¿Me ayudarás con esto?",
                correct: "Will",
                options: ["Will", "Are", "Were", "Do"],
                explanation: "Para preguntas en futuro simple usamos 'Will' al inicio."
            },
            {
                sentence: "She probably _____ arrive late.",
                translation: "Ella probablemente llegará tarde.",
                correct: "will",
                options: ["will", "is", "was", "would"],
                explanation: "Usamos 'will' con palabras como 'probably' para expresar probabilidad."
            },
            {
                sentence: "The store _____ close at 9 PM.",
                translation: "La tienda cerrará a las 9 PM.",
                correct: "will",
                options: ["will", "closing", "closed", "closes"],
                explanation: "Para horarios futuros usamos 'will' + verbo base."
            },
            {
                sentence: "I _____ never forget this day.",
                translation: "Nunca olvidaré este día.",
                correct: "will",
                options: ["will", "am", "was", "would"],
                explanation: "Usamos 'will' para promesas y decisiones firmes."
            },
            {
                sentence: "That _____ be expensive.",
                translation: "Eso será caro.",
                correct: "will",
                options: ["will", "is", "was", "would"],
                explanation: "Usamos 'will be' + adjetivo para predicciones."
            },
            {
                sentence: "The phone _____ ring soon.",
                translation: "El teléfono sonará pronto.",
                correct: "will",
                options: ["will", "is", "was", "would"],
                explanation: "Usamos 'will' + verbo base para eventos futuros inmediatos."
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
            handleLevelCompletion(7, score, stars);
            
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