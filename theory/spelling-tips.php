<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consejos de Spelling - Teoría</title>
    <link rel="stylesheet" href="../css/theory.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Estilos específicos para spelling */
        .strategy-card {
            background: white;
            border: 3px solid var(--bg-space);
            border-radius: var(--radius-soft);
            padding: var(--space-lg);
            margin-bottom: var(--space-md);
            box-shadow: var(--shadow-subtle);
            color: var(--bg-space);
        }
        
        .strategy-title {
            color: var(--yellow-bright);
            font-size: var(--font-size-xl);
            font-weight: 700;
            margin-bottom: var(--space-md);
            display: flex;
            align-items: center;
            gap: var(--space-sm);
        }
        
        .strategy-content {
            color: var(--bg-space);
            line-height: 1.6;
        }
        
        .word-example {
            background: var(--green-pastel);
            border: 3px solid var(--bg-space);
            border-radius: var(--radius-small);
            padding: var(--space-md);
            margin: var(--space-md) 0;
            color: var(--bg-space);
            box-shadow: var(--shadow-subtle);
        }
        
        .word-example-title {
            color: var(--green-bright);
            font-weight: 700;
            margin-bottom: var(--space-sm);
            font-size: var(--font-size-lg);
        }
        
        .letter-box {
            display: inline-block;
            padding: var(--space-sm);
            margin: 0.2rem;
            background: var(--blue-pastel);
            border-radius: var(--radius-small);
            color: var(--bg-space);
            font-family: var(--font-mono);
            font-size: var(--font-size-xl);
            font-weight: 700;
            border: 3px solid var(--bg-space);
            box-shadow: var(--shadow-subtle);
        }
        
        .pattern-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: var(--space-lg);
            margin-top: var(--space-lg);
        }
        
        .pattern-item {
            background: var(--purple-pastel);
            padding: var(--space-lg);
            border-radius: var(--radius-small);
            border: 3px solid var(--bg-space);
            color: var(--bg-space);
            box-shadow: var(--shadow-subtle);
        }
        
        .pattern-name {
            color: var(--purple-bright);
            font-weight: 700;
            margin-bottom: var(--space-sm);
            font-size: var(--font-size-lg);
        }
        
        /* Letras menos frecuentes en rojo */
        .letter-box.rare {
            background: rgba(220, 38, 38, 0.2);
            color: #dc2626;
            border-color: #dc2626;
        }
        
        @media (max-width: 768px) {
            .letter-box {
                font-size: var(--font-size-lg);
                padding: var(--space-xs);
            }
            
            .pattern-list {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="theory-container">
        <button class="back-button" onclick="goBack()">
            <i class="fas fa-arrow-left"></i> Volver
        </button>
        
        <div class="theory-header">
            <h1>Consejos de Spelling para el Ahorcado</h1>
            <p>Domina la escritura en inglés con estas estrategias</p>
        </div>
        
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-abc"></i>
                ¿Por qué es importante el Spelling?
            </h2>
            <div class="note">
                El spelling (deletreo) correcto es fundamental en inglés. A diferencia del español, donde las palabras se escriben como suenan, el inglés tiene muchas excepciones. El juego del ahorcado te ayuda a:
                <ul>
                    <li>Memorizar patrones de letras comunes</li>
                    <li>Reconocer las letras más frecuentes en inglés</li>
                    <li>Desarrollar intuición para la ortografía</li>
                    <li>Ampliar tu vocabulario escrito</li>
                </ul>
            </div>
        </div>
        
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-chart-bar"></i>
                Frecuencia de Letras en Inglés
            </h2>
            
            <div class="strategy-card">
                <div class="strategy-title">
                    <i class="fas fa-star"></i>
                    Letras Más Frecuentes
                </div>
                <div class="strategy-content">
                    En el ahorcado, empieza siempre con estas letras por orden de frecuencia:
                    <div style="margin: var(--space-lg) 0; text-align: center;">
                        <span class="letter-box">E</span>
                        <span class="letter-box">T</span>
                        <span class="letter-box">A</span>
                        <span class="letter-box">O</span>
                        <span class="letter-box">I</span>
                        <span class="letter-box">N</span>
                        <span class="letter-box">S</span>
                        <span class="letter-box">H</span>
                        <span class="letter-box">R</span>
                    </div>
                    Estas 9 letras aparecen en aproximadamente el 70% de las palabras en inglés.
                </div>
            </div>
            
            <div class="strategy-card">
                <div class="strategy-title">
                    <i class="fas fa-ban"></i>
                    Letras Menos Frecuentes
                </div>
                <div class="strategy-content">
                    Evita probar estas letras al principio:
                    <div style="margin: var(--space-lg) 0; text-align: center;">
                        <span class="letter-box rare">Q</span>
                        <span class="letter-box rare">X</span>
                        <span class="letter-box rare">Z</span>
                        <span class="letter-box rare">J</span>
                        <span class="letter-box rare">K</span>
                    </div>
                    Estas letras aparecen muy raramente, así que déjalas para el final.
                </div>
            </div>
        </div>
        
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-puzzle-piece"></i>
                Patrones Comunes del Inglés
            </h2>
            
            <div class="pattern-list">
                <div class="pattern-item">
                    <div class="pattern-name">Terminaciones comunes:</div>
                    <div>-ING, -TION, -ED, -ER, -EST, -LY</div>
                    <div class="word-example">
                        <div class="word-example-title">Ejemplos:</div>
                        RUNNING, NATION, PLAYED, BIGGER
                    </div>
                </div>
                
                <div class="pattern-item">
                    <div class="pattern-name">Dobles consonantes:</div>
                    <div>-LL, -SS, -TT, -NN, -MM</div>
                    <div class="word-example">
                        <div class="word-example-title">Ejemplos:</div>
                        HELLO, GUESS, LETTER, FUNNY
                    </div>
                </div>
                
                <div class="pattern-item">
                    <div class="pattern-name">Combinaciones frecuentes:</div>
                    <div>TH, ST, ND, NG, CH, SH</div>
                    <div class="word-example">
                        <div class="word-example-title">Ejemplos:</div>
                        THINK, FIRST, HAND, SONG
                    </div>
                </div>
                
                <div class="pattern-item">
                    <div class="pattern-name">Vocales juntas:</div>
                    <div>EA, OU, AI, OO, EE</div>
                    <div class="word-example">
                        <div class="word-example-title">Ejemplos:</div>
                        BREAD, HOUSE, RAIN, BOOK
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-brain"></i>
                Estrategias Avanzadas
            </h2>
            
            <div class="strategy-card">
                <div class="strategy-title">
                    <i class="fas fa-search"></i>
                    Analiza la Longitud
                </div>
                <div class="strategy-content">
                    <strong>Palabras de 3-4 letras:</strong> Probablemente sean artículos (THE, AND) o palabras básicas<br>
                    <strong>Palabras de 5-6 letras:</strong> Sustantivos o verbos comunes<br>
                    <strong>Palabras de 7+ letras:</strong> Pueden tener prefijos o sufijos
                    <div class="word-example">
                        <div class="word-example-title">Ejemplo de análisis:</div>
                        <span class="letter-box">_</span><span class="letter-box">_</span><span class="letter-box">_</span><span class="letter-box">_</span><span class="letter-box">_</span> ← 5 letras, probable que sea HOUSE, WORLD, MUSIC
                    </div>
                </div>
            </div>
            
            <div class="strategy-card">
                <div class="strategy-title">
                    <i class="fas fa-lightbulb"></i>
                    Usa las Pistas
                </div>
                <div class="strategy-content">
                    • Lee la pista cuidadosamente para determinar la categoría de la palabra<br>
                    • Piensa en palabras relacionadas con el tema de la pista<br>
                    • Considera sinónimos o palabras relacionadas
                    <div class="word-example">
                        <div class="word-example-title">Ejemplo:</div>
                        Pista: "Lugar donde vives" → Piensa en HOUSE, HOME, APARTMENT...
                    </div>
                </div>
            </div>
            
            <div class="strategy-card">
                <div class="strategy-title">
                    <i class="fas fa-step-forward"></i>
                    Estrategia de Eliminación
                </div>
                <div class="strategy-content">
                    • Una vez que tengas algunas letras, trata de formar palabras mentalmente<br>
                    • Elimina letras que no pueden ir en ciertas posiciones<br>
                    • Usa tu conocimiento de gramática inglesa
                    <div class="word-example">
                        <div class="word-example-title">Ejemplo:</div>
                        <span class="letter-box">_</span><span class="letter-box">A</span><span class="letter-box">_</span><span class="letter-box">_</span><span class="letter-box">_</span> ← La segunda letra es A, probablemente no es Q la primera letra
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-graduation-cap"></i>
                Reglas de Spelling Importantes
            </h2>
            
            <div class="pattern-list">
                <div class="pattern-item">
                    <div class="pattern-name">I antes de E:</div>
                    <div>I before E except after C</div>
                    <div class="word-example">
                        <div class="word-example-title">Ejemplos:</div>
                        FRIEND, FIELD | CEILING, RECEIVE
                    </div>
                </div>
                
                <div class="pattern-item">
                    <div class="pattern-name">Silent E:</div>
                    <div>La E final a menudo es muda</div>
                    <div class="word-example">
                        <div class="word-example-title">Ejemplos:</div>
                        MAKE, HOUSE, SMILE, NAME
                    </div>
                </div>
                
                <div class="pattern-item">
                    <div class="pattern-name">Y al final:</div>
                    <div>Y como vocal al final de palabras</div>
                    <div class="word-example">
                        <div class="word-example-title">Ejemplos:</div>
                        HAPPY, FAMILY, STUDY, FUNNY
                    </div>
                </div>
            </div>
        </div>
        
        <div class="game-controls">
            <button class="control-button" onclick="startGame()">
                <i class="fas fa-play"></i> Jugar Ahorcado
            </button>
        </div>
    </div>

    <script src="../js/theory.js"></script>
    <script>
        function goBack() {
            window.location.href = '../index.html';
        }
        
        function startGame() {
            window.location.href = '../games/hangman.php';
        }
    </script>
</body>
</html>