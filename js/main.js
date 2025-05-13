// English Trainer - Main JavaScript
$(document).ready(function() {
    // Game configuration and data
    const gameConfig = {
        1: {
            name: 'Palabras Básicas',
            description: 'Aprende 20 palabras esenciales del inglés. Palabra por palabra, construye tu vocabulario base.',
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

    // Initialize game state
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
    }

    // Save progress to localStorage
    function saveGameState() {
        localStorage.setItem('englishTrainerProgress', JSON.stringify(gameState));
    }

    // Update UI based on game state
    function updateUI() {
        // Update stats in header
        $('#total-points').text(gameState.totalPoints);
        $('#total-stars').text(gameState.totalStars);

        // Update level node appearances
        $('.level-node').each(function() {
            const level = parseInt($(this).data('level'));
            const $node = $(this);

            $node.removeClass('completed unlocked locked');

            if (gameState.completedLevels.includes(level)) {
                $node.addClass('completed');
            } else if (gameState.unlockedLevels.includes(level)) {
                $node.addClass('unlocked');
            } else {
                $node.addClass('locked');
            }
        });

        // Position progress ship
        updateProgressShip();
    }

    // Update progress ship position
    function updateProgressShip() {
        const lastCompletedLevel = Math.max(...gameState.completedLevels, 0);
        let nextLevel = lastCompletedLevel + 1;
        
        // If all levels are completed, keep ship at level 8
        if (nextLevel > 8) nextLevel = 8;

        const $targetLevel = $(`.level-${nextLevel}`);
        if ($targetLevel.length) {
            const targetPos = $targetLevel.position();
            const targetLeft = targetPos.left + $targetLevel.width() / 2;
            const targetTop = targetPos.top + $targetLevel.height() / 2;

            $('#progress-ship').css({
                left: targetLeft - 25,
                top: targetTop - 25
            });
        }
    }

    // Handle level node clicks
    $('.level-node').click(function() {
        const level = parseInt($(this).data('level'));
        
        if ($(this).hasClass('locked')) {
            showTooltip($(this), 'Nivel bloqueado. Completa los niveles anteriores.');
            return;
        }

        showGameInfoPanel(level);
    });

    // Show game information panel
    function showGameInfoPanel(level) {
        const config = gameConfig[level];
        const progress = gameState.levelProgress[level] || { bestScore: 0, stars: 0 };

        $('#game-info-panel .panel-title').text(config.name);
        $('#game-info-panel .panel-description').text(config.description);
        $('#panel-best-score').text(progress.bestScore);
        $('#panel-stars').text(progress.stars);

        // Set up button actions
        $('#view-theory').off('click').on('click', function() {
            window.location.href = config.theory;
        });

        $('#play-game').off('click').on('click', function() {
            window.location.href = `games/${config.game}.php`;
        });

        $('#game-info-panel').addClass('visible');
    }

    // Close game info panel
    $('#close-panel').click(function() {
        $('#game-info-panel').removeClass('visible');
    });

    // Close panel when clicking outside
    $(document).click(function(e) {
        if (!$(e.target).closest('#game-info-panel, .level-node').length) {
            $('#game-info-panel').removeClass('visible');
        }
    });

    // Tooltip functionality
    let tooltipTimeout;

    $('.level-node').hover(
        function() {
            const level = parseInt($(this).data('level'));
            const config = gameConfig[level];
            const progress = gameState.levelProgress[level] || { bestScore: 0, stars: 0 };
            
            let tooltip = `<strong>${config.name}</strong><br>`;
            
            if ($(this).hasClass('completed')) {
                tooltip += `⭐ ${progress.stars} estrellas<br>`;
                tooltip += `🏆 ${progress.bestScore} puntos`;
            } else if ($(this).hasClass('unlocked')) {
                tooltip += 'Click para jugar';
            } else {
                const required = $(this).data('required');
                if (required === 'none') {
                    tooltip += 'Nivel inicial disponible';
                } else {
                    tooltip += `Completa nivel ${required} para desbloquear`;
                }
            }

            clearTimeout(tooltipTimeout);
            tooltipTimeout = setTimeout(() => {
                showTooltip($(this), tooltip);
            }, 500);
        },
        function() {
            clearTimeout(tooltipTimeout);
            hideTooltip();
        }
    );

    function showTooltip($element, content) {
        const pos = $element.offset();
        const $tooltip = $('#level-tooltip');
        
        $tooltip.html(content);
        $tooltip.css({
            top: pos.top - $tooltip.outerHeight() - 10,
            left: pos.left + ($element.width() / 2) - ($tooltip.outerWidth() / 2)
        });
        $tooltip.addClass('visible');
    }

    function hideTooltip() {
        $('#level-tooltip').removeClass('visible');
    }

    // Handle game completion (called from game pages)
    window.onGameComplete = function(level, score, stars) {
        // Update game state
        if (!gameState.completedLevels.includes(level)) {
            gameState.completedLevels.push(level);
            
            // Unlock next level
            if (level < 8 && !gameState.unlockedLevels.includes(level + 1)) {
                gameState.unlockedLevels.push(level + 1);
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
        
        // Create celebration effect
        for (let i = 0; i < 10; i++) {
            const $star = $('<div>').css({
                position: 'absolute',
                left: $level.offset().left + $level.width() / 2,
                top: $level.offset().top + $level.height() / 2,
                color: '#ffd700',
                fontSize: '1.5rem',
                pointerEvents: 'none',
                zIndex: 1000
            }).html('⭐');
            
            $('body').append($star);
            
            // Animate star
            $star.animate({
                top: $star.offset().top - 50 - Math.random() * 100,
                left: $star.offset().left + (Math.random() - 0.5) * 200,
                opacity: 0
            }, 1000 + Math.random() * 1000, function() {
                $star.remove();
            });
        }
    }

    // Level completion from URL parameters (when returning from game)
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

    // Handle keyboard shortcuts
    $(document).keydown(function(e) {
        // Escape key closes panel
        if (e.keyCode === 27) {
            $('#game-info-panel').removeClass('visible');
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
        updateProgressShip();
    });

    // Initialize the game
    loadGameState();
    checkLevelCompletion();
    
    // Add some visual feedback to buttons
    $('.game-button').hover(
        function() {
            $(this).css('transform', 'translateY(-3px)');
        },
        function() {
            $(this).css('transform', 'translateY(0)');
        }
    );
    
    // Floating animation for the ship
    setInterval(function() {
        const $ship = $('#progress-ship');
        $ship.css('transform', 'translateY(' + (Math.sin(Date.now() / 1000) * 5) + 'px)');
    }, 50);
});