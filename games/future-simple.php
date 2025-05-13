<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futuro Simple - English Trainer</title>
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
        
        .sentence-display {
            text-align: center;
            margin-bottom: 2rem;
            padding: 2rem;
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
                <button class="control-button" onclick="goHome()">
                    <i class="fas fa-home"></i> Menú Principal
                </button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                window.opener.onGameComplete(7, score, stars);
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