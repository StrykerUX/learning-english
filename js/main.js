// English Trainer - Simple JavaScript
$(document).ready(function() {
    // Game configuration
    const gameConfig = {
        1: {
            name: 'Palabras Básicas',
            description: 'Aprende las 20 palabras más esenciales del inglés.',
            game: 'vocabulary-basic',
            theory: 'theory/basic-words.php'
        },
        2: {
            name: 'Memorama',
            description: 'Encuentra las parejas de palabras y traducciones.',
            game: 'memory-game',
            theory: 'theory/memory-tips.php'
        },
        3: {
            name: 'Ahorcado',
            description: 'Adivina la palabra oculta letra por letra.',
            game: 'hangman',
            theory: 'theory/spelling-tips.php'
        },
        4: {
            name: 'Presente Simple',
            description: 'Domina las rutinas y hechos con el presente simple.',
            game: 'present-simple',
            theory: 'theory/present-simple.php'
        },
        5: {
            name: 'Presente Continuo',
            description: 'Aprende a hablar de acciones presentes.',
            game: 'present-continuous',
            theory: 'theory/present-continuous.php'
        },
        6: {
            name: 'Pasado Simple',
            description: 'Cuenta eventos del pasado claramente.',
            game: 'past-simple',
            theory: 'theory/past-simple.php'
        },
        7: {
            name: 'Futuro Simple',
            description: 'Expresa planes y predicciones futuras.',
            game: 'future-simple',
            theory: 'theory/future-simple.php'
        },
        8: {
            name: 'Preposiciones',
            description: 'Aprende dónde están las cosas.',
            game: 'prepositions',
            theory: 'theory/prepositions.php'
        }
    };

    // Game state
    let gameState = {
        unlockedLevels: [1],
        completedLevels: [],
        levelProgress: {},
        totalPoints: 130,
        totalStars: 0
    };

    // Load game state
    function loadGameState() {
        const saved = localStorage.getItem('englishTrainerProgress');
        if (saved) {
            try {
                gameState = { ...gameState, ...JSON.parse(saved) };
            } catch (e) {
                console.log('No saved progress found');
            }
        }
        updateUI();
    }

    // Save game state
    function saveGameState() {
        localStorage.setItem('englishTrainerProgress', JSON.stringify(gameState));
    }

    // Update UI
    function updateUI() {
        // Update header stats
        $('#total-stars').text(gameState.totalStars);
        $('#total-points').text(gameState.totalPoints);
        $('#total-achievements').text(gameState.completedLevels.length);

        // Update level states
        $('.level-node').each(function() {
            const level = parseInt($(this).data('level'));
            $(this).removeClass('completed unlocked locked');

            if (gameState.completedLevels.includes(level)) {
                $(this).addClass('completed');
                updateStars($(this), level);
            } else if (gameState.unlockedLevels.includes(level)) {
                $(this).addClass('unlocked');
            } else {
                $(this).addClass('locked');
            }
        });
    }

    // Update stars for completed level
    function updateStars($node, level) {
        const progress = gameState.levelProgress[level];
        if (progress && progress.stars > 0) {
            const $stars = $node.find('.node-stars i');
            $stars.removeClass('fas far').addClass('far');
            for (let i = 0; i < progress.stars; i++) {
                $stars.eq(i).removeClass('far').addClass('fas');
            }
        }
    }

    // Handle level clicks
    $('.level-node').click(function() {
        const level = parseInt($(this).data('level'));
        
        if ($(this).hasClass('locked')) {
            alert('Este nivel está bloqueado. Completa los niveles anteriores.');
            return;
        }

        showLevelPanel(level);
    });

    // Show level panel
    function showLevelPanel(level) {
        const config = gameConfig[level];
        const progress = gameState.levelProgress[level] || { bestScore: 0, stars: 0 };
        
        // Update panel content
        $('.panel-content h2').text(config.name);
        $('.panel-content p').text(config.description);
        $('.level-stats .stat-item:nth-child(1) span:last-child').text(progress.bestScore);
        
        // Update stars in panel
        const $panelStars = $('.stars-display i');
        $panelStars.removeClass('fas far').addClass('far');
        for (let i = 0; i < progress.stars; i++) {
            $panelStars.eq(i).removeClass('far').addClass('fas');
        }
        
        // Set up button actions
        $('.theory-btn').off('click').on('click', function() {
            window.location.href = config.theory;
        });

        $('.play-btn').off('click').on('click', function() {
            window.location.href = 'games/' + config.game + '.php';
        });

        // Show panel
        $('#level-panel').addClass('visible');
    }

    // Close panel
    $('.close-btn').click(function() {
        $('#level-panel').removeClass('visible');
    });

    // Close panel when clicking outside
    $(document).click(function(e) {
        if (!$(e.target).closest('#level-panel, .level-node').length) {
            $('#level-panel').removeClass('visible');
        }
    });

    // Handle game completion
    window.onGameComplete = function(level, score, stars) {
        // Update completed levels
        if (!gameState.completedLevels.includes(level)) {
            gameState.completedLevels.push(level);
            
            // Unlock next level
            if (level < 8 && !gameState.unlockedLevels.includes(level + 1)) {
                gameState.unlockedLevels.push(level + 1);
            }
        }

        // Update progress
        if (!gameState.levelProgress[level] || gameState.levelProgress[level].bestScore < score) {
            gameState.levelProgress[level] = { bestScore: score, stars: stars };
        }

        // Update totals
        gameState.totalPoints = 0;
        gameState.totalStars = 0;
        Object.values(gameState.levelProgress).forEach(progress => {
            gameState.totalPoints += progress.bestScore;
            gameState.totalStars += progress.stars;
        });

        // Save and update
        saveGameState();
        updateUI();
    };

    // Check for completion from URL
    function checkCompletion() {
        const urlParams = new URLSearchParams(window.location.search);
        const level = parseInt(urlParams.get('level'));
        const score = parseInt(urlParams.get('score'));
        const stars = parseInt(urlParams.get('stars'));
        
        if (level && score !== null && stars !== null) {
            onGameComplete(level, score, stars);
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    }

    // Initialize
    loadGameState();
    checkCompletion();
});