<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palabras Básicas - English Trainer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Cambio de fuente por una más atractiva: Nunito con respaldo a Inter -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&family=Poppins:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap">
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            /* Pastel colors for accessibility */
            --primary-bg: #0a0a0a;
            --secondary-bg: #1a1a2e;
            --accent-purple: #9c88ff;
            --accent-blue: #6eb5ff;
            --accent-pink: #ff9a9e;
            --accent-green: #a8e6cf;
            --text-primary: #ffffff;
            --text-secondary: #e0e6ed;
            --text-muted: #9ca3af;
            --success: #64f58d;
            --warning: #ffad5a;
            --error: #ff6b6b;
            --card-bg: rgba(26, 26, 46, 0.8);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --border-color: rgba(156, 136, 255, 0.3);
        }

        body {
            /* Cambio de fuente principal a Nunito */
            font-family: 'Nunito', 'Poppins', sans-serif;
            background: var(--primary-bg);
            color: var(--text-primary);
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Space background with stars */
        .space-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 20% 50%, rgba(156, 136, 255, 0.1) 0%, transparent 50%),
                        radial-gradient(circle at 80% 50%, rgba(110, 181, 255, 0.1) 0%, transparent 50%),
                        radial-gradient(circle at 40% 80%, rgba(255, 154, 158, 0.1) 0%, transparent 50%);
            z-index: 0;
        }

        .stars {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(2px 2px at 20% 20%, white, transparent),
                radial-gradient(2px 2px at 40% 70%, white, transparent),
                radial-gradient(1px 1px at 60% 10%, white, transparent),
                radial-gradient(1px 1px at 90% 40%, white, transparent),
                radial-gradient(2px 2px at 10% 90%, white, transparent),
                radial-gradient(1px 1px at 80% 90%, white, transparent);
            background-repeat: no-repeat;
            background-size: 200px 200px, 300px 300px, 250px 250px, 150px 150px, 400px 400px, 180px 180px;
            opacity: 0.3;
            animation: twinkle 10s linear infinite;
            z-index: 1;
        }

        @keyframes twinkle {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.8; }
        }

        /* Main container */
        .game-container {
            position: relative;
            z-index: 10;
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem;
            min-height: 100vh;
        }

        /* Header */
        .game-header {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .back-button {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            color: var(--text-primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .back-button:hover {
            background: var(--accent-purple);
            color: white;
            transform: translateY(-2px);
        }

        .header-title {
            text-align: center;
            flex-grow: 1;
        }

        .header-title h1 {
            font-size: 1.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue));
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .header-title p {
            color: var(--text-muted);
            margin-top: 0.5rem;
        }

        /* Progress section */
        .progress-section {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .progress-bar {
            width: 100%;
            height: 12px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 1rem;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, var(--accent-green), var(--accent-blue));
            border-radius: 10px;
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

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 1rem;
        }

        .stat-card {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 1rem;
            text-align: center;
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .stat-label {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-top: 0.25rem;
        }

        /* Word display area */
        .word-display {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 2rem;
            text-align: center;
            min-height: 280px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .english-word {
            /* Mejorar la tipografía de la palabra en inglés */
            font-family: 'Poppins', 'Nunito', sans-serif;
            font-size: 3rem;
            font-weight: 800;
            color: var(--text-primary);
            margin-bottom: 1rem;
            text-shadow: 0 2px 10px rgba(156, 136, 255, 0.3);
            letter-spacing: -0.5px;
        }

        /* Categoría de la palabra */
        .word-category {
            font-family: 'Nunito', sans-serif;
            font-size: 0.875rem;
            color: var(--accent-green);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
        }

        /* Nueva pronunciación mejorada para hispanohablantes */
        .pronunciation {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin: 1rem auto;
            max-width: 500px;
            font-family: 'Nunito', sans-serif;
            font-size: 1.1rem;
            color: var(--text-primary);
        }

        .pronunciation-label {
            font-size: 0.875rem;
            color: var(--accent-blue);
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .pronunciation-phonetic {
            font-family: 'JetBrains Mono', monospace;
            font-size: 1.25rem;
            color: var(--accent-purple);
            margin: 0.5rem 0;
        }

        .pronunciation-guide {
            font-size: 0.95rem;
            color: var(--text-secondary);
            font-style: italic;
        }

        /* Options grid */
        .options-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .option-button {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 1rem 1.5rem;
            color: var(--text-primary);
            font-size: 1.1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
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
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .option-button:hover::before {
            left: 100%;
        }

        .option-button:hover {
            border-color: var(--accent-purple);
            background: rgba(156, 136, 255, 0.1);
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(156, 136, 255, 0.2);
        }

        .option-button:disabled {
            cursor: not-allowed;
            opacity: 0.7;
        }

        .option-button.correct {
            background: linear-gradient(135deg, var(--success), var(--accent-green));
            border-color: var(--success);
            color: white;
            font-weight: 600;
        }

        .option-button.incorrect {
            background: linear-gradient(135deg, var(--error), var(--accent-pink));
            border-color: var(--error);
            color: white;
            animation: shake 0.5s;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        /* Controls */
        .game-controls {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .control-button {
            background: linear-gradient(135deg, var(--accent-purple), var(--accent-blue));
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .control-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(156, 136, 255, 0.3);
        }

        .control-button:active {
            transform: translateY(-1px);
        }

        /* Results panel */
        .results-panel {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(10px);
            display: none;
            z-index: 100;
        }

        .results-panel.visible {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .results-content {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 2rem;
            text-align: center;
            max-width: 500px;
            width: 90%;
            transform: scale(0.9);
            animation: popIn 0.3s ease forwards;
        }

        @keyframes popIn {
            to { transform: scale(1); }
        }

        .results-content h2 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .stars-display {
            font-size: 2rem;
            margin: 1rem 0;
        }

        .star {
            color: var(--warning);
            margin: 0 0.25rem;
            animation: starTwinkle 0.5s ease;
        }

        @keyframes starTwinkle {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }

        .results-stats {
            background: var(--glass-bg);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            padding: 1rem;
            margin: 1rem 0;
        }

        .results-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 1.5rem;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .game-container {
                padding: 1rem;
            }

            .header-content {
                flex-direction: column;
                text-align: center;
            }

            .english-word {
                font-size: 2rem;
            }

            .options-grid {
                grid-template-columns: 1fr;
            }

            .stats-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* Accessibility improvements */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        :focus-visible {
            outline: 2px solid var(--accent-purple);
            outline-offset: 2px;
        }

        /* High contrast mode support */
        @media (prefers-contrast: high) {
            :root {
                --primary-bg: #000000;
                --secondary-bg: #1a1a1a;
                --text-primary: #ffffff;
                --border-color: rgba(255, 255, 255, 0.5);
            }
        }

        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            * {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }
    </style>
</head>
<body>
    <div class="space-bg"></div>
    <div class="stars"></div>
    
    <div class="game-container">
        <div class="game-header">
            <div class="header-content">
                <a href="../index.html" class="back-button">
                    <i class="fas fa-arrow-left" aria-hidden="true"></i>
                    <span>Volver</span>
                </a>
                <div class="header-title">
                    <h1>Palabras Básicas</h1>
                    <p>Aprende 40 palabras esenciales del inglés organizadas por categorías</p>
                </div>
            </div>
        </div>
        
        <div class="progress-section">
            <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-fill" id="progress-fill"></div>
            </div>
            <span class="sr-only">Progreso: <span id="progress-text">0</span> de 40 palabras</span>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value" id="current-score">0</div>
                    <div class="stat-label">Puntos</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value" id="current-word">1</div>
                    <div class="stat-label">Palabra</div>
                </div>
                <div class="stat-card">
                    <div class="stat-value" id="correct-answers">0</div>
                    <div class="stat-label">Correctas</div>
                </div>
            </div>
        </div>
        
        <div class="word-display">
            <div class="word-category" id="word-category"></div>
            <div class="english-word" id="english-word" role="heading" aria-level="2"></div>
            <div class="pronunciation">
                <div class="pronunciation-label">Pronunciación:</div>
                <div class="pronunciation-phonetic" id="pronunciation-phonetic"></div>
                <div class="pronunciation-guide" id="pronunciation-guide"></div>
            </div>
        </div>
        
        <div class="options-grid" id="options-grid" role="group" aria-label="Opciones de respuesta">
            <!-- Options will be generated here -->
        </div>
        
        <div class="game-controls">
            <button class="control-button" id="next-button" onclick="nextWord()" style="display: none;">
                <span>Siguiente</span>
                <i class="fas fa-arrow-right" aria-hidden="true"></i>
            </button>
        </div>
    </div>
    
    <div class="results-panel" id="results-panel" role="dialog" aria-modal="true" aria-labelledby="results-title">
        <div class="results-content">
            <h2 id="results-title">¡Juego Completado!</h2>
            <div class="stars-display" id="stars-display"></div>
            <div class="results-stats">
                <p><strong>Puntuación Final:</strong> <span id="final-score">0</span></p>
                <p><strong>Palabras Correctas:</strong> <span id="final-correct">0</span>/40</p>
            </div>
            <div class="results-actions">
                <button class="control-button" onclick="restartGame()">
                    <i class="fas fa-redo" aria-hidden="true"></i>
                    <span>Jugar de Nuevo</span>
                </button>
                <button class="control-button" onclick="goHome()">
                    <i class="fas fa-home" aria-hidden="true"></i>
                    <span>Menú Principal</span>
                </button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Nuevo vocabulario organizado por categorías con 40 palabras
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
            $('#word-category').text(word.category);
            $('#english-word').text(word.english);
            $('#pronunciation-phonetic').text(word.phonetic);
            $('#pronunciation-guide').text(word.guide);
            
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
            const currentOptions = [...incorrectAnswers, correctAnswer].sort(() => Math.random() - 0.5);
            
            // Create option buttons
            const optionsGrid = $('#options-grid');
            optionsGrid.empty();
            
            currentOptions.forEach((option, index) => {
                const button = $(`<button class="option-button" data-answer="${option}" aria-describedby="word-${currentWord}">
                    ${option}
                </button>`);
                
                button.click(() => selectAnswer(option));
                button.on('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        selectAnswer(option);
                    }
                });
                optionsGrid.append(button);
            });
        }

        // Handle answer selection
        function selectAnswer(selectedAnswer) {
            const correctAnswer = vocabulary[currentWord].spanish;
            const isCorrect = selectedAnswer === correctAnswer;
            
            // Disable all buttons
            $('.option-button').prop('disabled', true);
            
            // Show correct/incorrect feedback
            $('.option-button').each(function() {
                const buttonAnswer = $(this).data('answer');
                if (buttonAnswer === correctAnswer) {
                    $(this).addClass('correct');
                } else if (buttonAnswer === selectedAnswer && !isCorrect) {
                    $(this).addClass('incorrect');
                }
            });
            
            // Update score
            if (isCorrect) {
                correctAnswers++;
                score += 10;
            }
            
            // Announce result for screen readers
            if (isCorrect) {
                $('body').append('<div aria-live="polite" class="sr-only">Respuesta correcta</div>');
            } else {
                $('body').append('<div aria-live="polite" class="sr-only">Respuesta incorrecta. La respuesta correcta es ' + correctAnswer + '</div>');
            }
            
            // Show next button
            setTimeout(() => {
                $('#next-button').show().focus();
            }, 1000);
        }

        // Next word
        function nextWord() {
            currentWord++;
            $('#next-button').hide();
            showWord();
        }

        // Update display
        function updateDisplay() {
            $('#current-score').text(score);
            $('#current-word').text(currentWord + 1);
            $('#correct-answers').text(correctAnswers);
            
            const progress = ((currentWord) / vocabulary.length) * 100;
            $('#progress-fill').css('width', progress + '%');
            $('#progress-fill').closest('[role="progressbar"]').attr('aria-valuenow', progress);
            $('#progress-text').text(currentWord);
        }

        // End game
        function endGame() {
            gameCompleted = true;
            
            // Calculate stars
            const percentage = (correctAnswers / vocabulary.length) * 100;
            let stars = 1;
            if (percentage >= 70) stars = 2;
            if (percentage >= 90) stars = 3;
            
            // Update results
            $('#final-score').text(score);
            $('#final-correct').text(correctAnswers);
            
            // Create stars display
            let starsHtml = '';
            for (let i = 0; i < 3; i++) {
                if (i < stars) {
                    starsHtml += '<i class="fas fa-star star" aria-hidden="true"></i>';
                } else {
                    starsHtml += '<i class="far fa-star" style="color: #444;" aria-hidden="true"></i>';
                }
            }
            $('#stars-display').html(starsHtml);
            
            // Show results panel
            $('#results-panel').addClass('visible');
            $('#results-panel button:first').focus();
            
            // Notify parent window about completion
            if (window.opener && window.opener.onGameComplete) {
                window.opener.onGameComplete(1, score, stars);
            }
        }

        // Restart game
        function restartGame() {
            $('#results-panel').removeClass('visible');
            initGame();
        }

        // Go to home
        function goHome() {
            window.location.href = '../index.html';
        }

        // Initialize game on load
        $(document).ready(() => {
            initGame();
        });

        // Keyboard navigation
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $('#results-panel').hasClass('visible')) {
                $('#results-panel').removeClass('visible');
            }
        });
    </script>
</body>
</html>