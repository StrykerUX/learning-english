<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preposiciones - English Trainer</title>
    <link rel="stylesheet" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Prepositions Game Specific Styles */
        .preposition-scene {
            background: white;
            border: 3px solid var(--text-dark);
            border-radius: var(--border-radius);
            padding: 2rem;
            min-height: 400px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 2rem;
        }
        
        .scene-objects {
            position: relative;
            width: 100%;
            max-width: 500px;
            height: 300px;
            border: 2px dashed #E0E6ED;
            border-radius: var(--border-radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .object {
            position: absolute;
            background: white;
            border: 2px solid var(--text-dark);
            border-radius: var(--border-radius-sm);
            padding: 1rem;
            box-shadow: 2px 2px 0px var(--shadow-dark);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            cursor: pointer;
        }
        
        .object:hover {
            transform: scale(1.05);
            box-shadow: 3px 3px 0px var(--shadow-dark);
        }
        
        .object-1 {
            background: var(--primary-color);
        }
        
        .object-2 {
            background: var(--secondary-color);
        }
        
        .line-svg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }
        
        .preposition-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-top: 2rem;
        }
        
        .preposition-btn {
            padding: 1rem;
            border: 2px solid var(--text-dark);
            border-radius: var(--border-radius-sm);
            background: white;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 600;
            text-align: center;
            font-size: 1.1rem;
        }
        
        .preposition-btn:hover {
            transform: translateY(-2px);
            box-shadow: 3px 3px 0px var(--shadow-dark);
        }
        
        .preposition-btn.correct {
            background: var(--success-color);
            color: #2ECC71;
        }
        
        .preposition-btn.incorrect {
            background: var(--accent-color);
            color: #E74C3C;
        }
        
        .scene-description {
            background: var(--warning-color);
            padding: 1rem;
            border-radius: var(--border-radius-sm);
            border: 2px solid var(--text-dark);
            text-align: center;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .visual-hint {
            position: absolute;
            background: var(--warning-color);
            padding: 0.5rem;
            border-radius: 50%;
            border: 2px solid var(--text-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: bold;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        /* Mobile responsive */
        @media (max-width: 768px) {
            .object {
                font-size: 2rem;
                padding: 0.75rem;
            }
            
            .scene-objects {
                height: 250px;
            }
            
            .preposition-options {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1 class="header-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                    <path d="M19 14v6a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-6"></path>
                    <path d="M12 2v8"></path>
                    <path d="m7 10-4-4h4"></path>
                    <path d="m17 10 4-4h-4"></path>
                </svg>
                Preposiciones
            </h1>
            <div class="score-display">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                </svg>
                <span id="score">0</span> puntos | <span id="question-counter">1</span>/15
            </div>
        </header>

        <main class="main">
            <div class="game-container">
                <div class="question-card">
                    <h2 id="question">¿Dónde está el círculo?</h2>
                    <div class="scene-description" id="scene-description">
                        El círculo está _____ del cuadrado
                    </div>
                </div>
                
                <div class="preposition-scene" id="scene-container">
                    <div class="scene-objects" id="objects-container">
                        <!-- Objects will be positioned here -->
                        <svg class="line-svg" id="line-svg">
                            <!-- Lines will be drawn here -->
                        </svg>
                    </div>
                </div>
                
                <div class="preposition-options" id="options-container">
                    <!-- Preposition options will be loaded here -->
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
            let wordsLearned = new Set();

            const scenarios = [
                {
                    question: '¿Dónde está el círculo?',
                    description: 'El círculo está _____ del cuadrado',
                    objects: [
                        { type: 'circle', icon: '●', x: 50, y: 70, style: 'object-1' },
                        { type: 'square', icon: '■', x: 50, y: 30, style: 'object-2' }
                    ],
                    options: ['above', 'below', 'next to', 'inside'],
                    correct: 1,
                    correctWord: 'below',
                    explanation: 'El círculo está por debajo del cuadrado - "below"'
                },
                {
                    question: '¿Dónde está la estrella?',
                    description: 'La estrella está _____ de la caja',
                    objects: [
                        { type: 'box', icon: '□', x: 70, y: 50, style: 'object-2' },
                        { type: 'star', icon: '★', x: 30, y: 50, style: 'object-1' }
                    ],
                    options: ['left', 'right', 'above', 'below'],
                    correct: 0,
                    correctWord: 'left',
                    explanation: 'La estrella está a la izquierda de la caja - "left"'
                },
                {
                    question: '¿Dónde está el triángulo?',
                    description: 'El triángulo está _____ del círculo',
                    objects: [
                        { type: 'circle', icon: '●', x: 30, y: 50, style: 'object-2' },
                        { type: 'triangle', icon: '▲', x: 70, y: 50, style: 'object-1' }
                    ],
                    options: ['left', 'right', 'between', 'under'],
                    correct: 1,
                    correctWord: 'right',
                    explanation: 'El triángulo está a la derecha del círculo - "right"'
                },
                {
                    question: '¿Dónde está el corazón?',
                    description: 'El corazón está _____ de la estrella',
                    objects: [
                        { type: 'star', icon: '★', x: 50, y: 30, style: 'object-2' },
                        { type: 'heart', icon: '♥', x: 50, y: 70, style: 'object-1' }
                    ],
                    options: ['above', 'under', 'beside', 'inside'],
                    correct: 1,
                    correctWord: 'under',
                    explanation: 'El corazón está por debajo de la estrella - "under"'
                },
                {
                    question: '¿Dónde está el diamante?',
                    description: 'El diamante está _____ de las cajas',
                    objects: [
                        { type: 'box1', icon: '□', x: 25, y: 50, style: 'object-2' },
                        { type: 'box2', icon: '□', x: 75, y: 50, style: 'object-2' },
                        { type: 'diamond', icon: '♦', x: 50, y: 50, style: 'object-1' }
                    ],
                    options: ['between', 'next to', 'above', 'below'],
                    correct: 0,
                    correctWord: 'between',
                    explanation: 'El diamante está entre las cajas - "between"'
                },
                {
                    question: '¿Dónde está el pentágono?',
                    description: 'El pentágono está _____ del hexágono',
                    objects: [
                        { type: 'hexagon', icon: '⬣', x: 50, y: 50, style: 'object-2' },
                        { type: 'pentagon', icon: '⬟', x: 50, y: 20, style: 'object-1' }
                    ],
                    options: ['below', 'above', 'beside', 'inside'],
                    correct: 1,
                    correctWord: 'above',
                    explanation: 'El pentágono está por encima del hexágono - "above"'
                },
                {
                    question: '¿Dónde está el círculo?',
                    description: 'El círculo está _____ de la línea',
                    objects: [
                        { type: 'line', icon: '━', x: 50, y: 50, style: 'object-2' },
                        { type: 'circle', icon: '●', x: 20, y: 50, style: 'object-1' }
                    ],
                    options: ['on', 'left', 'right', 'under'],
                    correct: 1,
                    correctWord: 'left',
                    explanation: 'El círculo está a la izquierda de la línea - "left"'
                },
                {
                    question: '¿Dónde está la flecha?',
                    description: 'La flecha está _____ del objetivo',
                    objects: [
                        { type: 'target', icon: '◎', x: 40, y: 40, style: 'object-2' },
                        { type: 'arrow', icon: '→', x: 70, y: 60, style: 'object-1' }
                    ],
                    options: ['near', 'far', 'next to', 'between'],
                    correct: 2,
                    correctWord: 'next to',
                    explanation: 'La flecha está al lado del objetivo - "next to"'
                },
                {
                    question: '¿Dónde está el punto?',
                    description: 'El punto está _____ del rectángulo',
                    objects: [
                        { type: 'rectangle', icon: '▬', x: 50, y: 40, style: 'object-2' },
                        { type: 'dot', icon: '•', x: 50, y: 60, style: 'object-1' }
                    ],
                    options: ['above', 'below', 'inside', 'around'],
                    correct: 1,
                    correctWord: 'below',
                    explanation: 'El punto está por debajo del rectángulo - "below"'
                },
                {
                    question: '¿Dónde están los círculos?',
                    description: 'Los círculos están _____ del cuadrado',
                    objects: [
                        { type: 'square', icon: '■', x: 50, y: 50, style: 'object-2' },
                        { type: 'circle1', icon: '●', x: 30, y: 30, style: 'object-1' },
                        { type: 'circle2', icon: '●', x: 70, y: 70, style: 'object-1' }
                    ],
                    options: ['around', 'inside', 'next to', 'between'],
                    correct: 0,
                    correctWord: 'around',
                    explanation: 'Los círculos están alrededor del cuadrado - "around"'
                },
                {
                    question: '¿Dónde está el óvalo?',
                    description: 'El óvalo está _____ de los triángulos',
                    objects: [
                        { type: 'triangle1', icon: '▲', x: 35, y: 40, style: 'object-2' },
                        { type: 'triangle2', icon: '▲', x: 65, y: 40, style: 'object-2' },
                        { type: 'oval', icon: '◯', x: 50, y: 60, style: 'object-1' }
                    ],
                    options: ['between', 'behind', 'below', 'beside'],
                    correct: 2,
                    correctWord: 'below',
                    explanation: 'El óvalo está por debajo de los triángulos - "below"'
                },
                {
                    question: '¿Dónde está la cruz?',
                    description: 'La cruz está _____ del círculo',
                    objects: [
                        { type: 'circle', icon: '●', x: 40, y: 50, style: 'object-2' },
                        { type: 'cross', icon: '✕', x: 60, y: 50, style: 'object-1' }
                    ],
                    options: ['left', 'right', 'above', 'below'],
                    correct: 1,
                    correctWord: 'right',
                    explanation: 'La cruz está a la derecha del círculo - "right"'
                },
                {
                    question: '¿Dónde está el cubo?',
                    description: 'El cubo está _____ de la esfera',
                    objects: [
                        { type: 'sphere', icon: '⚬', x: 50, y: 30, style: 'object-2' },
                        { type: 'cube', icon: '⬜', x: 50, y: 70, style: 'object-1' }
                    ],
                    options: ['above', 'under', 'beside', 'in front'],
                    correct: 1,
                    correctWord: 'under',
                    explanation: 'El cubo está por debajo de la esfera - "under"'
                },
                {
                    question: '¿Dónde está la barra?',
                    description: 'La barra está _____ del punto',
                    objects: [
                        { type: 'dot', icon: '•', x: 50, y: 20, style: 'object-1' },
                        { type: 'bar', icon: '▬', x: 50, y: 50, style: 'object-2' }
                    ],
                    options: ['above', 'below', 'near', 'far'],
                    correct: 1,
                    correctWord: 'below',
                    explanation: 'La barra está por debajo del punto - "below"'
                },
                {
                    question: '¿Dónde están las estrellas?',
                    description: 'Las estrellas están _____ del corazón',
                    objects: [
                        { type: 'heart', icon: '♥', x: 50, y: 50, style: 'object-2' },
                        { type: 'star1', icon: '★', x: 25, y: 50, style: 'object-1' },
                        { type: 'star2', icon: '★', x: 75, y: 50, style: 'object-1' }
                    ],
                    options: ['beside', 'around', 'inside', 'between'],
                    correct: 1,
                    correctWord: 'around',
                    explanation: 'Las estrellas están alrededor del corazón - "around"'
                }
            ];

            function loadQuestion() {
                const scenario = scenarios[currentQuestion];
                $('#question').text(scenario.question);
                $('#scene-description').text(scenario.description);
                $('#question-counter').text(currentQuestion + 1);
                
                // Clear previous content
                $('#objects-container').empty();
                $('#line-svg').empty();
                
                // Add SVG
                const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
                svg.setAttribute('class', 'line-svg');
                svg.setAttribute('viewBox', '0 0 100 100');
                $('#objects-container').append(svg);
                
                // Position objects
                scenario.objects.forEach((obj, index) => {
                    const objElement = $(`
                        <div class="object ${obj.style}" style="left: ${obj.x}%; top: ${obj.y}%;">
                            ${obj.icon}
                        </div>
                    `);
                    $('#objects-container').append(objElement);
                });
                
                // Draw connecting lines if needed
                if (scenario.objects.length === 2) {
                    drawLine(scenario.objects[0], scenario.objects[1]);
                }
                
                // Load options
                const optionsContainer = $('#options-container');
                optionsContainer.empty();
                
                scenario.options.forEach((option, index) => {
                    const optionElement = $(`
                        <button class="preposition-btn" data-index="${index}">
                            ${option}
                        </button>
                    `);
                    optionsContainer.append(optionElement);
                });
                
                $('#result-section').hide();
            }
            
            function drawLine(obj1, obj2) {
                const svg = $('.line-svg')[0];
                const line = document.createElementNS('http://www.w3.org/2000/svg', 'line');
                
                line.setAttribute('x1', obj1.x);
                line.setAttribute('y1', obj1.y);
                line.setAttribute('x2', obj2.x);
                line.setAttribute('y2', obj2.y);
                line.setAttribute('stroke', '#E0E6ED');
                line.setAttribute('stroke-width', '1');
                line.setAttribute('stroke-dasharray', '2,2');
                
                svg.appendChild(line);
            }

            function handleAnswer(selectedIndex) {
                const scenario = scenarios[currentQuestion];
                const isCorrect = selectedIndex === scenario.correct;
                
                $('.preposition-btn').off('click');
                $('.preposition-btn').each(function(index) {
                    if (index === scenario.correct) {
                        $(this).addClass('correct');
                    } else if (index === selectedIndex && !isCorrect) {
                        $(this).addClass('incorrect');
                    }
                });
                
                if (isCorrect) {
                    correctAnswers++;
                    score += 10;
                    wordsLearned.add(scenario.correctWord);
                    $('#score').text(score);
                    englishTrainer.showNotification('¡Correcto! +10 puntos', 'success');
                } else {
                    englishTrainer.showNotification(`Incorrecto. La respuesta correcta era: ${scenario.options[scenario.correct]}`, 'error');
                }
                
                $('#explanation').text(scenario.explanation);
                $('#result-section').show();
            }

            function nextQuestion() {
                currentQuestion++;
                
                if (currentQuestion >= scenarios.length) {
                    showResults();
                } else {
                    loadQuestion();
                }
            }

            function showResults() {
                const percentage = (correctAnswers / scenarios.length) * 100;
                
                // Update progress
                englishTrainer.updateGameProgress(8, {
                    wordsLearned: wordsLearned.size,
                    score: score,
                    pointsGained: score
                });
                
                const resultsContainer = $('.game-container');
                resultsContainer.html(`
                    <div class="theory-container">
                        <div class="theory-content text-center">
                            <h2>¡Juego Completado!</h2>
                            <div class="score-display" style="font-size: 1.5rem; margin: 1rem 0;">
                                ${score} puntos
                            </div>
                            <p>Respuestas correctas: ${correctAnswers}/${scenarios.length}</p>
                            <p>Preposiciones aprendidas: ${wordsLearned.size}</p>
                            <p>Porcentaje: ${percentage.toFixed(1)}%</p>
                            ${percentage >= 70 ? '<p style="color: #2ECC71; font-weight: 600;">¡Has completado el juego!</p>' : '<p>Sigue practicando para mejorar tu puntuación.</p>'}
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
            $(document).on('click', '.preposition-btn', function() {
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