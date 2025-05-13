// English Trainer - Adventure Mode JavaScript
$(document).ready(function() {
    // Game configuration and data
    const gameConfig = {
        1: {
            name: 'Palabras Básicas',
            description: 'Aprende las 20 palabras más esenciales del inglés. Construye tu vocabulario base palabra por palabra.',
            game: 'vocabulary-basic',
            theory: 'theory/basic-words.php'
        },
        2: {
            name: 'Memorama',
            description: 'Encuentra las parejas de palabras y sus traducciones. ¡Un juego divertido para memorizar!',
            game: 'memory-game',
            theory: 'theory/memory-tips.php'
        },
        3: {
            name: 'Ahorcado',
            description: 'Adivina la palabra oculta letra por letra. ¡Cuidado con no ahorcar al muñeco!',
            game: 'hangman',
            theory: 'theory/spelling-tips.php'
        },
        4: {
            name: 'Presente Simple',
            description: 'Domina las rutinas y hechos con el presente simple. Base fundamental de la gramática.',
            game: 'present-simple',
            theory: 'theory/present-simple.php'
        },
        5: {
            name: 'Presente Continuo',
            description: 'Aprende a hablar de acciones que ocurren ahora mismo con el presente continuo.',
            game: 'present-continuous',
            theory: 'theory/present-continuous.php'
        },
        6: {
            name: 'Pasado Simple',
            description: 'Cuenta eventos del pasado con claridad usando el pasado simple.',
            game: 'past-simple',
            theory: 'theory/past-simple.php'
        },
        7: {
            name: 'Futuro Simple',
            description: 'Expresa planes y predicciones del futuro con confianza.',
            game: 'future-simple',
            theory: 'theory/future-simple.php'
        },
        8: {
            name: 'Preposiciones',
            description: 'Encuentra la posición correcta de los objetos. ¡Las preposiciones son clave!',
            game: 'prepositions',
            theory: 'theory/prepositions.php'
        }
    };

    // Game state management
    let gameState = {
        unlockedLevels: [1],
        completedLevels: [],
        levelProgress: {},
        totalPoints: 0,
        totalStars: 0
    };

    // Load saved progress from localStorage
    function loadGameState() {
        const saved = localStorage.getItem('englishTrainerProgress');
        if (saved) {
            try {
                gameState = { ...gameState, ...JSON.parse(saved) };
            } catch (e) {
                console.error('Error loading saved game state:', e);
            }
        }
        updateUI();
        updatePlayerPosition();
    }

    // Save progress to localStorage
    function saveGameState() {
        localStorage.setItem('englishTrainerProgress', JSON.stringify(gameState));
    }

    // Update UI based on game state
    function updateUI() {
        // Update header stats
        $('#total-stars').text(gameState.totalStars);
        $('#total-points').text(gameState.totalPoints);
        $('#total-achievements').text(gameState.completedLevels.length);

        // Update level nodes
        $('.level-node').each(function() {
            const level = parseInt($(this).data('level'));
            const $node = $(this);

            // Remove all state classes
            $node.removeClass('completed unlocked locked');

            // Apply correct state
            if (gameState.completedLevels.includes(level)) {
                $node.addClass('completed');
                updateLevelStars($node, level);
            } else if (gameState.unlockedLevels.includes(level)) {
                $node.addClass('unlocked');
            } else {
                $node.addClass('locked');
            }
        });
    }

    // Update stars for a completed level
    function updateLevelStars($node, level) {
        const progress = gameState.levelProgress[level];
        if (progress && progress.stars > 0) {
            const $stars = $node.find('.progress-stars i');
            $stars.removeClass('fas far').addClass('far');
            for (let i = 0; i < progress.stars; i++) {
                $stars.eq(i).removeClass('far').addClass('fas');
            }
        }
    }

    // Position player character
    function updatePlayerPosition() {
        const lastCompleted = Math.max(...gameState.completedLevels, 0);
        const currentLevel = Math.min(lastCompleted + 1, 8);
        const $targetNode = $(`.level-${currentLevel}`);
        
        if ($targetNode.length) {
            const nodePosition = $targetNode.offset();
            const nodeSize = $targetNode.find('.node-circle').width();
            
            $('#player-character').css({
                left: (nodePosition.left + nodeSize + 20) + 'px',
                top: (nodePosition.top - 30) + 'px'
            });
        }
    }

    // Handle level node clicks
    $('.level-node').click(function() {
        const level = parseInt($(this).data('level'));
        
        if ($(this).hasClass('locked')) {
            showNotification('Este nivel está bloqueado. Completa los niveles anteriores.', 'warning');
            return;
        }

        showLevelPanel(level);
    });

    // Show level panel
    function showLevelPanel(level) {
        const config = gameConfig[level];
        const progress = gameState.levelProgress[level] || { bestScore: 0, stars: 0 };
        const levelNode = $(`.level-${level}`);
        
        // Update panel content
        $('#panel-title').text(config.name);
        $('#panel-description').text(config.description);
        $('#panel-best-score').text(progress.bestScore);
        
        // Update icon color based on level type
        let iconColor;
        if (level <= 3) {
            iconColor = '#3b82f6'; // Blue for vocabulary
        } else if (level <= 7) {
            iconColor = '#10b981'; // Green for grammar
        } else {
            iconColor = '#8b5cf6'; // Purple for special
        }
        
        $('#panel-icon i').attr('class', levelNode.find('.node-icon i').attr('class'))
                          .css('color', iconColor);
        
        // Update stars
        const $panelStars = $('#panel-stars i');
        $panelStars.removeClass('fas far').addClass('far');
        for (let i = 0; i < progress.stars; i++) {
            $panelStars.eq(i).removeClass('far').addClass('fas');
        }
        
        // Set up button actions
        $('#theory-btn').off('click').on('click', function(e) {
            e.preventDefault();
            window.location.href = config.theory;
        });

        $('#play-btn').off('click').on('click', function(e) {
            e.preventDefault();
            window.location.href = `games/${config.game}.php`;
        });

        // Show panel
        $('#level-panel').addClass('visible');
    }

    // Close level panel
    $('#close-level-panel').click(function() {
        $('#level-panel').removeClass('visible');
    });

    // Close panel when clicking outside
    $(document).click(function(e) {
        if (!$(e.target).closest('#level-panel, .level-node').length) {
            $('#level-panel').removeClass('visible');
        }
    });

    // Show notification
    function showNotification(message, type = 'info') {
        $('#notification-text').text(message);
        $('#notification')
            .removeClass('info warning success error')
            .addClass(type)
            .addClass('visible');
        
        setTimeout(() => {
            $('#notification').removeClass('visible');
        }, 3000);
    }

    // Handle game completion (called from game pages)
    window.onGameComplete = function(level, score, stars) {
        // Update game state
        if (!gameState.completedLevels.includes(level)) {
            gameState.completedLevels.push(level);
            
            // Unlock next level
            if (level < 8 && !gameState.unlockedLevels.includes(level + 1)) {
                gameState.unlockedLevels.push(level + 1);
                showNotification(`¡Nivel ${level + 1} desbloqueado!`, 'success');
            }
        }

        // Update level progress
        if (!gameState.levelProgress[level] || gameState.levelProgress[level].bestScore < score) {
            gameState.levelProgress[level] = { bestScore: score, stars: stars };
        }

        // Update totals
        calculateTotals();
        
        // Save and update UI
        saveGameState();
        updateUI();
        updatePlayerPosition();
        
        // Show completion animation
        showCompletionAnimation(level, score, stars);
    };

    // Calculate total points and stars
    function calculateTotals() {
        gameState.totalPoints = 0;
        gameState.totalStars = 0;
        
        Object.values(gameState.levelProgress).forEach(progress => {
            gameState.totalPoints += progress.bestScore;
            gameState.totalStars += progress.stars;
        });
    }

    // Show completion animation
    function showCompletionAnimation(level, score, stars) {
        const $level = $(`.level-${level}`);
        const levelPosition = $level.offset();
        
        // Create celebration effect
        for (let i = 0; i < 15; i++) {
            const $particle = $('<div>').css({
                position: 'absolute',
                left: levelPosition.left + Math.random() * 100,
                top: levelPosition.top + Math.random() * 100,
                background: ['#ffd700', '#ff6b4a', '#10b981', '#8b5cf6'][Math.floor(Math.random() * 4)],
                width: '10px',
                height: '10px',
                borderRadius: '50%',
                pointerEvents: 'none',
                zIndex: 1000
            });
            
            $('body').append($particle);
            
            // Animate particle
            $particle.animate({
                top: $particle.offset().top - 100 - Math.random() * 100,
                left: $particle.offset().left + (Math.random() - 0.5) * 200,
                opacity: 0,
                transform: 'scale(2)'
            }, 1000 + Math.random() * 1000, function() {
                $particle.remove();
            });
        }
        
        // Show score notification
        showNotification(`¡Completaste el nivel ${level}! Puntos: ${score}, Estrellas: ${stars}`, 'success');
    }

    // Handle level completion from URL parameters
    function checkLevelCompletion() {
        const urlParams = new URLSearchParams(window.location.search);
        const level = parseInt(urlParams.get('level'));
        const score = parseInt(urlParams.get('score'));
        const stars = parseInt(urlParams.get('stars'));
        
        if (level && score !== null && stars !== null) {
            onGameComplete(level, score, stars);
            
            // Remove parameters from URL
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    }

    // Keyboard shortcuts
    $(document).keydown(function(e) {
        // Escape key closes panel
        if (e.keyCode === 27) {
            $('#level-panel').removeClass('visible');
        }
        
        // Number keys (1-8) select levels
        if (e.keyCode >= 49 && e.keyCode <= 56) {
            const level = e.keyCode - 48;
            const $levelNode = $(`.level-${level}`);
            if ($levelNode.length && !$levelNode.hasClass('locked')) {
                $levelNode.click();
            }
        }
    });

    // Window resize handler
    $(window).resize(function() {
        updatePlayerPosition();
    });

    // Hover effects for level nodes
    $('.level-node').hover(
        function() {
            if (!$(this).hasClass('locked')) {
                const level = parseInt($(this).data('level'));
                const config = gameConfig[level];
                const $tooltip = $('<div class="level-tooltip">')
                    .html(`<strong>${config.name}</strong><br/>${config.description}`)
                    .appendTo('body');
                
                const position = $(this).offset();
                $tooltip.css({
                    position: 'absolute',
                    left: position.left + 50,
                    top: position.top - $tooltip.height() - 20,
                    background: '#1f2937',
                    color: 'white',
                    padding: '10px 15px',
                    borderRadius: '10px',
                    maxWidth: '200px',
                    fontSize: '0.9rem',
                    zIndex: 2000,
                    boxShadow: '0 4px 15px rgba(0, 0, 0, 0.2)'
                });
            }
        },
        function() {
            $('.level-tooltip').remove();
        }
    );

    // Initialize the game
    loadGameState();
    checkLevelCompletion();
    
    // Add path drawing animation
    function animatePath() {
        const path = document.getElementById('adventure-path');
        if (path) {
            const length = path.getTotalLength();
            path.style.strokeDasharray = length + ' ' + length;
            path.style.strokeDashoffset = length;
            path.getBoundingClientRect();
            path.style.transition = 'stroke-dashoffset 3s ease-in-out';
            path.style.strokeDashoffset = '0';
        }
    }
    
    // Animate path on load
    setTimeout(animatePath, 500);
});