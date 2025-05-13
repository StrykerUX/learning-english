<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memorama - English Trainer</title>
    <link rel="stylesheet" href="../css/games.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Specific styles for larger memory grid */
        .memory-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: var(--space-sm);
            margin-bottom: var(--space-lg);
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .memory-card {
            aspect-ratio: 1;
            font-size: var(--font-size-sm);
        }
        
        @media (max-width: 768px) {
            .memory-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
        
        @media (max-width: 480px) {
            .memory-grid {
                grid-template-columns: repeat(3, 1fr);
            }
            
            .memory-card {
                font-size: var(--font-size-xs);
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
            <h1>Memorama</h1>
            <p>Encuentra las parejas de palabras en inglés y español</p>
        </div>
        
        <div class="game-stats">
            <div class="stat-item">
                <div class="score-label">Puntos</div>
                <div class="score-value" id="current-score">0</div>
            </div>
            <div class="stat-item">
                <div class="score-label">Movimientos</div>
                <div class="score-value" id="moves-count">0</div>
            </div>
            <div class="stat-item">
                <div class="score-label">Parejas</div>
                <div class="score-value" id="pairs-found">0</div>
            </div>
            <div class="stat-item">
                <div class="score-label">Tiempo</div>
                <div class="score-value" id="timer">00:00</div>
            </div>
        </div>
        
        <div class="memory-grid" id="memory-grid">
            <!-- Cards will be generated here -->
        </div>
        
        <div class="game-controls">
            <button class="control-button" onclick="restartGame()">
                <i class="fas fa-redo"></i> Reiniciar
            </button>
        </div>
    </div>
    
    <div class="results-panel" id="results-panel">
        <h2>¡Juego Completado!</h2>
        <div class="stars-display" id="stars-display"></div>
        <p>Puntuación Final: <span id="final-score"></span></p>
        <p>Tiempo: <span id="final-time"></span></p>
        <p>Movimientos: <span id="final-moves"></span></p>
        <div class="game-controls">
            <button class="control-button" onclick="restartGame()">
                <i class="fas fa-redo"></i> Jugar de Nuevo
            </button>
            <button class="control-button" onclick="goToMenu()" style="background: var(--purple-bright); color: white;">
                <i class="fas fa-home"></i> Volver al Menú
            </button>
            <button class="control-button" onclick="continueToNextLevel(2)">
                <i class="fas fa-arrow-right"></i> Siguiente Nivel
            </button>
        </div>
    </div>

    <script src="../js/games.js"></script>
    <script>
        // Expanded vocabulary with varying difficulty levels
        const vocabulary = [
            // EASY - Palabras básicas
            { english: 'Cat', spanish: 'Gato' },
            { english: 'Dog', spanish: 'Perro' },
            { english: 'House', spanish: 'Casa' },
            { english: 'Water', spanish: 'Agua' },
            { english: 'Fire', spanish: 'Fuego' },
            
            // MEDIUM - Palabras intermedias
            { english: 'Beautiful', spanish: 'Hermoso' },
            { english: 'Important', spanish: 'Importante' },
            { english: 'Dangerous', spanish: 'Peligroso' },
            { english: 'Education', spanish: 'Educación' },
            { english: 'Government', spanish: 'Gobierno' },
            
            // HARD - Palabras difíciles
            { english: 'Responsibility', spanish: 'Responsabilidad' },
            { english: 'Consciousness', spanish: 'Conciencia' },
            { english: 'Sophisticated', spanish: 'Sofisticado' },
            { english: 'Extraordinary', spanish: 'Extraordinario' },
            { english: 'Entrepreneur', spanish: 'Empresario' },
            { english: 'Sophisticated', spanish: 'Sofisticado' }
        ];

        // Game state
        let cards = [];
        let flippedCards = [];
        let matchedPairs = 0;
        let moves = 0;
        let score = 0;
        let startTime = 0;
        let gameTime = 0;
        let timerInterval = null;
        let gameCompleted = false;

        // Initialize game
        function initGame() {
            cards = [];
            flippedCards = [];
            matchedPairs = 0;
            moves = 0;
            score = 0;
            startTime = Date.now();
            gameTime = 0;
            gameCompleted = false;
            
            createCards();
            shuffleCards();
            displayCards();
            startTimer();
            updateDisplay();
        }

        // Create card pairs
        function createCards() {
            vocabulary.forEach((item, index) => {
                // English card
                cards.push({
                    id: index * 2,
                    type: 'english',
                    text: item.english,
                    matched: false,
                    flipped: false,
                    pairId: index
                });
                
                // Spanish card
                cards.push({
                    id: index * 2 + 1,
                    type: 'spanish',
                    text: item.spanish,
                    matched: false,
                    flipped: false,
                    pairId: index
                });
            });
        }

        // Shuffle cards
        function shuffleCards() {
            cards = shuffleArray(cards);
        }

        // Display cards
        function displayCards() {
            const grid = document.getElementById('memory-grid');
            grid.innerHTML = '';
            
            cards.forEach(card => {
                const cardElement = document.createElement('div');
                cardElement.className = 'memory-card';
                cardElement.dataset.id = card.id;
                
                cardElement.innerHTML = `
                    <div class="card-front">
                        <i class="fas fa-brain"></i>
                    </div>
                    <div class="card-back">
                        ${card.text}
                    </div>
                `;
                
                cardElement.onclick = () => flipCard(card.id);
                grid.appendChild(cardElement);
            });
        }

        // Flip card
        function flipCard(cardId) {
            const card = cards.find(c => c.id === cardId);
            const cardElement = document.querySelector(`.memory-card[data-id="${cardId}"]`);
            
            // Don't flip if already flipped, matched, or two cards are already flipped
            if (card.flipped || card.matched || flippedCards.length >= 2) {
                return;
            }
            
            // Flip the card
            card.flipped = true;
            cardElement.classList.add('flipped');
            flippedCards.push(card);
            
            // Check for match when two cards are flipped
            if (flippedCards.length === 2) {
                moves++;
                setTimeout(checkMatch, 800);
            }
        }

        // Check if flipped cards match
        function checkMatch() {
            const [card1, card2] = flippedCards;
            
            if (card1.pairId === card2.pairId) {
                // Match found!
                card1.matched = true;
                card2.matched = true;
                matchedPairs++;
                
                // Different points based on word difficulty
                const word = vocabulary[card1.pairId];
                let points = 20;
                if (word.english.length > 10) points = 30; // Hard words
                else if (word.english.length > 6) points = 25; // Medium words
                
                score += points;
                
                // Add visual feedback
                const element1 = document.querySelector(`.memory-card[data-id="${card1.id}"]`);
                const element2 = document.querySelector(`.memory-card[data-id="${card2.id}"]`);
                
                element1.classList.add('matched');
                element2.classList.add('matched');
                
                pulseElement(element1, 'var(--green-bright)');
                pulseElement(element2, 'var(--green-bright)');
                
                showNotification(`¡Pareja encontrada! +${points} puntos`, 'success');
                
                // Check if game is complete
                if (matchedPairs === vocabulary.length) {
                    endGame();
                }
            } else {
                // No match
                score = Math.max(0, score - 3);
                
                // Add mismatch animation
                const element1 = document.querySelector(`.memory-card[data-id="${card1.id}"]`);
                const element2 = document.querySelector(`.memory-card[data-id="${card2.id}"]`);
                
                element1.classList.add('mismatched');
                element2.classList.add('mismatched');
                
                showNotification('No es pareja. Inténtalo de nuevo.', 'warning');
                
                setTimeout(() => {
                    // Flip cards back
                    card1.flipped = false;
                    card2.flipped = false;
                    element1.classList.remove('flipped', 'mismatched');
                    element2.classList.remove('flipped', 'mismatched');
                }, 500);
            }
            
            flippedCards = [];
            updateDisplay();
        }

        // Start timer
        function startTimer() {
            timerInterval = setInterval(() => {
                gameTime = Date.now() - startTime;
                document.getElementById('timer').textContent = formatTime(gameTime);
            }, 1000);
        }

        // Update display
        function updateDisplay() {
            document.getElementById('current-score').textContent = score;
            document.getElementById('moves-count').textContent = moves;
            document.getElementById('pairs-found').textContent = matchedPairs;
        }

        // End game
        function endGame() {
            gameCompleted = true;
            clearInterval(timerInterval);
            
            // Calculate bonuses
            const timeBonus = Math.max(0, 600 - Math.floor(gameTime / 1000)); // More time for more cards
            const moveBonus = Math.max(0, (vocabulary.length * 2 - moves) * 5);
            score += timeBonus + moveBonus;
            
            // Calculate stars (adjusted for harder difficulty)
            let stars = 1;
            if (score >= 350 && moves <= vocabulary.length * 1.8) stars = 2;
            if (score >= 500 && moves <= vocabulary.length * 1.5) stars = 3;
            
            // Update results
            document.getElementById('final-score').textContent = score;
            document.getElementById('final-time').textContent = document.getElementById('timer').textContent;
            document.getElementById('final-moves').textContent = moves;
            
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
            handleLevelCompletion(2, score, stars);
            
            showNotification('¡Juego completado! Excelente memoria', 'success');
        }

        // Restart game
        function restartGame() {
            document.getElementById('results-panel').classList.remove('visible');
            clearInterval(timerInterval);
            initGame();
        }

        // Initialize game on load
        document.addEventListener('DOMContentLoaded', () => {
            initGame();
        });
    </script>
</body>
</html>