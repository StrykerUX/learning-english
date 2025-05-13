<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preposiciones - Teoría</title>
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
        
        .preposition-card {
            background: #1a1a1a;
            border: 2px solid #333;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .preposition-title {
            color: #ffd700;
            font-size: 1.3rem;
            font-weight: bold;
            margin-bottom: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .visual-demo {
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 10px;
            padding: 1.5rem;
            margin: 1rem 0;
            font-size: 2rem;
        }
        
        .demo-description {
            text-align: center;
            color: #ccc;
            font-style: italic;
            margin-top: 0.5rem;
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
        
        .highlight-prep {
            color: #ffd700;
            font-weight: bold;
            background: rgba(255, 215, 0, 0.2);
            padding: 0.2rem 0.5rem;
            border-radius: 3px;
        }
        
        .preposition-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }
        
        .category-card {
            background: rgba(255, 255, 255, 0.03);
            border: 2px solid #444;
            border-radius: 10px;
            padding: 1.5rem;
        }
        
        .category-title {
            color: #0ff;
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 1rem;
            text-align: center;
        }
        
        .prep-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 5px;
            margin-bottom: 0.5rem;
        }
        
        .prep-english {
            color: #ffd700;
            font-weight: bold;
        }
        
        .prep-spanish {
            color: #ccc;
        }
        
        .trick-box {
            background: rgba(16, 185, 129, 0.1);
            border: 2px solid #10b981;
            border-radius: 10px;
            padding: 1rem;
            margin: 1rem 0;
        }
        
        .trick-title {
            color: #10b981;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .common-errors {
            background: rgba(220, 38, 38, 0.1);
            border: 2px solid #dc2626;
            border-radius: 10px;
            padding: 1rem;
            margin: 1rem 0;
        }
        
        .error-title {
            color: #dc2626;
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
                <h1>Preposiciones en Inglés</h1>
                <p>Aprende dónde están las cosas con las preposiciones</p>
            </div>
            
            <div class="content-section">
                <h2 class="section-title">
                    <i class="fas fa-info-circle"></i>
                    ¿Qué son las Preposiciones?
                </h2>
                <div class="note">
                    Las preposiciones son palabras pequeñas pero importantes que nos ayudan a:
                    <ul style="margin-left: 1.5rem; margin-top: 1rem; line-height: 1.8;">
                        <li><strong>Indicar posición:</strong> The book is <strong>on</strong> the table</li>
                        <li><strong>Mostrar dirección:</strong> We're going <strong>to</strong> the park</li>
                        <li><strong>Expresar tiempo:</strong> I'll see you <strong>in</strong> the morning</li>
                        <li><strong>Relacionar objetos:</strong> The cat is <strong>under</strong> the bed</li>
                    </ul>
                </div>
            </div>
            
            <div class="content-section">
                <h2 class="section-title">
                    <i class="fas fa-map"></i>
                    Preposiciones de Lugar Más Importantes
                </h2>
                
                <div class="preposition-card">
                    <div class="preposition-title">
                        <i class="fas fa-arrow-circle-up"></i>
                        ON (sobre, encima de)
                    </div>
                    <div class="visual-demo">
                        📚 🪑
                        <div class="demo-description">El libro está sobre la silla</div>
                    </div>
                    <div class="note">
                        Se usa cuando algo está en contacto directo con una superficie.
                    </div>
                    <div class="example-grid">
                        <div class="example-card">
                            <div class="example-title">Ejemplos:</div>
                            <div class="example-sentence">The cup is <span class="highlight-prep">on</span> the table</div>
                            <div class="example-translation">La taza está sobre la mesa</div>
                            <div class="example-sentence">Pictures <span class="highlight-prep">on</span> the wall</div>
                            <div class="example-translation">Cuadros en la pared</div>
                        </div>
                    </div>
                </div>
                
                <div class="preposition-card">
                    <div class="preposition-title">
                        <i class="fas fa-arrow-circle-down"></i>
                        UNDER (debajo de)
                    </div>
                    <div class="visual-demo">
                        🐕<br />🚗
                        <div class="demo-description">El perro está debajo del carro</div>
                    </div>
                    <div class="note">
                        Se usa cuando algo está por debajo de otra cosa.
                    </div>
                    <div class="example-grid">
                        <div class="example-card">
                            <div class="example-title">Ejemplos:</div>
                            <div class="example-sentence">The cat is <span class="highlight-prep">under</span> the bed</div>
                            <div class="example-translation">El gato está debajo de la cama</div>
                            <div class="example-sentence">Shoes <span class="highlight-prep">under</span> the table</div>
                            <div class="example-translation">Zapatos debajo de la mesa</div>
                        </div>
                    </div>
                </div>
                
                <div class="preposition-card">
                    <div class="preposition-title">
                        <i class="fas fa-box"></i>
                        IN (dentro de)
                    </div>
                    <div class="visual-demo">
                        🐱📦
                        <div class="demo-description">El gato está dentro de la caja</div>
                    </div>
                    <div class="note">
                        Se usa cuando algo está dentro de un espacio cerrado.
                    </div>
                    <div class="example-grid">
                        <div class="example-card">
                            <div class="example-title">Ejemplos:</div>
                            <div class="example-sentence">The milk is <span class="highlight-prep">in</span> the fridge</div>
                            <div class="example-translation">La leche está en el refrigerador</div>
                            <div class="example-sentence">She lives <span class="highlight-prep">in</span> London</div>
                            <div class="example-translation">Ella vive en Londres</div>
                        </div>
                    </div>
                </div>
                
                <div class="preposition-card">
                    <div class="preposition-title">
                        <i class="fas fa-arrows-alt-h"></i>
                        NEXT TO (al lado de)
                    </div>
                    <div class="visual-demo">
                        📱 🛋️
                        <div class="demo-description">El teléfono está al lado del sofá</div>
                    </div>
                    <div class="note">
                        Se usa cuando algo está al lado o cerca de otra cosa.
                    </div>
                    <div class="example-grid">
                        <div class="example-card">
                            <div class="example-title">Ejemplos:</div>
                            <div class="example-sentence">The bank is <span class="highlight-prep">next to</span> the pharmacy</div>
                            <div class="example-translation">El banco está al lado de la farmacia</div>
                            <div class="example-sentence">Sit <span class="highlight-prep">next to</span> me</div>
                            <div class="example-translation">Siéntate a mi lado</div>
                        </div>
                    </div>
                </div>
                
                <div class="preposition-card">
                    <div class="preposition-title">
                        <i class="fas fa-arrow-right"></i>
                        BEHIND (detrás de)
                    </div>
                    <div class="visual-demo">
                        🏠🌳
                        <div class="demo-description">La casa está detrás del árbol</div>
                    </div>
                    <div class="note">
                        Se usa cuando algo está detrás de otra cosa.
                    </div>
                    <div class="example-grid">
                        <div class="example-card">
                            <div class="example-title">Ejemplos:</div>
                            <div class="example-sentence">The car is <span class="highlight-prep">behind</span> the house</div>
                            <div class="example-translation">El carro está detrás de la casa</div>
                            <div class="example-sentence">Stand <span class="highlight-prep">behind</span> the line</div>
                            <div class="example-translation">Párate detrás de la línea</div>
                        </div>
                    </div>
                </div>
                
                <div class="preposition-card">
                    <div class="preposition-title">
                        <i class="fas fa-arrow-left"></i>
                        IN FRONT OF (delante de)
                    </div>
                    <div class="visual-demo">
                        🌺🪴
                        <div class="demo-description">La flor está delante de la planta</div>
                    </div>
                    <div class="note">
                        Se usa cuando algo está delante de otra cosa.
                    </div>
                    <div class="example-grid">
                        <div class="example-card">
                            <div class="example-title">Ejemplos:</div>
                            <div class="example-sentence">The car is <span class="highlight-prep">in front of</span> the store</div>
                            <div class="example-translation">El carro está delante de la tienda</div>
                            <div class="example-sentence">Wait <span class="highlight-prep">in front of</span> the building</div>
                            <div class="example-translation">Espera delante del edificio</div>
                        </div>
                    </div>
                </div>
                
                <div class="preposition-card">
                    <div class="preposition-title">
                        <i class="fas fa-exchange-alt"></i>
                        BETWEEN (entre)
                    </div>
                    <div class="visual-demo">
                        🖼️🔲🔲
                        <div class="demo-description">El cuadro está entre las ventanas</div>
                    </div>
                    <div class="note">
                        Se usa cuando algo está en el espacio que hay entre dos objetos.
                    </div>
                    <div class="example-grid">
                        <div class="example-card">
                            <div class="example-title">Ejemplos:</div>
                            <div class="example-sentence">The park is <span class="highlight-prep">between</span> the hospital and the school</div>
                            <div class="example-translation">El parque está entre el hospital y la escuela</div>
                            <div class="example-sentence">Choose <span class="highlight-prep">between</span> tea and coffee</div>
                            <div class="example-translation">Elige entre té y café</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="content-section">
                <h2 class="section-title">
                    <i class="fas fa-list"></i>
                    Lista Completa de Preposiciones Comunes
                </h2>
                
                <div class="preposition-grid">
                    <div class="category-card">
                        <div class="category-title">Lugar Básico</div>
                        <div class="prep-item">
                            <span class="prep-english">in</span>
                            <span class="prep-spanish">en, dentro de</span>
                        </div>
                        <div class="prep-item">
                            <span class="prep-english">on</span>
                            <span class="prep-spanish">en, sobre</span>
                        </div>
                        <div class="prep-item">
                            <span class="prep-english">at</span>
                            <span class="prep-spanish">en (lugar específico)</span>
                        </div>
                        <div class="prep-item">
                            <span class="prep-english">under</span>
                            <span class="prep-spanish">debajo de</span>
                        </div>
                        <div class="prep-item">
                            <span class="prep-english">above</span>
                            <span class="prep-spanish">encima de</span>
                        </div>
                    </div>
                    
                    <div class="category-card">
                        <div class="category-title">Posición Relativa</div>
                        <div class="prep-item">
                            <span class="prep-english">next to</span>
                            <span class="prep-spanish">al lado de</span>
                        </div>
                        <div class="prep-item">
                            <span class="prep-english">behind</span>
                            <span class="prep-spanish">detrás de</span>
                        </div>
                        <div class="prep-item">
                            <span class="prep-english">in front of</span>
                            <span class="prep-spanish">delante de</span>
                        </div>
                        <div class="prep-item">
                            <span class="prep-english">between</span>
                            <span class="prep-spanish">entre</span>
                        </div>
                        <div class="prep-item">
                            <span class="prep-english">among</span>
                            <span class="prep-spanish">entre (varios)</span>
                        </div>
                    </div>
                    
                    <div class="category-card">
                        <div class="category-title">Tiempo</div>
                        <div class="prep-item">
                            <span class="prep-english">at</span>
                            <span class="prep-spanish">en (hora exacta)</span>
                        </div>
                        <div class="prep-item">
                            <span class="prep-english">in</span>
                            <span class="prep-spanish">en (mes/año)</span>
                        </div>
                        <div class="prep-item">
                            <span class="prep-english">on</span>
                            <span class="prep-spanish">en (día específico)</span>
                        </div>
                        <div class="prep-item">
                            <span class="prep-english">during</span>
                            <span class="prep-spanish">durante</span>
                        </div>
                        <div class="prep-item">
                            <span class="prep-english">before</span>
                            <span class="prep-spanish">antes de</span>
                        </div>
                    </div>
                    
                    <div class="category-card">
                        <div class="category-title">Dirección/Movimiento</div>
                        <div class="prep-item">
                            <span class="prep-english">to</span>
                            <span class="prep-spanish">a, hacia</span>
                        </div>
                        <div class="prep-item">
                            <span class="prep-english">from</span>
                            <span class="prep-spanish">de, desde</span>
                        </div>
                        <div class="prep-item">
                            <span class="prep-english">through</span>
                            <span class="prep-spanish">a través de</span>
                        </div>
                        <div class="prep-item">
                            <span class="prep-english">into</span>
                            <span class="prep-spanish">dentro de</span>
                        </div>
                        <div class="prep-item">
                            <span class="prep-english">out of</span>
                            <span class="prep-spanish">fuera de</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="content-section">
                <h2 class="section-title">
                    <i class="fas fa-lightbulb"></i>
                    Consejos y Trucos
                </h2>
                
                <div class="trick-box">
                    <div class="trick-title">Truco de memorización:</div>
                    <div class="note">
                        <strong>"IN, ON, AT" para tiempo:</strong>
                        <br>• IN the morning/afternoon/evening (periodo general)
                        <br>• ON Monday/Tuesday... (día específico)
                        <br>• AT 3 o'clock (hora exacta)
                    </div>
                </div>
                
                <div class="trick-box">
                    <div class="trick-title">Truco visual:</div>
                    <div class="note">
                        <strong>Imagina las posiciones:</strong> Cuando aprendas una preposición, cierra los ojos y visualiza la relación espacial. Por ejemplo, imagina un gato "ON" una mesa, "UNDER" una silla, "IN" una caja.
                    </div>
                </div>
                
                <div class="trick-box">
                    <div class="trick-title">Práctica diaria:</div>
                    <div class="note">
                        <strong>Describe tu entorno:</strong> Cada día, describe dónde están las cosas en tu habitación usando preposiciones en inglés. "The lamp is ON the desk", "My shoes are UNDER the bed".
                    </div>
                </div>
            </div>
            
            <div class="content-section">
                <h2 class="section-title">
                    <i class="fas fa-exclamation-triangle"></i>
                    Errores Comunes
                </h2>
                
                <div class="common-errors">
                    <div class="error-title">Error 1: Confundir IN, ON, AT</div>
                    <div class="example-grid">
                        <div class="example-card" style="border-color: #dc2626;">
                            <div class="example-title" style="color: #dc2626;">❌ Incorrecto:</div>
                            <div>The book is at the table</div>
                            <div>I'll see you in Monday</div>
                            <div>Come on 3 o'clock</div>
                        </div>
                        <div class="example-card" style="border-color: #16a34a;">
                            <div class="example-title" style="color: #16a34a;">✅ Correcto:</div>
                            <div>The book is <strong>on</strong> the table</div>
                            <div>I'll see you <strong>on</strong> Monday</div>
                            <div>Come <strong>at</strong> 3 o'clock</div>
                        </div>
                    </div>
                </div>
                
                <div class="common-errors">
                    <div class="error-title">Error 2: Traducir directamente del español</div>
                    <div class="note">
                        No traduzcan directamente. "En la mesa" puede ser "ON the table" (encima) o "AT the table" (sentado).
                    </div>
                </div>
            </div>
            
            <div class="content-section">
                <h2 class="section-title">
                    <i class="fas fa-dumbbell"></i>
                    Ejercicio de Práctica
                </h2>
                
                <div class="note">
                    Mira a tu alrededor y describe en voz alta dónde están 5 objetos usando preposiciones diferentes:
                    <ol style="margin-left: 1.5rem; margin-top: 1rem; line-height: 1.8;">
                        <li>The computer is <strong>ON</strong> the desk</li>
                        <li>My bag is <strong>UNDER</strong> the chair</li>
                        <li>The keys are <strong>IN</strong> my pocket</li>
                        <li>The lamp is <strong>NEXT TO</strong> the bed</li>
                        <li>The picture is <strong>ABOVE</strong> the sofa</li>
                    </ol>
                </div>
            </div>
            
            <div class="game-controls">
                <button class="control-button" onclick="startGame()">
                    <i class="fas fa-play"></i> Practicar Preposiciones
                </button>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            window.location.href = '../index.html';
        }
        
        function startGame() {
            window.location.href = '../games/prepositions.php';
        }
    </script>
</body>
</html>