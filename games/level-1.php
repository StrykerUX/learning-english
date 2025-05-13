<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nivel 1: Vocabulario Básico - English Trainer</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1 class="header-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                </svg>
                Vocabulario Básico
            </h1>
            <div class="score-display">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                </svg>
                <span id="score">0</span> puntos | <span id="question-counter">1</span>/10
            </div>
        </header>

        <main class="main">
            <div class="game-container">
                <div class="question-card">
                    <h2 id="question">¿Cuál es la traducción de "Red"?</h2>
                </div>
                
                <div class="options-grid" id="options-container">
                    <!-- Options will be loaded here -->
                </div>
                
                <div class="nav-buttons" style="display: none;" id="result-section">
                    <div class="btn" id="explanation" style="background: var(--secondary-color); cursor: default;"></div>
                    <button class="btn success" id="next-question">
                        Siguiente
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
            let currentQuestion = 0;
            let score = 0;
            let correctAnswers = 0;
            let gameComplete = false;

            const questions = [
                {
                    question: '¿Cuál es la traducción de "Red"?',
                    options: ['Rojo', 'Azul', 'Verde', 'Amarillo'],
                    correct: 0,
                    explanation: 'Red significa "Rojo" en español'
                },
                {
                    question: '¿Cómo se dice "Cinco" en inglés?',
                    options: ['Four', 'Five', 'Six', 'Seven'],
                    correct: 1,
                    explanation: 'Five es el número cinco en inglés'
                },
                {
                    question: '¿Cuál es la traducción de "Mother"?',
                    options: ['Hermana', 'Madre', 'Padre', 'Tía'],
                    correct: 1,
                    explanation: 'Mother significa "Madre" en español'
                },
                {
                    question: '¿Cómo se dice "Gato" en inglés?',
                    options: ['Dog', 'Cat', 'Bird', 'Fish'],
                    correct: 1,
                    explanation: 'Cat es la palabra en inglés para gato'
                },
                {
                    question: '¿Cuál es la traducción de "Blue"?',
                    options: ['Negro', 'Blanco', 'Azul', 'Verde'],
                    correct: 2,
                    explanation: 'Blue significa "Azul" en español'
                },
                {
                    question: '¿Cómo se dice "Tres" en inglés?',
                    options: ['Two', 'Three', 'Four', 'Five'],
                    correct: 1,
                    explanation: 'Three es el número tres en inglés'
                },
                {
                    question: '¿Cuál es la traducción de "Father"?',
                    options: ['Padre', 'Hermano', 'Tío', 'Abuelo'],
                    correct: 0,
                    explanation: 'Father significa "Padre" en español'
                },
                {
                    question: '¿Cómo se dice "Perro" en inglés?',
                    options: ['Cat', 'Dog', 'Horse', 'Bird'],
                    correct: 1,
                    explanation: 'Dog es la palabra en inglés para perro'
                },
                {
                    question: '¿Cuál es la traducción de "Yellow"?',
                    options: ['Verde', 'Rojo', 'Azul', 'Amarillo'],
                    correct: 3,
                    explanation: 'Yellow significa "Amarillo" en español'
                },
                {
                    question: '¿Cómo se dice "Diez" en inglés?',
                    options: ['Nine', 'Ten', 'Eleven', 'Twelve'],
                    correct: 1,
                    explanation: 'Ten es el número diez en inglés'
                }
            ];

            function loadQuestion() {
                const question = questions[currentQuestion];
                $('#question').text(question.question);
                $('#question-counter').text(currentQuestion + 1);
                
                const optionsContainer = $('#options-container');
                optionsContainer.empty();
                
                question.options.forEach((option, index) => {
                    const optionElement = $(`
                        <button class="option-button" data-index="${index}">
                            ${option}
                        </button>
                    `);
                    optionsContainer.append(optionElement);
                });
                
                $('#result-section').hide();
                $('.option-button').show();
            }

            function handleAnswer(selectedIndex) {
                const question = questions[currentQuestion];
                const isCorrect = selectedIndex === question.correct;
                
                $('.option-button').off('click');
                $('.option-button').each(function(index) {
                    if (index === question.correct) {
                        $(this).addClass('correct');
                    } else if (index === selectedIndex && !isCorrect) {
                        $(this).addClass('incorrect');
                    }
                });
                
                if (isCorrect) {
                    correctAnswers++;
                    score += 10;
                    $('#score').text(score);
                    englishTrainer.showNotification('¡Correcto! +10 puntos', 'success');
                } else {
                    englishTrainer.showNotification('Incorrecto. La respuesta correcta era: ' + question.options[question.correct], 'error');
                }
                
                $('#explanation').text(question.explanation);
                $('#result-section').show();
            }

            function nextQuestion() {
                currentQuestion++;
                englishTrainer.updateLevelProgress(1, currentQuestion, score);
                
                if (currentQuestion >= questions.length) {
                    showResults();
                } else {
                    loadQuestion();
                }
            }

            function showResults() {
                const percentage = (correctAnswers / questions.length) * 100;
                let message = `¡Juego completado!\n\nPuntuación final: ${score} puntos\nRespuestas correctas: ${correctAnswers}/${questions.length}\nPorcentaje: ${percentage.toFixed(1)}%`;
                
                if (percentage >= 70) {
                    message += "\n\n¡Felicidades! Has desbloqueado el siguiente nivel.";
                    englishTrainer.showNotification('¡Nivel completado con éxito!', 'success');
                }
                
                const resultsContainer = $('.game-container');
                resultsContainer.html(`
                    <div class="theory-container">
                        <div class="theory-content text-center">
                            <h2>¡Juego Completado!</h2>
                            <div class="score-display" style="font-size: 1.5rem; margin: 1rem 0;">
                                ${score} puntos
                            </div>
                            <p>Respuestas correctas: ${correctAnswers}/${questions.length}</p>
                            <p>Porcentaje: ${percentage.toFixed(1)}%</p>
                            ${percentage >= 70 ? '<p style="color: #2ECC71; font-weight: 600;">¡Has completado el nivel!</p>' : '<p>Necesitas al menos 70% para completar el nivel.</p>'}
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
                        ${currentQuestion < questions.length ? `
                            <button class="btn primary" onclick="location.reload()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 2v6h6"></path>
                                    <path d="M21 22v-6h-6"></path>
                                    <path d="M2 14a10 10 0 0 0 20 0"></path>
                                    <path d="M22 10a10 10 0 0 0-20 0"></path>
                                </svg>
                                Intentar de Nuevo
                            </button>
                        ` : ''}
                    </div>
                `);
            }

            // Event handlers
            $(document).on('click', '.option-button', function() {
                handleAnswer(parseInt($(this).data('index')));
            });

            $('#next-question').click(function() {
                nextQuestion();
            });

            // Initialize game
            loadQuestion();
        });
    </script>
</body>
</html>