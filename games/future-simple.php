<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futuro Simple - English Trainer</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1 class="header-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                    <path d="M3 7v10a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2z"></path>
                    <line x1="8" y1="12" x2="16" y2="12"></line>
                    <line x1="12" y1="8" x2="12" y2="16"></line>
                </svg>
                Futuro Simple
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
                    <h2 id="question">Completa: "I _____ visit my grandmother tomorrow."</h2>
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

            const questions = [
                {
                    question: 'Completa: "I _____ visit my grandmother tomorrow."',
                    options: ['will', 'am going to', 'Ambas son correctas', 'visited'],
                    correct: 2,
                    explanation: 'Tanto "will" como "going to" pueden usarse para planes futuros'
                },
                {
                    question: 'Completa: "She _____ study medicine."',
                    options: ['will', 'is going to', 'Ambas son correctas', 'studying'],
                    correct: 2,
                    explanation: 'Para planes o intenciones, podemos usar will o going to'
                },
                {
                    question: 'Para una promesa, es mejor usar:',
                    options: ['going to', 'will', 'Ambas', 'would'],
                    correct: 1,
                    explanation: 'Will se usa comúnmente para promesas: "I will help you"'
                },
                {
                    question: 'Forma negativa con will: "I _____ come tomorrow."',
                    options: ["will not", "won't", "Ambas son correctas", "don't will"],
                    correct: 2,
                    explanation: '"Will not" y "won\'t" significan lo mismo (contracción)'
                },
                {
                    question: 'Pregunta con will: "_____ you help me?"',
                    options: ['Do', 'Will', 'Are', 'Is'],
                    correct: 1,
                    explanation: 'Para preguntas con will: Will + sujeto + verbo'
                },
                {
                    question: 'Completa: "They _____ going to travel next week."',
                    options: ['are', 'is', 'am', 'will'],
                    correct: 0,
                    explanation: 'Con "They", usamos "are": They are going to travel'
                },
                {
                    question: 'Muy probable que suceda: "Look at the clouds! It _____ rain."',
                    options: ['will', 'is going to', 'am going to', 'are going to'],
                    correct: 1,
                    explanation: 'Para algo que va a pasar pronto, usamos "going to"'
                },
                {
                    question: 'Decisión espontánea: "I _____ buy that!"',
                    options: ['will', 'am going to', 'Ambas', 'would'],
                    correct: 0,
                    explanation: 'Para decisiones del momento, usamos "will"'
                },
                {
                    question: '¿Cuál es incorrecta?',
                    options: ['I will go', 'I am going to go', 'I will going', 'I go tomorrow'],
                    correct: 2,
                    explanation: '"I will going" es incorrecto. Debe ser "I will go"'
                },
                {
                    question: 'Negativo con going to: "She _____ going to study."',
                    options: ["isn't", "won't", "doesn't", "aren't"],
                    correct: 0,
                    explanation: 'Con "she": She isn\'t going to study (she + is + not)'
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
                
                if (currentQuestion >= questions.length) {
                    showResults();
                } else {
                    loadQuestion();
                }
            }

            function showResults() {
                const percentage = (correctAnswers / questions.length) * 100;
                
                // Update progress
                englishTrainer.updateGameProgress(7, {
                    questionsAnswered: currentQuestion,
                    score: percentage
                });
                
                const resultsContainer = $('.game-container');
                resultsContainer.html(`
                    <div class="theory-container">
                        <div class="theory-content text-center">
                            <h2>¡Felicidades! ¡Todos los juegos completados!</h2>
                            <div class="score-display" style="font-size: 1.5rem; margin: 1rem 0;">
                                ${score} puntos
                            </div>
                            <p>Respuestas correctas: ${correctAnswers}/${questions.length}</p>
                            <p>Porcentaje: ${percentage.toFixed(1)}%</p>
                            ${percentage >= 70 ? '<p style="color: #2ECC71; font-weight: 600;">¡Has completado todos los tiempos verbales!</p>' : '<p>Sigue practicando para perfeccionar tu inglés.</p>'}
                            <div style="margin-top: 2rem;">
                                <h3>¡Enhorabuena!</h3>
                                <p>Has terminado todos los juegos de English Trainer.</p>
                                <p>Continúa practicando para mantener tu nivel.</p>
                            </div>
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
                        <button class="btn primary" onclick="location.reload()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 2v6h6"></path>
                                <path d="M21 22v-6h-6"></path>
                                <path d="M2 14a10 10 0 0 0 20 0"></path>
                                <path d="M22 10a10 10 0 0 0-20 0"></path>
                            </svg>
                            Intentar de Nuevo
                        </button>
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