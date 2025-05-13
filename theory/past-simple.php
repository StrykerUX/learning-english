<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pasado Simple - Teoría</title>
    <link rel="stylesheet" href="../css/theory.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Estilos específicos para verbos irregulares */
        .irregular-verbs {
            background: rgba(243, 232, 255, 0.3);
            border-radius: var(--radius-small);
            max-height: 300px;
            overflow-y: auto;
            margin-top: var(--space-md);
            border: 3px solid var(--bg-space);
        }
        
        .irregular-verb-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            padding: var(--space-sm);
            border-bottom: 2px solid var(--bg-space);
            color: var(--bg-space);
        }
        
        .irregular-verb-row:nth-child(even) {
            background: rgba(220, 180, 254, 0.2);
        }
        
        .irregular-header {
            font-weight: 700;
            color: white;
            background: var(--purple-bright);
        }
        
        .irregular-verb-row:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <div class="theory-container">
        <button class="back-button" onclick="goBack()">
            <i class="fas fa-arrow-left"></i> Volver
        </button>
        
        <div class="theory-header">
            <h1>El Pasado Simple en Inglés</h1>
            <p>Aprende a contar eventos del pasado</p>
        </div>
        
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-info-circle"></i>
                ¿Qué es el Pasado Simple?
            </h2>
            <div class="note">
                El pasado simple se usa para hablar de:
                <ul>
                    <li><strong>Acciones completadas en el pasado:</strong> I visited Paris last year</li>
                    <li><strong>Estados pasados:</strong> She was happy yesterday</li>
                    <li><strong>Hábitos pasados:</strong> He always walked to school</li>
                    <li><strong>Secuencia de eventos:</strong> First we ate, then we went home</li>
                </ul>
            </div>
        </div>
        
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-cogs"></i>
                Formación del Pasado Simple
            </h2>
            
            <div class="rule-card">
                <div class="rule-title">
                    <i class="fas fa-check"></i>
                    Verbos Regulares
                </div>
                <div class="formula-box">
                    <div class="formula">Verbo + ED</div>
                </div>
                <div class="example-grid">
                    <div class="example-card">
                        <div class="example-title">Ejemplos básicos:</div>
                        <div class="example-sentence">play → <span class="highlight-verb">played</span></div>
                        <div class="example-sentence">work → <span class="highlight-verb">worked</span></div>
                        <div class="example-sentence">watch → <span class="highlight-verb">watched</span></div>
                    </div>
                </div>
            </div>
            
            <div class="rule-card">
                <div class="rule-title">
                    <i class="fas fa-magic"></i>
                    Verbos Irregulares
                </div>
                <div class="formula-box">
                    <div class="formula">Cada verbo tiene su propia forma</div>
                </div>
                <div class="example-grid">
                    <div class="example-card">
                        <div class="example-title">Ejemplos comunes:</div>
                        <div class="example-sentence">go → <span class="highlight-verb">went</span></div>
                        <div class="example-sentence">see → <span class="highlight-verb">saw</span></div>
                        <div class="example-sentence">eat → <span class="highlight-verb">ate</span></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-list"></i>
                Reglas para Verbos Regulares
            </h2>
            
            <div class="verb-table">
                <div class="verb-table-header">Reglas de Terminación</div>
                <div class="verb-table-row">
                    <div class="verb-table-cell"><strong>Terminación</strong></div>
                    <div class="verb-table-cell"><strong>Regla</strong></div>
                    <div class="verb-table-cell"><strong>Ejemplo</strong></div>
                </div>
                <div class="verb-table-row">
                    <div class="verb-table-cell">Verbos regulares</div>
                    <div class="verb-table-cell">+ ED</div>
                    <div class="verb-table-cell">walk → walked</div>
                </div>
                <div class="verb-table-row">
                    <div class="verb-table-cell">Termina en E</div>
                    <div class="verb-table-cell">+ D</div>
                    <div class="verb-table-cell">live → lived</div>
                </div>
                <div class="verb-table-row">
                    <div class="verb-table-cell">Termina en Y (consonante + Y)</div>
                    <div class="verb-table-cell">Y → IED</div>
                    <div class="verb-table-cell">study → studied</div>
                </div>
                <div class="verb-table-row">
                    <div class="verb-table-cell">Termina en Y (vocal + Y)</div>
                    <div class="verb-table-cell">+ ED</div>
                    <div class="verb-table-cell">play → played</div>
                </div>
                <div class="verb-table-row">
                    <div class="verb-table-cell">CVC (consonante-vocal-consonante)</div>
                    <div class="verb-table-cell">Doblar última + ED</div>
                    <div class="verb-table-cell">stop → stopped</div>
                </div>
            </div>
        </div>
        
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-star"></i>
                Verbos Irregulares Más Comunes
            </h2>
            
            <div class="irregular-verbs">
                <div class="irregular-verb-row irregular-header">
                    <div>Presente</div>
                    <div>Pasado</div>
                    <div>Significado</div>
                </div>
                <div class="irregular-verb-row">
                    <div>be</div>
                    <div><span class="highlight-verb">was/were</span></div>
                    <div>ser/estar</div>
                </div>
                <div class="irregular-verb-row">
                    <div>have</div>
                    <div><span class="highlight-verb">had</span></div>
                    <div>tener</div>
                </div>
                <div class="irregular-verb-row">
                    <div>do</div>
                    <div><span class="highlight-verb">did</span></div>
                    <div>hacer</div>
                </div>
                <div class="irregular-verb-row">
                    <div>go</div>
                    <div><span class="highlight-verb">went</span></div>
                    <div>ir</div>
                </div>
                <div class="irregular-verb-row">
                    <div>see</div>
                    <div><span class="highlight-verb">saw</span></div>
                    <div>ver</div>
                </div>
                <div class="irregular-verb-row">
                    <div>get</div>
                    <div><span class="highlight-verb">got</span></div>
                    <div>conseguir</div>
                </div>
                <div class="irregular-verb-row">
                    <div>make</div>
                    <div><span class="highlight-verb">made</span></div>
                    <div>hacer</div>
                </div>
                <div class="irregular-verb-row">
                    <div>come</div>
                    <div><span class="highlight-verb">came</span></div>
                    <div>venir</div>
                </div>
                <div class="irregular-verb-row">
                    <div>take</div>
                    <div><span class="highlight-verb">took</span></div>
                    <div>tomar</div>
                </div>
                <div class="irregular-verb-row">
                    <div>give</div>
                    <div><span class="highlight-verb">gave</span></div>
                    <div>dar</div>
                </div>
                <div class="irregular-verb-row">
                    <div>eat</div>
                    <div><span class="highlight-verb">ate</span></div>
                    <div>comer</div>
                </div>
                <div class="irregular-verb-row">
                    <div>drink</div>
                    <div><span class="highlight-verb">drank</span></div>
                    <div>beber</div>
                </div>
                <div class="irregular-verb-row">
                    <div>think</div>
                    <div><span class="highlight-verb">thought</span></div>
                    <div>pensar</div>
                </div>
                <div class="irregular-verb-row">
                    <div>know</div>
                    <div><span class="highlight-verb">knew</span></div>
                    <div>saber</div>
                </div>
                <div class="irregular-verb-row">
                    <div>say</div>
                    <div><span class="highlight-verb">said</span></div>
                    <div>decir</div>
                </div>
            </div>
        </div>
        
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-examples"></i>
                Ejemplos en Contexto
            </h2>
            
            <div class="example-grid">
                <div class="example-card">
                    <div class="example-title">Verbos Regulares:</div>
                    <div class="example-sentence">I <span class="highlight-verb">played</span> soccer yesterday</div>
                    <div class="example-translation">Jugué fútbol ayer</div>
                    <div class="example-sentence">She <span class="highlight-verb">studied</span> all night</div>
                    <div class="example-translation">Ella estudió toda la noche</div>
                    <div class="example-sentence">We <span class="highlight-verb">watched</span> a movie</div>
                    <div class="example-translation">Vimos una película</div>
                </div>
                
                <div class="example-card">
                    <div class="example-title">Verbos Irregulares:</div>
                    <div class="example-sentence">He <span class="highlight-verb">went</span> to the store</div>
                    <div class="example-translation">Él fue a la tienda</div>
                    <div class="example-sentence">They <span class="highlight-verb">ate</span> dinner</div>
                    <div class="example-translation">Ellos cenaron</div>
                    <div class="example-sentence">I <span class="highlight-verb">saw</span> a movie</div>
                    <div class="example-translation">Vi una película</div>
                </div>
            </div>
        </div>
        
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-clock"></i>
                Expresiones de Tiempo
            </h2>
            
            <div class="example-grid">
                <div class="example-card">
                    <div class="example-title">Tiempo específico:</div>
                    <div>• Yesterday (ayer)</div>
                    <div>• Last week/month/year</div>
                    <div>• In 2020</div>
                    <div>• Two days ago</div>
                    <div>• This morning</div>
                </div>
                <div class="example-card">
                    <div class="example-title">Períodos pasados:</div>
                    <div>• When I was young</div>
                    <div>• During the summer</div>
                    <div>• In the old days</div>
                    <div>• Before</div>
                    <div>• After the meeting</div>
                </div>
            </div>
        </div>
        
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-lightbulb"></i>
                Consejos para Memorizar
            </h2>
            
            <div class="rule-card">
                <div class="rule-title">
                    <i class="fas fa-brain"></i>
                    Estrategias Efectivas
                </div>
                <div class="note">
                    <ul>
                        <li><strong>Agrupa verbos similares:</strong> sing→sang, ring→rang, bring→brought</li>
                        <li><strong>Practica diariamente:</strong> Lee historias simples en pasado</li>
                        <li><strong>Crea oraciones personales:</strong> "Yesterday I ate pizza"</li>
                        <li><strong>Usa flashcards:</strong> Presente en un lado, pasado en el otro</li>
                        <li><strong>Escucha y repite:</strong> Canciones o videos con pasado simple</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-exclamation-triangle"></i>
                Errores Comunes
            </h2>
            
            <div class="rule-card">
                <div class="rule-title">
                    <i class="fas fa-times-circle"></i>
                    Evita Estos Errores
                </div>
                <div class="example-grid">
                    <div class="example-card error">
                        <div class="example-title">❌ Incorrecto:</div>
                        <div>I go to school yesterday</div>
                        <div>He eat dinner last night</div>
                        <div>We see a movie yesterday</div>
                    </div>
                    <div class="example-card success">
                        <div class="example-title">✅ Correcto:</div>
                        <div>I went to school yesterday</div>
                        <div>He ate dinner last night</div>
                        <div>We saw a movie yesterday</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="game-controls">
            <button class="control-button" onclick="startGame()">
                <i class="fas fa-play"></i> Practicar Pasado Simple
            </button>
        </div>
    </div>

    <script src="../js/theory.js"></script>
    <script>
        function goBack() {
            window.location.href = '../index.html';
        }
        
        function startGame() {
            window.location.href = '../games/past-simple.php';
        }
    </script>
</body>
</html>