<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Palabras Básicas - Teoría</title>
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
        
        .word-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .word-item {
            background: #1a1a1a;
            padding: 1rem;
            border-radius: 8px;
            border: 2px solid #333;
            text-align: center;
        }
        
        .english-word {
            color: #ffd700;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .spanish-word {
            color: #ccc;
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }
        
        .pronunciation {
            color: #888;
            font-style: italic;
            font-size: 0.9rem;
        }
        
        .tip-box {
            background: rgba(16, 185, 129, 0.1);
            border: 2px solid #10b981;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        
        .tip-title {
            color: #10b981;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .note {
            color: #ccc;
            line-height: 1.6;
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
                <h1>Palabras Básicas del Inglés</h1>
                <p>Aprende las 20 palabras más esenciales para comenzar</p>
            </div>
            
            <div class="content-section">
                <h2 class="section-title">
                    <i class="fas fa-lightbulb"></i>
                    ¿Por qué son importantes?
                </h2>
                <div class="note">
                    Estas palabras básicas forman la base del vocabulario inglés. Son las palabras que usarás con mayor frecuencia en conversaciones diarias. Dominar estas palabras te dará la confianza para empezar a comunicarte en inglés.
                </div>
            </div>
            
            <div class="content-section">
                <h2 class="section-title">
                    <i class="fas fa-book-open"></i>
                    Lista de Palabras Básicas
                </h2>
                
                <h3 style="color: #0ff; margin-bottom: 1rem;">Saludos y Cortesía</h3>
                <div class="word-list">
                    <div class="word-item">
                        <div class="english-word">Hello</div>
                        <div class="spanish-word">Hola</div>
                        <div class="pronunciation">/həˈloʊ/</div>
                    </div>
                    <div class="word-item">
                        <div class="english-word">Goodbye</div>
                        <div class="spanish-word">Adiós</div>
                        <div class="pronunciation">/ɡʊdˈbaɪ/</div>
                    </div>
                    <div class="word-item">
                        <div class="english-word">Please</div>
                        <div class="spanish-word">Por favor</div>
                        <div class="pronunciation">/pliːz/</div>
                    </div>
                    <div class="word-item">
                        <div class="english-word">Thank you</div>
                        <div class="spanish-word">Gracias</div>
                        <div class="pronunciation">/θæŋk juː/</div>
                    </div>
                </div>
                
                <h3 style="color: #0ff; margin-bottom: 1rem;">Respuestas Básicas</h3>
                <div class="word-list">
                    <div class="word-item">
                        <div class="english-word">Yes</div>
                        <div class="spanish-word">Sí</div>
                        <div class="pronunciation">/jɛs/</div>
                    </div>
                    <div class="word-item">
                        <div class="english-word">No</div>
                        <div class="spanish-word">No</div>
                        <div class="pronunciation">/noʊ/</div>
                    </div>
                </div>
                
                <h3 style="color: #0ff; margin-bottom: 1rem;">Necesidades Básicas</h3>
                <div class="word-list">
                    <div class="word-item">
                        <div class="english-word">Water</div>
                        <div class="spanish-word">Agua</div>
                        <div class="pronunciation">/ˈwɔːtər/</div>
                    </div>
                    <div class="word-item">
                        <div class="english-word">Food</div>
                        <div class="spanish-word">Comida</div>
                        <div class="pronunciation">/fuːd/</div>
                    </div>
                    <div class="word-item">
                        <div class="english-word">Help</div>
                        <div class="spanish-word">Ayuda</div>
                        <div class="pronunciation">/hɛlp/</div>
                    </div>
                </div>
                
                <h3 style="color: #0ff; margin-bottom: 1rem;">Lugares y Cosas</h3>
                <div class="word-list">
                    <div class="word-item">
                        <div class="english-word">House</div>
                        <div class="spanish-word">Casa</div>
                        <div class="pronunciation">/haʊs/</div>
                    </div>
                    <div class="word-item">
                        <div class="english-word">Work</div>
                        <div class="spanish-word">Trabajo</div>
                        <div class="pronunciation">/wɜːrk/</div>
                    </div>
                    <div class="word-item">
                        <div class="english-word">Time</div>
                        <div class="spanish-word">Tiempo</div>
                        <div class="pronunciation">/taɪm/</div>
                    </div>
                </div>
                
                <h3 style="color: #0ff; margin-bottom: 1rem;">Personas y Relaciones</h3>
                <div class="word-list">
                    <div class="word-item">
                        <div class="english-word">Friend</div>
                        <div class="spanish-word">Amigo</div>
                        <div class="pronunciation">/frɛnd/</div>
                    </div>
                    <div class="word-item">
                        <div class="english-word">Family</div>
                        <div class="spanish-word">Familia</div>
                        <div class="pronunciation">/ˈfæməli/</div>
                    </div>
                    <div class="word-item">
                        <div class="english-word">Person</div>
                        <div class="spanish-word">Persona</div>
                        <div class="pronunciation">/ˈpɜːrsən/</div>
                    </div>
                </div>
                
                <h3 style="color: #0ff; margin-bottom: 1rem;">Descriptores Básicos</h3>
                <div class="word-list">
                    <div class="word-item">
                        <div class="english-word">New</div>
                        <div class="spanish-word">Nuevo</div>
                        <div class="pronunciation">/nuː/</div>
                    </div>
                    <div class="word-item">
                        <div class="english-word">Good</div>
                        <div class="spanish-word">Bueno</div>
                        <div class="pronunciation">/ɡʊd/</div>
                    </div>
                    <div class="word-item">
                        <div class="english-word">Big</div>
                        <div class="spanish-word">Grande</div>
                        <div class="pronunciation">/bɪɡ/</div>
                    </div>
                    <div class="word-item">
                        <div class="english-word">Small</div>
                        <div class="spanish-word">Pequeño</div>
                        <div class="pronunciation">/smɔːl/</div>
                    </div>
                </div>
                
                <h3 style="color: #0ff; margin-bottom: 1rem;">Emociones</h3>
                <div class="word-list">
                    <div class="word-item">
                        <div class="english-word">Love</div>
                        <div class="spanish-word">Amor</div>
                        <div class="pronunciation">/lʌv/</div>
                    </div>
                </div>
            </div>
            
            <div class="content-section">
                <h2 class="section-title">
                    <i class="fas fa-tips"></i>
                    Consejos para Memorizar
                </h2>
                
                <div class="tip-box">
                    <div class="tip-title">1. Repite en voz alta</div>
                    <div class="note">Practica la pronunciación de cada palabra varias veces. Esto te ayudará a recordarla mejor.</div>
                </div>
                
                <div class="tip-box">
                    <div class="tip-title">2. Usa las palabras en oraciones</div>
                    <div class="note">Crea oraciones simples usando estas palabras para entender mejor su uso.</div>
                </div>
                
                <div class="tip-box">
                    <div class="tip-title">3. Practica diariamente</div>
                    <div class="note">Dedica 10-15 minutos cada día a repasar estas palabras básicas.</div>
                </div>
                
                <div class="tip-box">
                    <div class="tip-title">4. Asocia con imágenes</div>
                    <div class="note">Crea asociaciones mentales entre la palabra en inglés y su significado.</div>
                </div>
            </div>
            
            <div class="game-controls">
                <button class="control-button" onclick="startGame()">
                    <i class="fas fa-play"></i> Practicar Ahora
                </button>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            window.location.href = '../index.html';
        }
        
        function startGame() {
            window.location.href = '../games/vocabulary-basic.php';
        }
    </script>
</body>
</html>