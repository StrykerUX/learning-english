<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presente Continuo - Teoría</title>
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
        
        .be-conjugation {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            overflow: hidden;
            margin: 1rem 0;
        }
        
        .be-header {
            background: rgba(0, 255, 255, 0.1);
            padding: 0.8rem;
            font-weight: bold;
            color: #0ff;
            text-align: center;
        }
        
        .be-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            border-bottom: 1px solid #333;
        }
        
        .be-cell {
            padding: 0.8rem;
            text-align: center;
            border-right: 1px solid #333;
        }
        
        .be-cell:last-child {
            border-right: none;
        }
        
        .example-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
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
        
        .highlight-ing {
            color: #10b981;
            font-weight: bold;
        }
        
        .ing-rules {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            padding: 1rem;
            margin-top: 1rem;
        }
        
        .ing-rule {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid #16a34a;
            border-radius: 5px;
            padding: 0.8rem;
            margin-bottom: 0.8rem;
        }
        
        .rule-name {
            color: #16a34a;
            font-weight: bold;
            margin-bottom: 0.5rem;
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
                <h1>El Presente Continuo en Inglés</h1>
                <p>Aprende a hablar de acciones que pasan ahora mismo</p>
            </div>
            
            <div class="content-section">
                <h2 class="section-title">
                    <i class="fas fa-info-circle"></i>
                    ¿Qué es el Presente Continuo?
                </h2>
                <div class="note">
                    El presente continuo (también llamado presente progresivo) se usa para hablar de:
                    <ul style="margin-left: 1.5rem; margin-top: 1rem; line-height: 1.8;">
                        <li><strong>Acciones que pasan ahora:</strong> I am reading a book</li>
                        <li><strong>Situaciones temporales:</strong> She is studying in London this year</li>
                        <li><strong>Planes futuros definidos:</strong> We are meeting tomorrow</li>
                        <li><strong>Tendencias actuales:</strong> People are using more technology</li>
                    </ul>
                </div>
            </div>
            
            <div class="content-section">
                <h2 class="section-title">
                    <i class="fas fa-cogs"></i>
                    Formación del Presente Continuo
                </h2>
                
                <div class="rule-card">
                    <div class="rule-title">
                        <i class="fas fa-formula"></i>
                        Fórmula General
                    </div>
                    <div class="formula-box">
                        <div class="formula">Sujeto + BE (am/is/are) + Verbo + ING</div>
                    </div>
                </div>
                
                <div class="rule-card">
                    <div class="rule-title">
                        <i class="fas fa-edit"></i>
                        Conjugación del Verbo BE
                    </div>
                    <div class="be-conjugation">
                        <div class="be-header">Verbo BE en Presente</div>
                        <div class="be-row">
                            <div class="be-cell">Pronombre</div>
                            <div class="be-cell">Forma de BE</div>
                        </div>
                        <div class="be-row">
                            <div class="be-cell">I</div>
                            <div class="be-cell"><span class="highlight-verb">am</span></div>
                        </div>
                        <div class="be-row">
                            <div class="be-cell">You</div>
                            <div class="be-cell"><span class="highlight-verb">are</span></div>
                        </div>
                        <div class="be-row">
                            <div class="be-cell">He / She / It</div>
                            <div class="be-cell"><span class="highlight-verb">is</span></div>
                        </div>
                        <div class="be-row">
                            <div class="be-cell">We</div>
                            <div class="be-cell"><span class="highlight-verb">are</span></div>
                        </div>
                        <div class="be-row">
                            <div class="be-cell">They</div>
                            <div class="be-cell"><span class="highlight-verb">are</span></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="content-section">
                <h2 class="section-title">
                    <i class="fas fa-plus"></i>
                    Reglas para Agregar -ING
                </h2>
                
                <div class="ing-rules">
                    <div class="ing-rule">
                        <div class="rule-name">1. Regla general:</div>
                        <div>Agregar -ING al verbo</div>
                        <div class="example-grid">
                            <div class="example-card">
                                <div class="example-title">Ejemplos:</div>
                                <div>play → play<span class="highlight-ing">ing</span></div>
                                <div>read → read<span class="highlight-ing">ing</span></div>
                                <div>watch → watch<span class="highlight-ing">ing</span></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="ing-rule">
                        <div class="rule-name">2. Verbo termina en E muda:</div>
                        <div>Quitar la E y agregar -ING</div>
                        <div class="example-grid">
                            <div class="example-card">
                                <div class="example-title">Ejemplos:</div>
                                <div>make → mak<span class="highlight-ing">ing</span></div>
                                <div>write → writ<span class="highlight-ing">ing</span></div>
                                <div>dance → danc<span class="highlight-ing">ing</span></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="ing-rule">
                        <div class="rule-name">3. Consonante + Vocal + Consonante:</div>
                        <div>Doblar la última consonante y agregar -ING</div>
                        <div class="example-grid">
                            <div class="example-card">
                                <div class="example-title">Ejemplos:</div>
                                <div>run → run<span style="color: #dc2626;">n</span><span class="highlight-ing">ing</span></div>
                                <div>swim → swim<span style="color: #dc2626;">m</span><span class="highlight-ing">ing</span></div>
                                <div>stop → stop<span style="color: #dc2626;">p</span><span class="highlight-ing">ing</span></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="ing-rule">
                        <div class="rule-name">4. Verbo termina en IE:</div>
                        <div>Cambiar IE por Y y agregar -ING</div>
                        <div class="example-grid">
                            <div class="example-card">
                                <div class="example-title">Ejemplos:</div>
                                <div>lie → l<span style="color: #dc2626;">y</span><span class="highlight-ing">ing</span></div>
                                <div>die → d<span style="color: #dc2626;">y</span><span class="highlight-ing">ing</span></div>
                                <div>tie → t<span style="color: #dc2626;">y</span><span class="highlight-ing">ing</span></div>
                            </div>
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
                        <div class="example-sentence">I <span class="highlight-verb">am</span> eat<span class="highlight-ing">ing</span> lunch</div>
                        <div class="example-translation">Estoy comiendo almuerzo</div>
                        <div class="example-sentence">She <span class="highlight-verb">is</span> study<span class="highlight-ing">ing</span> English</div>
                        <div class="example-translation">Ella está estudiando inglés</div>
                        <div class="example-sentence">They <span class="highlight-verb">are</span> play<span class="highlight-ing">ing</span> soccer</div>
                        <div class="example-translation">Ellos están jugando fútbol</div>
                    </div>
                    
                    <div class="example-card">
                        <div class="example-title">Negativo:</div>
                        <div class="example-sentence">I <span class="highlight-verb">am not</span> work<span class="highlight-ing">ing</span> today</div>
                        <div class="example-translation">No estoy trabajando hoy</div>
                        <div class="example-sentence">He <span class="highlight-verb">is not</span> sleep<span class="highlight-ing">ing</span></div>
                        <div class="example-translation">Él no está durmiendo</div>
                        <div class="example-sentence">We <span class="highlight-verb">are not</span> run<span class="highlight-ing">ing</span></div>
                        <div class="example-translation">No estamos corriendo</div>
                    </div>
                    
                    <div class="example-card">
                        <div class="example-title">Pregunta:</div>
                        <div class="example-sentence"><span class="highlight-verb">Are</span> you listen<span class="highlight-ing">ing</span>?</div>
                        <div class="example-translation">¿Estás escuchando?</div>
                        <div class="example-sentence"><span class="highlight-verb">Is</span> she cook<span class="highlight-ing">ing</span>?</div>
                        <div class="example-translation">¿Está ella cocinando?</div>
                        <div class="example-sentence"><span class="highlight-verb">Are</span> they com<span class="highlight-ing">ing</span>?</div>
                        <div class="example-translation">¿Están viniendo?</div>
                    </div>
                </div>
            </div>
            
            <div class="content-section">
                <h2 class="section-title">
                    <i class="fas fa-clock"></i>
                    Expresiones de Tiempo Comunes
                </h2>
                
                <div class="example-grid">
                    <div class="example-card">
                        <div class="example-title">Tiempo presente:</div>
                        <div>• Now (ahora)</div>
                        <div>• Right now (ahora mismo)</div>
                        <div>• At the moment (en este momento)</div>
                        <div>• Currently (actualmente)</div>
                        <div>• These days (estos días)</div>
                    </div>
                    <div class="example-card">
                        <div class="example-title">Planes futuros:</div>
                        <div>• Tomorrow (mañana)</div>
                        <div>• Next week (la próxima semana)</div>
                        <div>• This weekend (este fin de semana)</div>
                        <div>• Tonight (esta noche)</div>
                        <div>• Later (más tarde)</div>
                    </div>
                </div>
            </div>
            
            <div class="content-section">
                <h2 class="section-title">
                    <i class="fas fa-exclamation-triangle"></i>
                    Verbos que NO usan Presente Continuo
                </h2>
                
                <div class="rule-card">
                    <div class="rule-title">
                        <i class="fas fa-ban"></i>
                        State Verbs (Verbos de Estado)
                    </div>
                    <div class="note">
                        Estos verbos generalmente no se usan en presente continuo:
                        <div class="example-grid" style="margin-top: 1rem;">
                            <div class="example-card">
                                <div class="example-title">Emociones:</div>
                                <div>love, hate, like, want, need</div>
                            </div>
                            <div class="example-card">
                                <div class="example-title">Conocimiento:</div>
                                <div>know, understand, remember, forget</div>
                            </div>
                            <div class="example-card">
                                <div class="example-title">Sentidos:</div>
                                <div>see, hear, taste, smell, feel</div>
                            </div>
                            <div class="example-card">
                                <div class="example-title">Posesión:</div>
                                <div>have (tener), own, belong</div>
                            </div>
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
                            <li><strong>BE + ING = ahora mismo:</strong> Si hay BE + ING, la acción está pasando ahora</li>
                            <li><strong>"AM/IS/ARE" + gerundio:</strong> Siempre necesitas una forma de BE antes del verbo con -ING</li>
                            <li><strong>Piensa en una foto:</strong> El presente continuo describe lo que verías en una foto tomada ahora</li>
                            <li><strong>Uso de NOW:</strong> Si puedes agregar "now" a la oración, probablemente es presente continuo</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="game-controls">
                <button class="control-button" onclick="startGame()">
                    <i class="fas fa-play"></i> Practicar Presente Continuo
                </button>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            window.location.href = '../index.html';
        }
        
        function startGame() {
            window.location.href = '../games/present-continuous.php';
        }
    </script>
</body>
</html>