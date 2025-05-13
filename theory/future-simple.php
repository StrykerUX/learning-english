<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futuro Simple - Teoría</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .theory-container {
            max-width: 900px;
            margin: 2rem auto;
            padding: 2rem;
            background: rgba(0, 0, 0, 0.8);
            border: 3px solid #0ff;
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }
        
        .content-section {
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid #333;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .section-title {
            color: #0ff;
            font-size: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }
        
        .rule-card {
            background: #1a1a1a;
            border: 2px solid #333;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .rule-title {
            color: #ffd700;
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .formula-box {
            background: rgba(34, 197, 94, 0.1);
            border: 2px solid #16a34a;
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
            margin: 1rem 0;
        }
        
        .formula {
            color: #16a34a;
            font-weight: bold;
            font-size: 1.2rem;
        }
        
        .structure-table {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            overflow: hidden;
            margin: 1rem 0;
        }
        
        .structure-header {
            background: rgba(0, 255, 255, 0.1);
            padding: 0.8rem;
            font-weight: bold;
            color: #0ff;
            text-align: center;
        }
        
        .structure-row {
            display: grid;
            grid-template-columns: 1fr 2fr 2fr;
            border-bottom: 1px solid #333;
        }
        
        .structure-cell {
            padding: 0.8rem;
            border-right: 1px solid #333;
            text-align: center;
        }
        
        .structure-cell:last-child {
            border-right: none;
        }
        
        .example-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .example-card {
            background: rgba(139, 92, 246, 0.1);
            border: 2px solid #8b5cf6;
            border-radius: 8px;
            padding: 1rem;
        }
        
        .example-title {
            color: #8b5cf6;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .example-sentence {
            color: #fff;
            font-size: 1.1rem;
            margin-bottom: 0.3rem;
        }
        
        .example-translation {
            color: #ccc;
            font-style: italic;
        }
        
        .highlight-verb {
            color: #ffd700;
            font-weight: bold;
        }
        
        .comparison-table {
            background: rgba(255, 255, 255, 0.03);
            border-radius: 8px;
            overflow: hidden;
            margin: 1rem 0;
        }
        
        .comparison-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            padding: 0.8rem;
            border-bottom: 1px solid #333;
        }
        
        .comparison-header {
            font-weight: bold;
            color: #0ff;
            background: rgba(0, 255, 255, 0.1);
        }
        
        .will-column {
            color: #ffd700;
        }
        
        .going-to-column {
            color: #10b981;
        }
        
        .use-column {
            color: #8b5cf6;
        }
    </style>
</head>
<body>
    <div class="universe">
        <div class="stars-bg"></div>
        
        <div class="theory-container">
            <button class="back-button control-button" onclick="goBack()">
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
                    <ul style="margin-left: 1.5rem; margin-top: 1rem; line-height: 1.8;">
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
                    <div class="structure-table">
                        <div class="structure-header">Formas del Futuro Simple</div>
                        <div class="structure-row">
                            <div class="structure-cell"><strong>Forma</strong></div>
                            <div class="structure-cell"><strong>Estructura</strong></div>
                            <div class="structure-cell"><strong>Ejemplo</strong></div>
                        </div>
                        <div class="structure-row">
                            <div class="structure-cell">Afirmativo</div>
                            <div class="structure-cell">Subject + will + verb</div>
                            <div class="structure-cell">I <span class="highlight-verb">will go</span></div>
                        </div>
                        <div class="structure-row">
                            <div class="structure-cell">Negativo</div>
                            <div class="structure-cell">Subject + will not + verb</div>
                            <div class="structure-cell">I <span class="highlight-verb">will not go</span></div>
                        </div>
                        <div class="structure-row">
                            <div class="structure-cell">Pregunta</div>
                            <div class="structure-cell">Will + subject + verb?</div>
                            <div class="structure-cell"><span class="highlight-verb">Will</span> you go?</div>
                        </div>
                        <div class="structure-row">
                            <div class="structure-cell">Pregunta negativa</div>
                            <div class="structure-cell">Won't + subject + verb?</div>
                            <div class="structure-cell"><span class="highlight-verb">Won't</span> you go?</div>
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
                        <div class="structure-cell">WILL</div>
                        <div class="structure-cell">BE GOING TO</div>
                        <div class="structure-cell">Cuándo usar</div>
                    </div>
                    <div class="comparison-row">
                        <div class="structure-cell will-column">Decisiones espontáneas</div>
                        <div class="structure-cell going-to-column">Planes ya decididos</div>
                        <div class="structure-cell use-column">WILL: decisión en el momento</div>
                    </div>
                    <div class="comparison-row">
                        <div class="structure-cell will-column">Predicciones generales</div>
                        <div class="structure-cell going-to-column">Evidencia visible</div>
                        <div class="structure-cell use-column">GOING TO: evidencia clara</div>
                    </div>
                    <div class="comparison-row">
                        <div class="structure-cell will-column">Promesas</div>
                        <div class="structure-cell going-to-column">Intenciones</div>
                        <div class="structure-cell use-column">WILL: promesas formales</div>
                    </div>
                    <div class="comparison-row">
                        <div class="structure-cell will-column">Ofrecimientos</div>
                        <div class="structure-cell going-to-column">Planes personales</div>
                        <div class="structure-cell use-column">GOING TO: ya planeado</div>
                    </div>
                </div>
                
                <div class="example-grid" style="margin-top: 1.5rem;">
                    <div class="example-card" style="border-color: #ffd700;">
                        <div class="example-title" style="color: #ffd700;">WILL - Ejemplos:</div>
                        <div class="example-sentence">I <span class="highlight-verb">will</span> help you (decisión espontánea)</div>
                        <div class="example-sentence">I think it <span class="highlight-verb">will</span> rain (predicción)</div>
                        <div class="example-sentence">I <span class="highlight-verb">will</span> call you (promesa)</div>
                    </div>
                    
                    <div class="example-card" style="border-color: #10b981;">
                        <div class="example-title" style="color: #10b981;">BE GOING TO - Ejemplos:</div>
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
                        <i class="fas fa-handshake"></i>
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
                        <div class="example-card" style="border-color: #dc2626;">
                            <div class="example-title" style="color: #dc2626;">❌ Incorrecto:</div>
                            <div>I will to go tomorrow</div>
                            <div>He will goes tomorrow</div>
                            <div>Will you to help me?</div>
                        </div>
                        <div class="example-card" style="border-color: #16a34a;">
                            <div class="example-title" style="color: #16a34a;">✅ Correcto:</div>
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
                        <ul style="margin-left: 1rem; line-height: 1.8;">
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
    </div>

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