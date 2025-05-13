<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futuro Simple - Teoría</title>
    <link rel="stylesheet" href="../css/theory.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Estilos específicos para tablas comparativas */
        .comparison-table {
            background: rgba(243, 232, 255, 0.3);
            border-radius: var(--radius-small);
            overflow: hidden;
            margin: var(--space-md) 0;
            border: 3px solid var(--bg-space);
        }
        
        .comparison-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            padding: var(--space-sm);
            border-bottom: 2px solid var(--bg-space);
            color: var(--bg-space);
        }
        
        .comparison-header {
            font-weight: 700;
            color: white;
            background: var(--purple-bright);
        }
        
        .will-column {
            color: var(--yellow-bright);
            font-weight: 600;
        }
        
        .going-to-column {
            color: var(--green-bright);
            font-weight: 600;
        }
        
        .use-column {
            color: var(--purple-bright);
            font-weight: 600;
        }
        
        .comparison-row:last-child {
            border-bottom: none;
        }
        
        /* Grid responsive para comparación */
        @media (max-width: 768px) {
            .comparison-row {
                grid-template-columns: 1fr;
                gap: var(--space-xs);
            }
            
            .comparison-row > div {
                text-align: center;
                padding: var(--space-xs);
                border-bottom: 1px solid var(--bg-space);
            }
            
            .comparison-row > div:last-child {
                border-bottom: none;
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
            <h1>El Futuro Simple en Inglés</h1>
            <p>Aprende a hablar de planes y predicciones</p>
        </div>
        
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-info-circle"></i>
                ¿Qué es el Futuro Simple?
            </h2>
            <div class="note">
                El futuro simple se usa para:
                <ul>
                    <li><strong>Predicciones espontáneas:</strong> I think it will rain tomorrow</li>
                    <li><strong>Promesas y decisiones instantáneas:</strong> I will help you</li>
                    <li><strong>Hechos futuros:</strong> The sun will rise at 6 AM</li>
                    <li><strong>Ofrecimientos:</strong> I'll answer the phone</li>
                </ul>
            </div>
        </div>
        
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-cogs"></i>
                Formación del Futuro Simple
            </h2>
            
            <div class="rule-card">
                <div class="rule-title">
                    <i class="fas fa-formula"></i>
                    Fórmula con WILL
                </div>
                <div class="formula-box">
                    <div class="formula">Sujeto + WILL + Verbo (infinitivo)</div>
                </div>
                <div class="note">
                    • WILL es igual para todas las personas (I/you/he/she/it/we/they)
                    <br>• El verbo siempre va en infinitivo (sin "to")
                    <br>• Contracción: will = 'll (I'll, you'll, he'll, etc.)
                </div>
            </div>
            
            <div class="rule-card">
                <div class="rule-title">
                    <i class="fas fa-table"></i>
                    Estructura en Diferentes Formas
                </div>
                <div class="verb-table">
                    <div class="verb-table-header">Formas del Futuro Simple</div>
                    <div class="verb-table-row">
                        <div class="verb-table-cell"><strong>Forma</strong></div>
                        <div class="verb-table-cell"><strong>Estructura</strong></div>
                        <div class="verb-table-cell"><strong>Ejemplo</strong></div>
                    </div>
                    <div class="verb-table-row">
                        <div class="verb-table-cell">Afirmativo</div>
                        <div class="verb-table-cell">Subject + will + verb</div>
                        <div class="verb-table-cell">I <span class="highlight-verb">will go</span></div>
                    </div>
                    <div class="verb-table-row">
                        <div class="verb-table-cell">Negativo</div>
                        <div class="verb-table-cell">Subject + will not + verb</div>
                        <div class="verb-table-cell">I <span class="highlight-verb">will not go</span></div>
                    </div>
                    <div class="verb-table-row">
                        <div class="verb-table-cell">Pregunta</div>
                        <div class="verb-table-cell">Will + subject + verb?</div>
                        <div class="verb-table-cell"><span class="highlight-verb">Will</span> you go?</div>
                    </div>
                    <div class="verb-table-row">
                        <div class="verb-table-cell">Pregunta negativa</div>
                        <div class="verb-table-cell">Won't + subject + verb?</div>
                        <div class="verb-table-cell"><span class="highlight-verb">Won't</span> you go?</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-examples"></i>
                Ejemplos Completos
            </h2>
            
            <div class="example-grid">
                <div class="example-card">
                    <div class="example-title">Afirmativo:</div>
                    <div class="example-sentence">I <span class="highlight-verb">will</span> study tonight</div>
                    <div class="example-translation">Estudiaré esta noche</div>
                    <div class="example-sentence">She <span class="highlight-verb">will</span> come tomorrow</div>
                    <div class="example-translation">Ella vendrá mañana</div>
                    <div class="example-sentence">We <span class="highlight-verb">will</span> travel next week</div>
                    <div class="example-translation">Viajaremos la próxima semana</div>
                </div>
                
                <div class="example-card">
                    <div class="example-title">Negativo:</div>
                    <div class="example-sentence">I <span class="highlight-verb">will not</span> work tomorrow</div>
                    <div class="example-translation">No trabajaré mañana</div>
                    <div class="example-sentence">He <span class="highlight-verb">won't</span> call you</div>
                    <div class="example-translation">Él no te llamará</div>
                    <div class="example-sentence">They <span class="highlight-verb">will not</span> be late</div>
                    <div class="example-translation">Ellos no llegarán tarde</div>
                </div>
                
                <div class="example-card">
                    <div class="example-title">Pregunta:</div>
                    <div class="example-sentence"><span class="highlight-verb">Will</span> you help me?</div>
                    <div class="example-translation">¿Me ayudarás?</div>
                    <div class="example-sentence"><span class="highlight-verb">Will</span> she come to the party?</div>
                    <div class="example-translation">¿Vendrá ella a la fiesta?</div>
                    <div class="example-sentence"><span class="highlight-verb">Will</span> they finish on time?</div>
                    <div class="example-translation">¿Terminarán a tiempo?</div>
                </div>
            </div>
        </div>
        
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-balance-scale"></i>
                WILL vs BE GOING TO
            </h2>
            
            <div class="comparison-table">
                <div class="comparison-row comparison-header">
                    <div>WILL</div>
                    <div>BE GOING TO</div>
                    <div>Cuándo usar</div>
                </div>
                <div class="comparison-row">
                    <div class="will-column">Decisiones espontáneas</div>
                    <div class="going-to-column">Planes ya decididos</div>
                    <div class="use-column">WILL: decisión en el momento</div>
                </div>
                <div class="comparison-row">
                    <div class="will-column">Predicciones generales</div>
                    <div class="going-to-column">Evidencia visible</div>
                    <div class="use-column">GOING TO: evidencia clara</div>
                </div>
                <div class="comparison-row">
                    <div class="will-column">Promesas</div>
                    <div class="going-to-column">Intenciones</div>
                    <div class="use-column">WILL: promesas formales</div>
                </div>
                <div class="comparison-row">
                    <div class="will-column">Ofrecimientos</div>
                    <div class="going-to-column">Planes personales</div>
                    <div class="use-column">GOING TO: ya planeado</div>
                </div>
            </div>
            
            <div class="example-grid">
                <div class="example-card" style="border-color: var(--yellow-bright);">
                    <div class="example-title" style="color: var(--yellow-bright);">WILL - Ejemplos:</div>
                    <div class="example-sentence">I <span class="highlight-verb">will</span> help you (decisión espontánea)</div>
                    <div class="example-sentence">I think it <span class="highlight-verb">will</span> rain (predicción)</div>
                    <div class="example-sentence">I <span class="highlight-verb">will</span> call you (promesa)</div>
                </div>
                
                <div class="example-card" style="border-color: var(--green-bright);">
                    <div class="example-title" style="color: var(--green-bright);">BE GOING TO - Ejemplos:</div>
                    <div class="example-sentence">I'm <span class="highlight-verb">going to</span> study tonight (plan)</div>
                    <div class="example-sentence">Look! It's <span class="highlight-verb">going to</span> rain (evidencia)</div>
                    <div class="example-sentence">We're <span class="highlight-verb">going to</span> move (intención)</div>
                </div>
            </div>
        </div>
        
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-clock"></i>
                Expresiones de Tiempo Futuras
            </h2>
            
            <div class="example-grid">
                <div class="example-card">
                    <div class="example-title">Tiempo específico:</div>
                    <div>• Tomorrow (mañana)</div>
                    <div>• Next week/month/year</div>
                    <div>• Tonight (esta noche)</div>
                    <div>• In 2025</div>
                    <div>• Soon (pronto)</div>
                </div>
                <div class="example-card">
                    <div class="example-title">Con will:</div>
                    <div>• I think... (creo que...)</div>
                    <div>• I hope... (espero que...)</div>
                    <div>• Probably (probablemente)</div>
                    <div>• Maybe (tal vez)</div>
                    <div>• Definitely (definitivamente)</div>
                </div>
            </div>
        </div>
        
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-star"></i>
                Usos Específicos de WILL
            </h2>
            
            <div class="rule-card">
                <div class="rule-title">
                    <i class="fas fa-handshake"></i>
                    1. Ofertas y Voluntad
                </div>
                <div class="example-grid">
                    <div class="example-card">
                        <div class="example-title">Ofertas:</div>
                        <div class="example-sentence">I'll help you with that</div>
                        <div class="example-translation">Te ayudo con eso</div>
                        <div class="example-sentence">I'll carry your bag</div>
                        <div class="example-translation">Llevo tu bolso</div>
                    </div>
                </div>
            </div>
            
            <div class="rule-card">
                <div class="rule-title">
                    <i class="fas fa-promise"></i>
                    2. Promesas y Garantías
                </div>
                <div class="example-grid">
                    <div class="example-card">
                        <div class="example-title">Promesas:</div>
                        <div class="example-sentence">I will never forget you</div>
                        <div class="example-translation">Nunca te olvidaré</div>
                        <div class="example-sentence">We will finish on time</div>
                        <div class="example-translation">Terminaremos a tiempo</div>
                    </div>
                </div>
            </div>
            
            <div class="rule-card">
                <div class="rule-title">
                    <i class="fas fa-crystal-ball"></i>
                    3. Predicciones y Opiniones
                </div>
                <div class="example-grid">
                    <div class="example-card">
                        <div class="example-title">Con expresiones:</div>
                        <div class="example-sentence">I think she will win</div>
                        <div class="example-translation">Creo que ella ganará</div>
                        <div class="example-sentence">Perhaps it will snow</div>
                        <div class="example-translation">Quizás nevará</div>
                    </div>
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
                        <div>I will to go tomorrow</div>
                        <div>He will goes tomorrow</div>
                        <div>Will you to help me?</div>
                    </div>
                    <div class="example-card success">
                        <div class="example-title">✅ Correcto:</div>
                        <div>I will go tomorrow</div>
                        <div>He will go tomorrow</div>
                        <div>Will you help me?</div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="content-section">
            <h2 class="section-title">
                <i class="fas fa-lightbulb"></i>
                Consejos para Recordar
            </h2>
            
            <div class="rule-card">
                <div class="rule-title">
                    <i class="fas fa-brain"></i>
                    Trucos Útiles
                </div>
                <div class="note">
                    <ul>
                        <li><strong>"Will + infinitivo":</strong> Siempre sin "to" después de will</li>
                        <li><strong>"Will para todos":</strong> La misma forma para todas las personas</li>
                        <li><strong>"Decisión del momento":</strong> Will para decisiones espontáneas</li>
                        <li><strong>"Contracciones":</strong> I'll, you'll, won't (will not)</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="game-controls">
            <button class="control-button" onclick="startGame()">
                <i class="fas fa-play"></i> Practicar Futuro Simple
            </button>
        </div>
    </div>

    <script src="../js/theory.js"></script>
    <script>
        function goBack() {
            window.location.href = '../index.html';
        }
        
        function startGame() {
            window.location.href = '../games/future-simple.php';
        }
    </script>
</body>
</html>