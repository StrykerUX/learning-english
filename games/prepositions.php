<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preposiciones - English Trainer</title>
    <link rel="stylesheet" href="../css/games.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Specific styles for prepositions game */
        .visual-scenario {
            text-align: center;
            margin-bottom: var(--space-lg);
            padding: var(--space-xl);
            background: var(--orange-pastel);
            border-radius: var(--radius-soft);
            border: 3px solid var(--bg-space);
            box-shadow: var(--shadow-subtle);
        }
        
        .scenario-visual {
            font-size: 3rem;
            margin-bottom: var(--space-md);
        }
        
        .scenario-description {
            font-size: var(--font-size-lg);
            color: var(--bg-space);
            font-weight: 600;
            line-height: 1.4;
        }
        
        .options-container {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        }
        
        @media (max-width: 768px) {
            .scenario-visual {
                font-size: 2rem;
            }
            
            .scenario-description {
                font-size: var(--font-size-base);
            }
        }
    </style>
</head>
<body>
    <div class="game-container">
        <button class="back-button" onclick="goHome()">
            <i class="fas fa-arrow-left"></i> Volver
        </button>
        
        <div class="game-header">
            <h1>Preposiciones</h1>
            <p>Aprende dónde están las cosas con las preposiciones</p>
        </div>
        
        <div class="game-stats">
            <div class="stat-item">
                <div class="score-label">Situación</div>
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
        
        <div class="visual-scenario">
            <div class="scenario-visual" id="scenario-visual"></div>
            <div class="scenario-description" id="scenario-description"></div>
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
            <button class="control-button" onclick="goToMenu()" style="background: var(--purple-bright); color: white;">
                <i class="fas fa-home"></i> Volver al Menú
            </button>
            <button class="control-button" onclick="continueToNextLevel(8)">
                <i class="fas fa-rocket"></i> ¡Misión Completa!
            </button>
        </div>
    </div>

    <script src="../js/games.js"></script>
    <script>
        // Game data for Prepositions
        const sentences = [
            {
                visual: "📚🪑",
                description: "Un libro está encima de una silla",
                sentence: "The book is _____ the chair.",
                translation: "El libro está encima de la silla.",
                correct: "on",
                options: ["on", "in", "under", "next to"],
                explanation: "'On' se usa para objetos que están sobre una superficie."
            },
            {
                visual: "🏠🌳",
                description: "Una casa está detrás de un árbol",
                sentence: "The house is _____ the tree.",
                translation: "La casa está detrás del árbol.",
                correct: "behind",
                options: ["behind", "in front of", "next to", "under"],
                explanation: "'Behind' significa detrás de, lo opuesto a 'in front of'."
            },
            {
                visual: "🐱📦",
                description: "Un gato está dentro de una caja",
                sentence: "The cat is _____ the box.",
                translation: "El gato está dentro de la caja.",
                correct: "in",
                options: ["in", "on", "under", "next to"],
                explanation: "'In' se usa cuando algo está dentro de un espacio cerrado."
            },
            {
                visual: "📱🛋️",
                description: "Un teléfono está al lado del sofá",
                sentence: "The phone is _____ the sofa.",
                translation: "El teléfono está al lado del sofá.",
                correct: "next to",
                options: ["next to", "on", "under", "in"],
                explanation: "'Next to' significa al lado de, cerca de algo."
            },
            {
                visual: "🐕🚗",
                description: "Un perro está debajo del carro",
                sentence: "The dog is _____ the car.",
                translation: "El perro está debajo del carro.",
                correct: "under",
                options: ["under", "on", "in", "behind"],
                explanation: "'Under' significa debajo de, lo opuesto a 'on'."
            },
            {
                visual: "🌺🪴",
                description: "Una flor está delante de una planta",
                sentence: "The flower is _____ the plant.",
                translation: "La flor está delante de la planta.",
                correct: "in front of",
                options: ["in front of", "behind", "next to", "on"],
                explanation: "'In front of' significa delante de, lo opuesto a 'behind'."
            },
            {
                visual: "🔑🚪",
                description: "Las llaves están en la puerta",
                sentence: "The keys are _____ the door.",
                translation: "Las llaves están en la puerta.",
                correct: "in",
                options: ["in", "on", "next to", "under"],
                explanation: "'In' se usa cuando algo está insertado o dentro de algo."
            },
            {
                visual: "🖼️🔲",
                description: "Un cuadro está entre dos ventanas",
                sentence: "The picture is _____ the windows.",
                translation: "El cuadro está entre las ventanas.",
                correct: "between",
                options: ["between", "on", "under", "next to"],
                explanation: "'Between' se usa cuando algo está en el medio de dos objetos."
            },
            {
                visual: "☕📋",
                description: "Una taza está sobre una mesa",
                sentence: "The cup is _____ the table.",
                translation: "La taza está sobre la mesa.",
                correct: "on",
                options: ["on", "in", "under", "behind"],
                explanation: "'On' se usa para objetos que están sobre una superficie."
            },
            {
                visual: "🎒🪑",
                description: "Una mochila está al lado de la silla",
                sentence: "The backpack is _____ the chair.",
                translation: "La mochila está al lado de la silla.",
                correct: "next to",
                options: ["next to", "on", "in", "under"],
                explanation: "'Next to' significa cerca de, al lado de algo."
            },
            {
                visual: "🍕📱",
                description: "Una pizza está debajo del teléfono",
                sentence: "The pizza is _____ the phone.",
                translation: "La pizza está debajo del teléfono.",
                correct: "under",
                options: ["under", "on", "in", "next to"],
                explanation: "'Under' significa debajo de algo."
            },
            {
                visual: "🎪🎯",
                description: "Una carpa está detrás del objetivo",
                sentence: "The tent is _____ the target.",
                translation: "La carpa está detrás del objetivo.",
                correct: "behind",
                options: ["behind", "in front of", "on", "under"],
                explanation: "'Behind' significa detrás de algo."
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
            
            // Display visual scenario
            document.getElementById('scenario-visual').textContent = sentence.visual;
            document.getElementById('scenario-description').textContent = sentence.description;
            
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
            handleLevelCompletion(8, score, stars);
            
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