<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palabras Básicas - English Trainer</title>
    <link rel="stylesheet" href="../css/games.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Specific styles for vocabulary game */
        .word-display {
            text-align: center;
            margin-bottom: var(--space-lg);
            padding: var(--space-xl);
            background: var(--purple-pastel);
            border-radius: var(--radius-soft);
            border: 3px solid var(--bg-space);
            box-shadow: var(--shadow-subtle);
        }
        
        .word-category {
            font-size: var(--font-size-sm);
            color: var(--bg-space);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: var(--space-xs);
            background: var(--green-pastel);
            display: inline-block;
            padding: var(--space-xs) var(--space-sm);
            border-radius: var(--radius-small);
        }
        
        .english-word {
            font-size: var(--font-size-4xl);
            font-weight: 800;
            color: var(--bg-space);
            margin-bottom: var(--space-md);
            text-shadow: 0 2px 10px rgba(196, 132, 252, 0.3);
            letter-spacing: -0.5px;
        }
        
        /* Responsive grid for 4 columns */
        .options-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: var(--space-md);
            margin-bottom: var(--space-lg);
        }
        
        .option-button {
            padding: var(--space-md) var(--space-lg);
            background: white;
            border: 3px solid var(--bg-space);
            border-radius: var(--radius-soft);
            color: var(--bg-space);
            font-size: var(--font-size-lg);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            box-shadow: var(--shadow-subtle);
            position: relative;
            overflow: hidden;
            min-height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .option-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s;
        }
        
        .option-button:hover::before {
            left: 100%;
        }
        
        .option-button:hover {
            transform: translateY(-2px);
            background: var(--purple-pastel);
            box-shadow: var(--shadow-soft);
        }
        
        .progress-section {
            margin-bottom: var(--space-lg);
        }
        
        .progress-bar {
            width: 100%;
            height: 20px;
            background: var(--lavender-pastel);
            border: 3px solid var(--bg-space);
            border-radius: var(--radius-soft);
            overflow: hidden;
            margin-bottom: var(--space-md);
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--green-bright), var(--blue-bright));
            border-radius: var(--radius-soft);
            transition: width 0.5s ease;
            position: relative;
        }
        
        .progress-fill::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shimmer 2s infinite;
        }
        
        @keyframes shimmer {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(100%); }
        }
        
        /* Timer styles */
        .timer-container {
            position: fixed;
            top: 20px;
            right: 20px;
            background: rgba(26, 26, 46, 0.9);
            border: 3px solid var(--purple-bright);
            border-radius: var(--radius-soft);
            padding: var(--space-sm) var(--space-md);
            color: white;
            font-weight: 700;
            font-size: var(--font-size-lg);
            z-index: 1000;
            display: flex;
            align-items: center;
            gap: var(--space-xs);
            backdrop-filter: blur(10px);
            box-shadow: var(--shadow-soft);
        }
        
        .timer-icon {
            color: var(--purple-bright);
        }
        
        .timer-bar {
            width: 100px;
            height: 6px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
            overflow: hidden;
            margin-left: var(--space-sm);
        }
        
        .timer-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--green-bright), var(--yellow-pastel), var(--red-bright));
            border-radius: 3px;
            transition: width 0.1s linear;
        }
        
        /* Fade animations */
        .fade-out {
            opacity: 0;
            transform: scale(0.95);
            transition: all 0.4s ease;
        }
        
        .fade-in {
            opacity: 1;
            transform: scale(1);
            transition: all 0.4s ease;
        }
        
        @media (max-width: 768px) {
            .english-word {
                font-size: var(--font-size-3xl);
            }
            
            .options-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .timer-container {
                top: 10px;
                right: 10px;
                font-size: var(--font-size-base);
            }
            
            .timer-bar {
                width: 60px;
            }
        }
    </style>
</head>
<body>
    <div class="game-container">
        <button class="back-button" onclick="goHome()">
            <i class="fas fa-arrow-left"></i> Volver
        </button>
        
        <!-- Timer -->
        <div class="timer-container" id="timer-container">
            <i class="fas fa-clock timer-icon"></i>
            <span id="timer-display">12</span>
            <div class="timer-bar">
                <div class="timer-fill" id="timer-fill"></div>
            </div>
        </div>
        
        <div class="game-header">
            <h1>Palabras Básicas</h1>
            <p>Aprende 40 palabras esenciales del inglés organizadas por categorías</p>
        </div>
        
        <div class="progress-section">
            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-fill" id="progress-fill"></div>
            </div>
            <span class="sr-only">Progreso: <span id="progress-text">0</span> de 40 palabras</span>
        </div>
        
        <div class="game-stats">
            <div class="stat-item">
                <div class="score-label">Puntos</div>
                <div class="score-value" id="current-score">0</div>
            </div>
            <div class="stat-item">
                <div class="score-label">Palabra</div>
                <div class="score-value" id="current-word">1</div>
            </div>
            <div class="stat-item">
                <div class="score-label">Correctas</div>
                <div class="score-value" id="correct-answers">0</div>
            </div>
        </div>
        
        <div class="word-display" id="word-display">
            <div class="word-category" id="word-category"></div>
            <div class="english-word" id="english-word"></div>
        </div>
        
        <div class="options-grid" id="options-grid">
            <!-- Options will be generated here -->
        </div>
        
        <div class="game-controls">
            <button class="next-button control-button" id="next-button" onclick="nextWord()" style="display: none;">
                Siguiente <i class="fas fa-arrow-right"></i>
            </button>
        </div>
    </div>
    
    <div class="results-panel" id="results-panel">
        <h2>¡Juego Completado!</h2>
        <div class="stars-display" id="stars-display"></div>
        <p>Puntuación Final: <span id="final-score">0</span></p>
        <p>Palabras Correctas: <span id="final-correct">0</span>/40</p>
        <div class="game-controls">
            <button class="control-button" onclick="restartGame()">
                <i class="fas fa-redo"></i> Jugar de Nuevo
            </button>
            <button class="control-button" onclick="goToMenu()" style="background: var(--purple-bright); color: white;">
                <i class="fas fa-home"></i> Volver al Menú
            </button>
            <button class="control-button" onclick="continueToNextLevel(1)">
                <i class="fas fa-arrow-right"></i> Siguiente Nivel
            </button>
        </div>
    </div>

    <script src="../js/games.js"></script>
    <script>
        // Vocabulary data organized by categories - 40 words
        const vocabulary = [
            // HOGAR Y FAMILIA (8 palabras)
            { 
                english: 'Kitchen', 
                spanish: 'Cocina', 
                category: 'Hogar y Familia'
            },
            { 
                english: 'Bedroom', 
                spanish: 'Dormitorio', 
                category: 'Hogar y Familia'
            },
            { 
                english: 'Bathroom', 
                spanish: 'Baño', 
                category: 'Hogar y Familia'
            },
            { 
                english: 'Mother', 
                spanish: 'Madre', 
                category: 'Hogar y Familia'
            },
            { 
                english: 'Father', 
                spanish: 'Padre', 
                category: 'Hogar y Familia'
            },
            { 
                english: 'Brother', 
                spanish: 'Hermano', 
                category: 'Hogar y Familia'
            },
            { 
                english: 'Sister', 
                spanish: 'Hermana', 
                category: 'Hogar y Familia'
            },
            { 
                english: 'Window', 
                spanish: 'Ventana', 
                category: 'Hogar y Familia'
            },

            // COMIDA Y COCINA (8 palabras)
            { 
                english: 'Breakfast', 
                spanish: 'Desayuno', 
                category: 'Comida y Cocina'
            },
            { 
                english: 'Dinner', 
                spanish: 'Cena', 
                category: 'Comida y Cocina'
            },
            { 
                english: 'Vegetables', 
                spanish: 'Verduras', 
                category: 'Comida y Cocina'
            },
            { 
                english: 'Fruit', 
                spanish: 'Fruta', 
                category: 'Comida y Cocina'
            },
            { 
                english: 'Chicken', 
                spanish: 'Pollo', 
                category: 'Comida y Cocina'
            },
            { 
                english: 'Bread', 
                spanish: 'Pan', 
                category: 'Comida y Cocina'
            },
            { 
                english: 'Coffee', 
                spanish: 'Café', 
                category: 'Comida y Cocina'
            },
            { 
                english: 'Milk', 
                spanish: 'Leche', 
                category: 'Comida y Cocina'
            },

            // OFICINA Y TRABAJO (8 palabras)
            { 
                english: 'Office', 
                spanish: 'Oficina', 
                category: 'Oficina y Trabajo'
            },
            { 
                english: 'Computer', 
                spanish: 'Computadora', 
                category: 'Oficina y Trabajo'
            },
            { 
                english: 'Meeting', 
                spanish: 'Reunión', 
                category: 'Oficina y Trabajo'
            },
            { 
                english: 'Project', 
                spanish: 'Proyecto', 
                category: 'Oficina y Trabajo'
            },
            { 
                english: 'Manager', 
                spanish: 'Gerente', 
                category: 'Oficina y Trabajo'
            },
            { 
                english: 'Document', 
                spanish: 'Documento', 
                category: 'Oficina y Trabajo'
            },
            { 
                english: 'Schedule', 
                spanish: 'Horario', 
                category: 'Oficina y Trabajo'
            },
            { 
                english: 'Email', 
                spanish: 'Correo', 
                category: 'Oficina y Trabajo'
            },

            // ESCUELA Y EDUCACIÓN (8 palabras)
            { 
                english: 'Teacher', 
                spanish: 'Profesor', 
                category: 'Escuela y Educación'
            },
            { 
                english: 'Student', 
                spanish: 'Estudiante', 
                category: 'Escuela y Educación'
            },
            { 
                english: 'Lesson', 
                spanish: 'Lección', 
                category: 'Escuela y Educación'
            },
            { 
                english: 'Homework', 
                spanish: 'Tarea', 
                category: 'Escuela y Educación'
            },
            { 
                english: 'Classroom', 
                spanish: 'Aula', 
                category: 'Escuela y Educación'
            },
            { 
                english: 'Notebook', 
                spanish: 'Cuaderno', 
                category: 'Escuela y Educación'
            },
            { 
                english: 'Library', 
                spanish: 'Biblioteca', 
                category: 'Escuela y Educación'
            },
            { 
                english: 'Exam', 
                spanish: 'Examen', 
                category: 'Escuela y Educación'
            },

            // CIUDAD Y CALLE (8 palabras)
            { 
                english: 'Street', 
                spanish: 'Calle', 
                category: 'Ciudad y Calle'
            },
            { 
                english: 'Building', 
                spanish: 'Edificio', 
                category: 'Ciudad y Calle'
            },
            { 
                english: 'Restaurant', 
                spanish: 'Restaurante', 
                category: 'Ciudad y Calle'
            },
            { 
                english: 'Hospital', 
                spanish: 'Hospital', 
                category: 'Ciudad y Calle'
            },
            { 
                english: 'Bank', 
                spanish: 'Banco', 
                category: 'Ciudad y Calle'
            },
            { 
                english: 'Store', 
                spanish: 'Tienda', 
                category: 'Ciudad y Calle'
            },
            { 
                english: 'Market', 
                spanish: 'Mercado', 
                category: 'Ciudad y Calle'
            },
            { 
                english: 'Traffic', 
                spanish: 'Tráfico', 
                category: 'Ciudad y Calle'
            }
        ];

        // Game state
        let currentWord = 0;
        let score = 0;
        let correctAnswers = 0;
        let gameCompleted = false;
        let timeLeft = 12;
        let gameTimer = null;
        let isAnswering = false;
        let isTransitioning = false;

        // Timer functions
        function startTimer() {
            timeLeft = 12;
            if (gameTimer) clearInterval(gameTimer);
            
            gameTimer = setInterval(() => {
                timeLeft--;
                updateTimerDisplay();
                
                if (timeLeft <= 0) {
                    clearInterval(gameTimer);
                    if (!isAnswering && !isTransitioning) {
                        handleTimeOut();
                    }
                }
            }, 1000);
            
            updateTimerDisplay();
        }
        
        function stopTimer() {
            if (gameTimer) {
                clearInterval(gameTimer);
                gameTimer = null;
            }
        }
        
        function updateTimerDisplay() {
            document.getElementById('timer-display').textContent = timeLeft;
            const fill = document.getElementById('timer-fill');
            const percentage = (timeLeft / 12) * 100;
            fill.style.width = percentage + '%';
            
            // Change color based on time left
            if (timeLeft <= 3) {
                fill.style.background = 'var(--red-bright)';
            } else if (timeLeft <= 6) {
                fill.style.background = 'linear-gradient(90deg, var(--yellow-pastel), var(--red-bright))';
            } else {
                fill.style.background = 'linear-gradient(90deg, var(--green-bright), var(--yellow-pastel), var(--red-bright))';
            }
        }
        
        function handleTimeOut() {
            isAnswering = true;
            
            // Mark all buttons as disabled and show correct answer
            const buttons = document.querySelectorAll('.option-button');
            const correctSpanish = vocabulary[currentWord].spanish;
            
            buttons.forEach(button => {
                button.disabled = true;
                if (button.textContent === correctSpanish) {
                    button.classList.add('correct');
                }
            });
            
            score = Math.max(0, score - 5);
            showNotification('¡Tiempo agotado! La respuesta era: ' + correctSpanish, 'error');
            
            // Auto proceed after showing result
            setTimeout(() => {
                nextWordAuto();
            }, 2000);
            
            updateDisplay();
        }

        // Initialize game
        function initGame() {
            currentWord = 0;
            score = 0;
            correctAnswers = 0;
            gameCompleted = false;
            isAnswering = false;
            isTransitioning = false;
            stopTimer();
            updateDisplay();
            showWord();
        }

        // Show current word with animation
        function showWord() {
            if (currentWord >= vocabulary.length) {
                endGame();
                return;
            }
            
            isTransitioning = true;
            stopTimer();
            
            const word = vocabulary[currentWord];
            const wordDisplay = document.getElementById('word-display');
            const optionsGrid = document.getElementById('options-grid');
            
            // Fade out current content
            wordDisplay.classList.add('fade-out');
            optionsGrid.classList.add('fade-out');
            
            setTimeout(() => {
                // Update content
                document.getElementById('word-category').textContent = word.category;
                document.getElementById('english-word').textContent = word.english;
                
                generateOptions();
                
                // Fade in new content
                wordDisplay.classList.remove('fade-out');
                wordDisplay.classList.add('fade-in');
                optionsGrid.classList.remove('fade-out');
                optionsGrid.classList.add('fade-in');
                
                setTimeout(() => {
                    wordDisplay.classList.remove('fade-in');
                    optionsGrid.classList.remove('fade-in');
                    isTransitioning = false;
                    isAnswering = false;
                    
                    // Start timer after transition
                    startTimer();
                }, 400);
                
                updateDisplay();
            }, 400);
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
            const currentOptions = shuffleArray([...incorrectAnswers, correctAnswer]);
            
            // Create option buttons
            const optionsGrid = document.getElementById('options-grid');
            optionsGrid.innerHTML = '';
            
            currentOptions.forEach(option => {
                const button = document.createElement('button');
                button.className = 'option-button';
                button.textContent = option;
                button.dataset.answer = option;
                button.onclick = () => selectAnswer(option);
                optionsGrid.appendChild(button);
            });
        }

        // Handle answer selection
        function selectAnswer(selectedAnswer) {
            if (isAnswering || isTransitioning) return;
            
            isAnswering = true;
            stopTimer();
            
            const correctAnswer = vocabulary[currentWord].spanish;
            const isCorrect = selectedAnswer === correctAnswer;
            
            // Disable all buttons
            document.querySelectorAll('.option-button').forEach(button => {
                button.disabled = true;
                const buttonAnswer = button.dataset.answer;
                if (buttonAnswer === correctAnswer) {
                    button.classList.add('correct');
                    if (isCorrect) {
                        pulseElement(button, 'var(--green-bright)');
                    }
                } else if (buttonAnswer === selectedAnswer && !isCorrect) {
                    button.classList.add('incorrect');
                    animateElement(button, 'translateX(-5px)');
                }
            });
            
            // Update score
            if (isCorrect) {
                correctAnswers++;
                score += 10;
                showNotification('¡Correcto!', 'success');
                
                // Auto proceed for correct answers
                setTimeout(() => {
                    nextWordAuto();
                }, 1500);
            } else {
                showNotification('Incorrecto. La respuesta es: ' + correctAnswer, 'error');
                
                // Auto proceed after showing result
                setTimeout(() => {
                    nextWordAuto();
                }, 2500);
            }
            
            updateDisplay();
        }

        // Next word automatically (no button needed)
        function nextWordAuto() {
            currentWord++;
            showWord();
        }
        
        // Next word
        function nextWord() {
            nextWordAuto();
        }

        // Update display
        function updateDisplay() {
            document.getElementById('current-score').textContent = score;
            document.getElementById('current-word').textContent = currentWord + 1;
            document.getElementById('correct-answers').textContent = correctAnswers;
            
            const progress = ((currentWord) / vocabulary.length) * 100;
            document.getElementById('progress-fill').style.width = progress + '%';
            document.querySelector('[role="progressbar"]').setAttribute('aria-valuenow', progress);
        }

        // End game
        function endGame() {
            gameCompleted = true;
            stopTimer();
            
            // Calculate stars
            const percentage = (correctAnswers / vocabulary.length) * 100;
            let stars = calculateStars(score, vocabulary.length * 10);
            
            // Update results
            document.getElementById('final-score').textContent = score;
            document.getElementById('final-correct').textContent = correctAnswers;
            
            // Create stars display
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
            handleLevelCompletion(1, score, stars);
            
            showNotification('¡Juego completado!', 'success');
        }

        // Restart game
        function restartGame() {
            document.getElementById('results-panel').classList.remove('visible');
            stopTimer();
            initGame();
        }

        // Initialize game on load
        document.addEventListener('DOMContentLoaded', () => {
            initGame();
        });
    </script>
</body>
</html>
