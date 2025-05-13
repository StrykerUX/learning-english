<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presente Simple - Teoría</title>
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
        
        .verb-table {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            overflow: hidden;
            margin: 1rem 0;
        }
        
        .verb-table-header {
            background: rgba(0, 255, 255, 0.1);
            padding: 0.8rem;
            font-weight: bold;
            color: #0ff;
            text-align: center;
        }
        
        .verb-table-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            border-bottom: 1px solid #333;
        }
        
        .verb-table-cell {
            padding: 0.8rem;
            border-right: 1px solid #333;
        }
        
        .verb-table-cell:last-child {
            border-right: none;
        }
        
        .highlight-verb {
            color: #ffd700;
            font-weight: bold;
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
                <h1>El Presente Simple en Inglés</h1>
                <p>Domina la base fundamental de la gramática inglesa</p>
            </div>
            
            <div class="content-section">
                <h2 class="section-title">
                    <i class="fas fa-info-circle"></i>
                    ¿Qué es el Presente Simple?
                </h2>
                <div class="note">
                    El presente simple es el tiempo verbal más básico e importante del inglés. Se usa para hablar de:
                    <ul style="margin-left: 1.5rem; margin-top: 1rem; line-height: 1.8;">
                        <li><strong>Rutinas y hábitos:</strong> I brush my teeth every morning</li>
                        <li><strong>Hechos generales:</strong> The Earth revolves around the Sun</li>
                        <li><strong>Estados permanentes:</strong> She lives in London</li>
                        <li><strong>Horarios y programas:</strong> The train leaves at 8:00 AM</li>
                    </ul>
                </div>
            </div>
            
            <div class="content-section">
                <h2 class="section-title">
                    <i class="fas fa-cogs"></i>
                    Formación del Presente Simple
                </h2>
                
                <div class="rule-card">
                    <div class="rule-title">
                        <i class="fas fa-user"></i>
                        Para I, You, We, They
                    </div>
                    <div class="formula-box">
                        <div class="formula">Sujeto + Verbo (sin cambios)</div>
                    </div>
                    <div class="example-grid">
                        <div class="example-card">
                            <div class="example-title">Ejemplos:</div>
                            <div class="example-sentence">I <span class="highlight-verb">play</span> soccer</div>
                            <div class="example-translation">Yo juego fútbol</div>
                            <div class="example-sentence">They <span class="highlight-verb">study</span> English</div>
                            <div class="example-translation">Ellos estudian inglés</div>
                        </div>
                    </div>
                </div>
                
                <div class="rule-card">
                    <div class="rule-title">
                        <i class="fas fa-user-circle"></i>
                        Para He, She, It
                    </div>
                    <div class="formula-box">
                        <div class="formula">Sujeto + Verbo + S/ES</div>
                    </div>
                    <div class="example-grid">
                        <div class="example-card">
                            <div class="example-title">Con S:</div>
                            <div class="example-sentence">He <span class="highlight-verb">plays</span> soccer</div>
                            <div class="example-translation">Él juega fútbol</div>
                            <div class="example-sentence">She <span class="highlight-verb">reads</span> books</div>
                            <div class="example-translation">Ella lee libros</div>
                        </div>
                        <div class="example-card">
                            <div class="example-title">Con ES:</div>
                            <div class="example-sentence">She <span class="highlight-verb">watches</span> TV</div>
                            <div class="example-translation">Ella ve televisión</div>
                            <div class="example-sentence">He <span class="highlight-verb">goes</span> to school</div>
                            <div class="example-translation">Él va a la escuela</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="content-section">
                <h2 class="section-title">
                    <i class="fas fa-list"></i>
                    Reglas para Agregar S/ES
                </h2>
                
                <div class="verb-table">
                    <div class="verb-table-header">Reglas de Terminación</div>
                    <div class="verb-table-row">
                        <div class="verb-table-cell">
                            <strong>Condición</strong>
                        </div>
                        <div class="verb-table-cell">
                            <strong>Regla</strong>
                        </div>
                    </div>
                    <div class="verb-table-row">
                        <div class="verb-table-cell">Verbos regulares</div>
                        <div class="verb-table-cell">
                            Agregar <span class="highlight-verb">S</span><br>
                            <em>play → plays, eat → eats</em>
                        </div>
                    </div>
                    <div class="verb-table-row">
                        <div class="verb-table-cell">Termina en S, SH, CH, X, Z, O</div>
                        <div class="verb-table-cell">
                            Agregar <span class="highlight-verb">ES</span><br>
                            <em>watch → watches, go → goes</em>
                        </div>
                    </div>
                    <div class="verb-table-row">
                        <div class="verb-table-cell">Termina en Y (después de consonante)</div>
                        <div class="verb-table-cell">
                            Cambiar Y por <span class="highlight-verb">IES</span><br>
                            <em>study → studies, carry → carries</em>
                        </div>
                    </div>
                    <div class="verb-table-row">
                        <div class="verb-table-cell">Termina en Y (después de vocal)</div>
                        <div class="verb-table-cell">
                            Agregar <span class="highlight-verb">S</span><br>
                            <em>play → plays, say → says</em>
                        </div>
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
                        <div class="example-title">Frecuencia:</div>
                        <div>• Always (siempre)</div>
                        <div>• Usually (usualmente)</div>
                        <div>• Often (a menudo)</div>
                        <div>• Sometimes (a veces)</div>
                        <div>• Rarely (raramente)</div>
                        <div>• Never (nunca)</div>
                    </div>
                    <div class="example-card">
                        <div class="example-title">Tiempo específico:</div>
                        <div>• Every day (cada día)</div>
                        <div>• Every week (cada semana)</div>
                        <div>• On Mondays (los lunes)</div>
                        <div>• Once a week (una vez por semana)</div>
                        <div>• Twice a month (dos veces al mes)</div>
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
                        Error 1: Olvidar la S en tercera persona
                    </div>
                    <div class="example-grid">
                        <div class="example-card" style="border-color: #dc2626;">
                            <div class="example-title" style="color: #dc2626;">❌ Incorrecto:</div>
                            <div class="example-sentence">She play tennis</div>
                        </div>
                        <div class="example-card" style="border-color: #16a34a;">
                            <div class="example-title" style="color: #16a34a;">✅ Correcto:</div>
                            <div class="example-sentence">She plays tennis</div>
                        </div>
                    </div>
                </div>
                
                <div class="rule-card">
                    <div class="rule-title">
                        <i class="fas fa-times-circle"></i>
                        Error 2: Agregar S a otras personas
                    </div>
                    <div class="example-grid">
                        <div class="example-card" style="border-color: #dc2626;">
                            <div class="example-title" style="color: #dc2626;">❌ Incorrecto:</div>
                            <div class="example-sentence">I plays tennis</div>
                        </div>
                        <div class="example-card" style="border-color: #16a34a;">
                            <div class="example-title" style="color: #16a34a;">✅ Correcto:</div>
                            <div class="example-sentence">I play tennis</div>
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
                        Trucos Mnemotécnicos
                    </div>
                    <div class="note">
                        <ul style="margin-left: 1rem; line-height: 1.8;">
                            <li><strong>"S para She/He/It":</strong> Recuerda que solo estos tres necesitan S</li>
                            <li><strong>"Tercera persona = Tercera letra (S)":</strong> He/She/It son tercera persona</li>
                            <li><strong>"Los demás normal":</strong> I/You/We/They usan el verbo sin cambios</li>
                        </ul>
                    </div>
                </div>
                
                <div class="rule-card">
                    <div class="rule-title">
                        <i class="fas fa-practice"></i>
                        Método de Práctica
                    </div>
                    <div class="note">
                        <ol style="margin-left: 1rem; line-height: 1.8;">
                            <li>Elige un verbo (ejemplo: "eat")</li>
                            <li>Conjugalo con cada pronombre:</li>
                            <div style="margin-left: 2rem; margin-top: 0.5rem;">
                                I eat, You eat, He/She/It eats<br>
                                We eat, You eat, They eat
                            </div>
                            <li>Repite con diferentes verbos diariamente</li>
                        </ol>
                    </div>
                </div>
            </div>
            
            <div class="game-controls">
                <button class="control-button" onclick="startGame()">
                    <i class="fas fa-play"></i> Practicar Presente Simple
                </button>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            window.location.href = '../index.html';
        }
        
        function startGame() {
            window.location.href = '../games/present-simple.php';
        }
    </script>
</body>
</html>