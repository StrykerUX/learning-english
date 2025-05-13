<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preposiciones - English Trainer</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .game-container {
            max-width: 900px;
            margin: 2rem auto;
            padding: 2rem;
            background: rgba(0, 0, 0, 0.8);
            border: 3px solid #0ff;
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }
        
        .visual-scenario {
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid #333;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            text-align: center;
        }
        
        .scenario-visual {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #0ff;
        }
        
        .scenario-description {
            font-size: 1.3rem;
            color: #fff;
            margin-bottom: 0.5rem;
        }
        
        .sentence-display {
            text-align: center;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            border: 2px solid #333;
        }
        
        .sentence-text {
            font-size: 2rem;
            color: #fff;
            margin-bottom: 1rem;
        }
        
        .missing-word {
            color: #ffd700;
            background: rgba(255, 215, 0, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 5px;
            border: 2px dashed #ffd700;
        }
        
        .sentence-translation {
            color: #888;
            font-style: italic;
            font-size: 1.2rem;
        }
        
        .options-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .option-button {
            padding: 1rem;
            background: #1a1a1a;
            border: 2px solid #333;
            border-radius: 10px;
            color: #fff;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
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
        
        .explanation-panel {
            background: rgba(34, 197, 94, 0.1);
            border: 2px solid #16a34a;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            display: none;
        }
        
        .explanation-panel.visible {
            display: block;
        }
        
        .explanation-panel h3 {
            color: #16a34a;
            margin-bottom: 0.5rem;
        }
        
        .explanation-panel p {
            color: #ccc;
            line-height: 1.5;
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
                <button class="control-button" onclick="returnToBase()">
                    <i class="fas fa-rocket"></i> Regresar a Base
                </button>
                <button class="control-button" onclick="continueJourney()">
                    <i class="fas fa-space-shuttle"></i> Continuar Misión
                </button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            $('#scenario-visual').text(sentence.visual);
            $('#scenario-description').text(sentence.description);
            
            // Display sentence with blank
            const sentenceWithBlank = sentence.sentence.replace(/_____/, '<span class="missing-word">_____</span>');
            $('#sentence-text').html(sentenceWithBlank);
            $('#sentence-translation').text(sentence.translation);
            
            // Hide explanation panel
            $('#explanation-panel').removeClass('visible');
            
            // Generate options
            generateOptions();
            updateDisplay();
        }

        // Generate answer options
        function generateOptions() {
            const sentence = sentences[currentSentence];
            const container = $('#options-container');
            container.empty();
            
            // Shuffle options
            const shuffledOptions = [...sentence.options].sort(() => Math.random() - 0.5);
            
            shuffledOptions.forEach(option => {
                const button = $(`<button class="option-button" data-option="${option}">
                    ${option}
                </button>`);
                
                button.click(() => selectOption(option));
                container.append(button);
            });
        }

        // Handle option selection
        function selectOption(selectedOption) {
            const sentence = sentences[currentSentence];
            const isCorrect = selectedOption === sentence.correct;
            
            // Disable all buttons
            $('.option-button').prop('disabled', true);
            
            // Show feedback
            $('.option-button').each(function() {
                const option = $(this).data('option');
                if (option === sentence.correct) {
                    $(this).addClass('correct');
                } else if (option === selectedOption && !isCorrect) {
                    $(this).addClass('incorrect');
                }
            });
            
            // Show explanation
            $('#explanation-text').text(sentence.explanation);
            $('#explanation-panel').addClass('visible');
            
            // Update score
            if (isCorrect) {
                correctAnswers++;
                score += 15;
            } else {
                score = Math.max(0, score - 3);
            }
            
            // Show next button
            setTimeout(() => {
                $('#next-button').show();
            }, 1000);
            
            updateDisplay();
        }

        // Next sentence
        function nextSentence() {
            currentSentence++;
            $('#next-button').hide();
            showSentence();
        }

        // Update display
        function updateDisplay() {
            $('#current-score').text(score);
            $('#current-sentence').text(currentSentence + 1);
            $('#correct-answers').text(correctAnswers);
        }

        // End game
        function endGame() {
            gameCompleted = true;
            
            // Calculate stars
            const percentage = (correctAnswers / sentences.length) * 100;
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
                window.opener.onGameComplete(8, score, stars);
            }
        }

        // Función no utilizada - removida para evitar confusión
        // Los usuarios solo pueden regresar o continuar

        // Return to base (dashboard)
        function returnToBase() {
            // Guardar progreso y regresar al dashboard
            window.location.href = '../index.html';
        }

        // Continue to next level
        function continueJourney() {
            // Verificar si es el último nivel
            if (8 >= 8) { // Nivel 8 es el último nivel
                // Si es el último nivel, mostrar pantalla de felicitaciones
                window.location.href = '../congratulations.html';
            } else {
                // Esto no debería ejecutarse en el nivel 8
                window.location.href = '../congratulations.html';
            }
        }

        // Initialize game on load
        $(document).ready(() => {
            initGame();
        });
    </script>
</body>
</html>