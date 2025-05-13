<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memorama - English Trainer</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .game-container {
            max-width: 900px;
            margin: 2rem auto;
            padding: 2rem;
            background: rgba(0, 0, 0, 0.8);
            border: 3px solid #0ff;
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }
        
        .game-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .game-stats {
            display: flex;
            justify-content: space-around;
            margin-bottom: 2rem;
            gap: 1rem;
        }
        
        .stat-item {
            background: #1a1a1a;
            padding: 1rem;
            border-radius: 10px;
            border: 2px solid #333;
            text-align: center;
            flex: 1;
        }
        
        .memory-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .memory-card {
            aspect-ratio: 1;
            background: #1a1a1a;
            border: 3px solid #333;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.2rem;
            font-weight: bold;
            color: #fff;
            position: relative;
            overflow: hidden;
        }
        
        .memory-card:hover {
            border-color: #0ff;
            background: rgba(0, 255, 255, 0.1);
        }
        
        .memory-card.flipped {
            background: rgba(0, 255, 255, 0.2);
            border-color: #0ff;
        }
        
        .memory-card.matched {
            background: rgba(34, 197, 94, 0.3);
            border-color: #16a34a;
        }
        
        .memory-card.mismatched {
            background: rgba(220, 38, 38, 0.3);
            border-color: #991b1b;
            animation: shake 0.5s ease-in-out;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        .card-front {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #1a1a1a;
            transition: transform 0.3s ease;
        }
        
        .card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(0, 255, 255, 0.1);
            transform: rotateY(180deg);
            transition: transform 0.3s ease;
        }
        
        .memory-card.flipped .card-front {
            transform: rotateY(-180deg);
        }
        
        .memory-card.flipped .card-back {
            transform: rotateY(0);
        }
        
        .game-controls {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }
        
        .control-button {
            padding: 0.8rem 1.5rem;
            border: 2px solid #0ff;
            background: transparent;
            color: #0ff;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Orbitron', monospace;
        }
        
        .control-button:hover {
            background: #0ff;
            color: #000;
        }
        
        .results-panel {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0);
            background: rgba(0, 0, 0, 0.95);
            border: 3px solid #0ff;
            border-radius: 15px;
            padding: 2rem;
            text-align: center;
            z-index: 1000;
            transition: transform 0.3s ease;
        }
        
        .results-panel.visible {
            transform: translate(-50%, -50%) scale(1);
        }
        
        .stars-display {
            font-size: 3rem;
            margin: 1rem 0;
        }
    </style>
</head>
<body>
    <div class="universe">
        <div class="stars-bg"></div>
        
        <div class="game-container">
            <button class="back-button control-button" onclick="goHome()">
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
                <button class="control-button" onclick="goHome()">
                    <i class="fas fa-home"></i> Menú Principal
                </button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Game data - simplified vocabulary
        const vocabulary = [
            { english: 'Cat', spanish: 'Gato' },
            { english: 'Dog', spanish: 'Perro' },
            { english: 'House', spanish: 'Casa' },
            { english: 'Car', spanish: 'Coche' },
            { english: 'Book', spanish: 'Libro' },
            { english: 'Apple', spanish: 'Manzana' },
            { english: 'Tree', spanish: 'Árbol' },
            { english: 'Sun', spanish: 'Sol' }
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
            for (let i = cards.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [cards[i], cards[j]] = [cards[j], cards[i]];
            }
        }

        // Display cards
        function displayCards() {
            const grid = $('#memory-grid');
            grid.empty();
            
            cards.forEach(card => {
                const cardElement = $(`
                    <div class="memory-card" data-id="${card.id}">
                        <div class="card-front">
                            <i class="fas fa-question"></i>
                        </div>
                        <div class="card-back">
                            ${card.text}
                        </div>
                    </div>
                `);
                
                cardElement.click(() => flipCard(card.id));
                grid.append(cardElement);
            });
        }

        // Flip card
        function flipCard(cardId) {
            const card = cards.find(c => c.id === cardId);
            const cardElement = $(`.memory-card[data-id="${cardId}"]`);
            
            // Don't flip if already flipped, matched, or two cards are already flipped
            if (card.flipped || card.matched || flippedCards.length >= 2) {
                return;
            }
            
            // Flip the card
            card.flipped = true;
            cardElement.addClass('flipped');
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
                score += 20;
                
                // Add visual feedback
                $(`.memory-card[data-id="${card1.id}"]`).addClass('matched');
                $(`.memory-card[data-id="${card2.id}"]`).addClass('matched');
                
                // Check if game is complete
                if (matchedPairs === vocabulary.length) {
                    endGame();
                }
            } else {
                // No match
                score = Math.max(0, score - 2);
                
                // Add mismatch animation
                $(`.memory-card[data-id="${card1.id}"]`).addClass('mismatched');
                $(`.memory-card[data-id="${card2.id}"]`).addClass('mismatched');
                
                setTimeout(() => {
                    // Flip cards back
                    card1.flipped = false;
                    card2.flipped = false;
                    $(`.memory-card[data-id="${card1.id}"]`).removeClass('flipped mismatched');
                    $(`.memory-card[data-id="${card2.id}"]`).removeClass('flipped mismatched');
                }, 500);
            }
            
            flippedCards = [];
            updateDisplay();
        }

        // Start timer
        function startTimer() {
            timerInterval = setInterval(() => {
                gameTime = Date.now() - startTime;
                const minutes = Math.floor(gameTime / 60000);
                const seconds = Math.floor((gameTime % 60000) / 1000);
                $('#timer').text(`${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`);
            }, 1000);
        }

        // Update display
        function updateDisplay() {
            $('#current-score').text(score);
            $('#moves-count').text(moves);
            $('#pairs-found').text(matchedPairs);
        }

        // End game
        function endGame() {
            gameCompleted = true;
            clearInterval(timerInterval);
            
            // Calculate stars based on performance
            const timeBonus = Math.max(0, 300 - Math.floor(gameTime / 1000));
            const moveBonus = Math.max(0, (vocabulary.length * 2 - moves) * 5);
            score += timeBonus + moveBonus;
            
            let stars = 1;
            if (score >= 180 && moves <= vocabulary.length * 1.5) stars = 2;
            if (score >= 220 && moves <= vocabulary.length * 1.2) stars = 3;
            
            // Update results
            $('#final-score').text(score);
            $('#final-time').text($('#timer').text());
            $('#final-moves').text(moves);
            
            let starsHtml = '';
            for (let i = 0; i < 3; i++) {
                if (i < stars) {
                    starsHtml += '<i class="fas fa-star" style="color: #ffd700;"></i>';
                } else {
                    starsHtml += '<i class="far fa-star" style="color: #333;"></i>';
                }
            }
            $('#stars-display').html(starsHtml);
            
            // Show results panel
            $('#results-panel').addClass('visible');
            
            // Notify parent window about completion
            if (window.opener && window.opener.onGameComplete) {
                window.opener.onGameComplete(2, score, stars);
            }
        }

        // Restart game
        function restartGame() {
            $('#results-panel').removeClass('visible');
            clearInterval(timerInterval);
            initGame();
        }

        // Go to home
        function goHome() {
            window.location.href = '../index.php';
        }

        // Initialize game on load
        $(document).ready(() => {
            initGame();
        });
    </script>
</body>
</html>