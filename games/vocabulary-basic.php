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
        
        .pronunciation {
            background: var(--blue-pastel);
            border: 3px solid var(--bg-space);
            border-radius: var(--radius-soft);
            padding: var(--space-md);
            max-width: 500px;
            margin: 0 auto;
            color: var(--bg-space);
        }
        
        .pronunciation-label {
            font-size: var(--font-size-sm);
            font-weight: 600;
            margin-bottom: var(--space-xs);
        }
        
        .pronunciation-phonetic {
            font-family: var(--font-mono);
            font-size: var(--font-size-xl);
            color: var(--purple-bright);
            margin: var(--space-xs) 0;
            font-weight: 500;
        }
        
        .pronunciation-guide {
            font-size: var(--font-size-base);
            color: rgba(26, 26, 46, 0.8);
            font-style: italic;
        }
        
        .options-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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
        
        @media (max-width: 768px) {
            .english-word {
                font-size: var(--font-size-3xl);
            }
            
            .options-grid {
                grid-template-columns: 1fr;
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
        
        <div class="word-display">
            <div class="word-category" id="word-category"></div>
            <div class="english-word" id="english-word"></div>
            <div class="pronunciation">
                <div class="pronunciation-label">Pronunciación:</div>
                <div class="pronunciation-phonetic" id="pronunciation-phonetic"></div>
                <div class="pronunciation-guide" id="pronunciation-guide"></div>
            </div>
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
                phonetic: '/ˈkɪtʃən/', 
                guide: 'KÍCH-en',
                category: 'Hogar y Familia'
            },
            { 
                english: 'Bedroom', 
                spanish: 'Dormitorio', 
                phonetic: '/ˈbedrʊm/', 
                guide: 'BED-rum',
                category: 'Hogar y Familia'
            },
            { 
                english: 'Bathroom', 
                spanish: 'Baño', 
                phonetic: '/ˈbæθrʊm/', 
                guide: 'BAZ-rum',
                category: 'Hogar y Familia'
            },
            { 
                english: 'Mother', 
                spanish: 'Madre', 
                phonetic: '/ˈmʌðər/', 
                guide: 'MÁ-der',
                category: 'Hogar y Familia'
            },
            { 
                english: 'Father', 
                spanish: 'Padre', 
                phonetic: '/ˈfɑːðər/', 
                guide: 'FÁ-der',
                category: 'Hogar y Familia'
            },
            { 
                english: 'Brother', 
                spanish: 'Hermano', 
                phonetic: '/ˈbrʌðər/', 
                guide: 'BRÁ-der',
                category: 'Hogar y Familia'
            },
            { 
                english: 'Sister', 
                spanish: 'Hermana', 
                phonetic: '/ˈsɪstər/', 
                guide: 'SÍS-ter',
                category: 'Hogar y Familia'
            },
            { 
                english: 'Window', 
                spanish: 'Ventana', 
                phonetic: '/ˈwɪndoʊ/', 
                guide: 'UÍN-do',
                category: 'Hogar y Familia'
            },

            // COMIDA Y COCINA (8 palabras)
            { 
                english: 'Breakfast', 
                spanish: 'Desayuno', 
                phonetic: '/ˈbrekfəst/', 
                guide: 'BREK-fast',
                category: 'Comida y Cocina'
            },
            { 
                english: 'Dinner', 
                spanish: 'Cena', 
                phonetic: '/ˈdɪnər/', 
                guide: 'DÍ-ner',
                category: 'Comida y Cocina'
            },
            { 
                english: 'Vegetables', 
                spanish: 'Verduras', 
                phonetic: '/ˈvedʒtəbəlz/', 
                guide: 'VÉY-ye-ta-bols',
                category: 'Comida y Cocina'
            },
            { 
                english: 'Fruit', 
                spanish: 'Fruta', 
                phonetic: '/fruːt/', 
                guide: 'FRUT',
                category: 'Comida y Cocina'
            },
            { 
                english: 'Chicken', 
                spanish: 'Pollo', 
                phonetic: '/ˈtʃɪkən/', 
                guide: 'CHÍK-en',
                category: 'Comida y Cocina'
            },
            { 
                english: 'Bread', 
                spanish: 'Pan', 
                phonetic: '/bred/', 
                guide: 'BRED',
                category: 'Comida y Cocina'
            },
            { 
                english: 'Coffee', 
                spanish: 'Café', 
                phonetic: '/ˈkɔːfi/', 
                guide: 'KÓ-fi',
                category: 'Comida y Cocina'
            },
            { 
                english: 'Milk', 
                spanish: 'Leche', 
                phonetic: '/mɪlk/', 
                guide: 'MILK',
                category: 'Comida y Cocina'
            },

            // OFICINA Y TRABAJO (8 palabras)
            { 
                english: 'Office', 
                spanish: 'Oficina', 
                phonetic: '/ˈɔːfɪs/', 
                guide: 'Ó-fis',
                category: 'Oficina y Trabajo'
            },
            { 
                english: 'Computer', 
                spanish: 'Computadora', 
                phonetic: '/kəmˈpjuːtər/', 
                guide: 'kom-PYU-ter',
                category: 'Oficina y Trabajo'
            },
            { 
                english: 'Meeting', 
                spanish: 'Reunión', 
                phonetic: '/ˈmiːtɪŋ/', 
                guide: 'MÍ-ting',
                category: 'Oficina y Trabajo'
            },
            { 
                english: 'Project', 
                spanish: 'Proyecto', 
                phonetic: '/ˈprɑːdʒekt/', 
                guide: 'PRÓ-yekt',
                category: 'Oficina y Trabajo'
            },
            { 
                english: 'Manager', 
                spanish: 'Gerente', 
                phonetic: '/ˈmænɪdʒər/', 
                guide: 'MÁ-ni-yer',
                category: 'Oficina y Trabajo'
            },
            { 
                english: 'Document', 
                spanish: 'Documento', 
                phonetic: '/ˈdɑːkjəmənt/', 
                guide: 'DÓK-yu-ment',
                category: 'Oficina y Trabajo'
            },
            { 
                english: 'Schedule', 
                spanish: 'Horario', 
                phonetic: '/ˈskedʒuːl/', 
                guide: 'SKÉ-yul',
                category: 'Oficina y Trabajo'
            },
            { 
                english: 'Email', 
                spanish: 'Correo', 
                phonetic: '/ˈiːmeɪl/', 
                guide: 'Í-meil',
                category: 'Oficina y Trabajo'
            },

            // ESCUELA Y EDUCACIÓN (8 palabras)
            { 
                english: 'Teacher', 
                spanish: 'Profesor', 
                phonetic: '/ˈtiːtʃər/', 
                guide: 'TÍ-cher',
                category: 'Escuela y Educación'
            },
            { 
                english: 'Student', 
                spanish: 'Estudiante', 
                phonetic: '/ˈstuːdənt/', 
                guide: 'STU-dent',
                category: 'Escuela y Educación'
            },
            { 
                english: 'Lesson', 
                spanish: 'Lección', 
                phonetic: '/ˈlesən/', 
                guide: 'LÉ-son',
                category: 'Escuela y Educación'
            },
            { 
                english: 'Homework', 
                spanish: 'Tarea', 
                phonetic: '/ˈhoʊmwɜːrk/', 
                guide: 'JOM-wörk',
                category: 'Escuela y Educación'
            },
            { 
                english: 'Classroom', 
                spanish: 'Aula', 
                phonetic: '/ˈklæsrʊm/', 
                guide: 'KLAS-rum',
                category: 'Escuela y Educación'
            },
            { 
                english: 'Notebook', 
                spanish: 'Cuaderno', 
                phonetic: '/ˈnoʊtbʊk/', 
                guide: 'NOT-buk',
                category: 'Escuela y Educación'
            },
            { 
                english: 'Library', 
                spanish: 'Biblioteca', 
                phonetic: '/ˈlaɪbreri/', 
                guide: 'LÁI-bre-ri',
                category: 'Escuela y Educación'
            },
            { 
                english: 'Exam', 
                spanish: 'Examen', 
                phonetic: '/ɪɡˈzæm/', 
                guide: 'ig-ZAM',
                category: 'Escuela y Educación'
            },

            // CIUDAD Y CALLE (8 palabras)
            { 
                english: 'Street', 
                spanish: 'Calle', 
                phonetic: '/striːt/', 
                guide: 'STRIT',
                category: 'Ciudad y Calle'
            },
            { 
                english: 'Building', 
                spanish: 'Edificio', 
                phonetic: '/ˈbɪldɪŋ/', 
                guide: 'BÍL-ding',
                category: 'Ciudad y Calle'
            },
            { 
                english: 'Restaurant', 
                spanish: 'Restaurante', 
                phonetic: '/ˈrestərɑːnt/', 
                guide: 'RÉS-to-rant',
                category: 'Ciudad y Calle'
            },
            { 
                english: 'Hospital', 
                spanish: 'Hospital', 
                phonetic: '/ˈhɑːspɪtl/', 
                guide: 'JÓS-pi-tal',
                category: 'Ciudad y Calle'
            },
            { 
                english: 'Bank', 
                spanish: 'Banco', 
                phonetic: '/bæŋk/', 
                guide: 'BANK',
                category: 'Ciudad y Calle'
            },
            { 
                english: 'Store', 
                spanish: 'Tienda', 
                phonetic: '/stɔːr/', 
                guide: 'STOR',
                category: 'Ciudad y Calle'
            },
            { 
                english: 'Market', 
                spanish: 'Mercado', 
                phonetic: '/ˈmɑːrkɪt/', 
                guide: 'MÁR-kit',
                category: 'Ciudad y Calle'
            },
            { 
                english: 'Traffic', 
                spanish: 'Tráfico', 
                phonetic: '/ˈtræfɪk/', 
                guide: 'TRÁ-fik',
                category: 'Ciudad y Calle'
            }
        ];

        // Game state
        let currentWord = 0;
        let score = 0;
        let correctAnswers = 0;
        let gameCompleted = false;

        // Initialize game
        function initGame() {
            currentWord = 0;
            score = 0;
            correctAnswers = 0;
            gameCompleted = false;
            updateDisplay();
            showWord();
        }

        // Show current word
        function showWord() {
            if (currentWord >= vocabulary.length) {
                endGame();
                return;
            }

            const word = vocabulary[currentWord];
            document.getElementById('word-category').textContent = word.category;
            document.getElementById('english-word').textContent = word.english;
            document.getElementById('pronunciation-phonetic').textContent = word.phonetic;
            document.getElementById('pronunciation-guide').textContent = word.guide;
            
            generateOptions();
            updateDisplay();
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
            } else {
                showNotification('Incorrecto. La respuesta es: ' + correctAnswer, 'error');
            }
            
            // Show next button
            setTimeout(() => {
                document.getElementById('next-button').style.display = 'inline-flex';
            }, 1000);
        }

        // Next word
        function nextWord() {
            currentWord++;
            document.getElementById('next-button').style.display = 'none';
            showWord();
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
            initGame();
        }

        // Initialize game on load
        document.addEventListener('DOMContentLoaded', () => {
            initGame();
        });
    </script>
</body>
</html>