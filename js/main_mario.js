// Mario Bros Style JavaScript for English Trainer
$(document).ready(function() {
    // Initialize progress from localStorage
    initializeProgress();
    
    // Game state management - usando el sistema existente
    let gameState = getProgress();
    
    // Initialize the interface
    initializeInterface();

    // Event listeners
    $('.level-node').on('click', function() {
        const level = $(this).data('level');
        const status = $(this).data('status');
        
        if (status === 'locked') {
            showLockedLevelMessage();
            return;
        }
        
        handleLevelClick(level, status);
    });

    // Character animation
    animateCharacter();

    // Add floating particles
    addFloatingParticles();

    function initializeProgress() {
        // Initialize localStorage if it doesn't exist
        if (!localStorage.getItem('englishTrainer')) {
            const initialData = {
                totalPoints: 0,
                wordsLearned: 0,
                gamesCompleted: 0,
                gameProgress: {
                    1: { completed: false, score: 0, wordsLearned: 0 },  // Basic Vocabulary
                    2: { completed: false, score: 0, wordsLearned: 0 },  // Memory Game
                    3: { completed: false, score: 0, wordsLearned: 0 },  // Hangman
                    4: { completed: false, score: 0, progress: 0 },      // Present Simple
                    5: { completed: false, score: 0, progress: 0 },      // Present Continuous
                    6: { completed: false, score: 0, progress: 0 },      // Past Simple
                    7: { completed: false, score: 0, progress: 0 },      // Future Simple
                    8: { completed: false, score: 0, wordsLearned: 0 }   // Prepositions
                }
            };
            localStorage.setItem('englishTrainer', JSON.stringify(initialData));
        }
    }

    function getProgress() {
        return JSON.parse(localStorage.getItem('englishTrainer'));
    }

    function saveProgress(data) {
        localStorage.setItem('englishTrainer', JSON.stringify(data));
    }

    function initializeInterface() {
        // Update stats in header
        const progress = getProgress();
        $('#total-points').text(progress.totalPoints);
        $('#words-learned').text(`${progress.wordsLearned}/100`);
        $('#completed-levels').text(`${progress.gamesCompleted}/8`);

        // Initialize level states
        $('.level-node').each(function() {
            const level = $(this).data('level');
            const gameData = progress.gameProgress[level];
            
            // Determine status
            let status = 'locked';
            if (gameData.completed) {
                status = 'completed';
            } else if (isGameUnlocked(level)) {
                status = 'unlocked';
            }
            
            $(this).attr('data-status', status);
            
            // Update visual indicators
            const $circle = $(this).find('.node-circle');
            const $popup = $(this).find('.level-popup');
            
            $circle.removeClass('completed unlocked locked')
                   .addClass(status);
            
            if (status === 'completed') {
                // Calculate stars based on score
                const stars = calculateStars(gameData.score, level);
                const $stars = $popup.find('.stars .star');
                $stars.each(function(index) {
                    if (index < stars) {
                        $(this).addClass('filled');
                    }
                });
                $popup.find('.points').text(`+${gameData.score} puntos`);
            } else if (status === 'unlocked') {
                // Update estimated points
                const estimatedPoints = getEstimatedPoints(level);
                $popup.find('.estimated-points').text(`+${estimatedPoints} puntos posibles`);
            }
        });

        // Move character to current level
        const currentLevel = getCurrentLevel();
        if (currentLevel > 0) {
            moveCharacterToLevel(currentLevel);
        }
    }

    function isGameUnlocked(gameNumber) {
        if (gameNumber === 1) return true; // First game is always unlocked
        
        const progress = getProgress();
        
        // Define unlock requirements
        const unlockRequirements = {
            2: [1],           // Memory unlocks after Basic Vocabulary
            3: [1, 2],        // Hangman unlocks after Vocabulary + Memory
            4: [1, 2, 3],     // Present Simple unlocks after all vocabulary games
            5: [4],           // Present Continuous unlocks after Present Simple
            6: [4, 5],        // Past Simple unlocks after Present tenses
            7: [4, 5, 6],     // Future Simple unlocks after all previous tenses
            8: [1, 2, 3, 4]   // Prepositions unlocks after all vocabulary + present simple
        };
        
        const requirements = unlockRequirements[gameNumber] || [];
        return requirements.every(req => progress.gameProgress[req]?.completed);
    }

    function calculateStars(score, level) {
        // Calculate stars based on score
        if (score >= 90) return 3;
        if (score >= 70) return 2;
        if (score >= 50) return 1;
        return 0;
    }

    function getEstimatedPoints(level) {
        // Estimated points for each level
        const estimatedPoints = {
            1: 50, 2: 40, 3: 45, 4: 60,
            5: 60, 6: 65, 7: 65, 8: 50
        };
        return estimatedPoints[level] || 40;
    }

    function getCurrentLevel() {
        const progress = getProgress();
        for (let i = 1; i <= 8; i++) {
            if (!progress.gameProgress[i].completed) {
                return i;
            }
        }
        return 8; // All completed
    }

    function handleLevelClick(level, status) {
        if (status === 'completed') {
            // Show replay confirmation
            showReplayModal(level);
        } else if (status === 'unlocked') {
            // Start the level
            startLevel(level);
        }
    }

    function startLevel(level) {
        // Add visual feedback
        const $levelNode = $(`[data-level="${level}"]`);
        $levelNode.find('.node-circle').addClass('starting');
        
        // Navigate to the game using the original system's paths
        navigateToGame(level);
    }

    function navigateToGame(game) {
        // Define navigation paths based on the original structure
        const gamePaths = {
            1: 'games/vocabulary-basic.php',
            2: 'games/memory-game.php',
            3: 'games/hangman.php',
            4: 'games/present-simple.php',
            5: 'games/present-continuous.php',
            6: 'games/past-simple.php',
            7: 'games/future-simple.php',
            8: 'games/prepositions.php'
        };
        
        // Check if we need to show theory first
        const theoryRequired = [4, 5, 6, 7]; // Grammar games need theory
        
        showNotification('¡Iniciando nivel...', 'info');
        
        setTimeout(() => {
            if (theoryRequired.includes(parseInt(game))) {
                // Navigate to theory first
                const theoryPaths = {
                    4: 'theory/present-simple.php',
                    5: 'theory/present-continuous.php',
                    6: 'theory/past-simple.php',
                    7: 'theory/future-simple.php'
                };
                window.location.href = theoryPaths[game];
            } else {
                // Navigate directly to game
                window.location.href = gamePaths[game];
            }
        }, 1000);
    }

    function showReplayModal(level) {
        const progress = getProgress();
        const gameData = progress.gameProgress[level];
        const levelNames = {
            1: 'Palabras Básicas',
            2: 'Memorama',
            3: 'Ahorcado',
            4: 'Presente Simple',
            5: 'Presente Continuo',
            6: 'Pasado Simple',
            7: 'Futuro Simple',
            8: 'Preposiciones'
        };
        
        $('#modalTitle').text(levelNames[level]);
        $('#modalDescription').text('¿Quieres volver a jugar este nivel?');
        $('#earnedPoints').text(`+${gameData.score} puntos`);
        
        // Store current level for replay
        $('#progressModal').data('current-level', level);
        $('#progressModal').show();
    }

    function showLockedLevelMessage() {
        showNotification('¡Completa el nivel anterior para desbloquear!', 'warning');
    }

    function moveCharacterToLevel(level) {
        if (level > 8) return;
        
        const $targetLevel = $(`[data-level="${level}"]`);
        const $character = $('.character');
        
        if ($targetLevel.length > 0) {
            const position = $targetLevel.position();
            
            $character.animate({
                left: position.left - 30,
                top: position.top + 10
            }, 2000, 'easeInOutBounce');
        }
    }

    function animateCharacter() {
        // Add floating animation to character
        $('.character').hover(
            function() {
                $(this).find('img').css({
                    'animation': 'characterBounce 0.5s ease infinite',
                    'filter': 'drop-shadow(3px 3px 0 rgba(0, 0, 0, 0.3)) brightness(1.2)'
                });
            },
            function() {
                $(this).find('img').css({
                    'animation': 'characterFloat 3s ease-in-out infinite',
                    'filter': 'drop-shadow(3px 3px 0 rgba(0, 0, 0, 0.3))'
                });
            }
        );
    }

    function addFloatingParticles() {
        // Create floating particles effect
        const $particles = $('<div>').addClass('particles');
        $('.game-world').append($particles);
        
        function createParticle() {
            const $particle = $('<div>')
                .addClass('particle')
                .css({
                    left: Math.random() * 100 + '%',
                    animationDuration: (Math.random() * 3 + 2) + 's',
                    animationDelay: '0s'
                });
            
            $particles.append($particle);
            
            setTimeout(() => {
                $particle.remove();
            }, 5000);
        }
        
        // Create particles periodically
        setInterval(createParticle, 2000);
    }

    function showNotification(message, type = 'info') {
        const $notification = $('<div>')
            .addClass(`notification ${type}`)
            .html(`
                <span>${message}</span>
                <button class="notification-close">&times;</button>
            `);
        
        $('body').append($notification);
        
        setTimeout(() => {
            $notification.addClass('show');
        }, 100);
        
        // Auto-remove after 3 seconds
        setTimeout(() => {
            $notification.removeClass('show');
            setTimeout(() => {
                $notification.remove();
            }, 300);
        }, 3000);
        
        // Manual close
        $notification.find('.notification-close').on('click', function() {
            $notification.removeClass('show');
            setTimeout(() => {
                $notification.remove();
            }, 300);
        });
    }

    // Modal functions
    window.closeModal = function() {
        $('#progressModal').hide();
    };

    window.playAgain = function() {
        const level = $('#progressModal').data('current-level');
        closeModal();
        startLevel(level);
    };

    // Add CSS animations
    $('<style>')
        .prop('type', 'text/css')
        .html(`
            @keyframes characterBounce {
                0%, 100% { transform: scale(1); }
                50% { transform: scale(1.2); }
            }
            
            .node-circle.starting {
                animation: startingPulse 0.5s ease-in-out infinite !important;
            }
            
            @keyframes startingPulse {
                0%, 100% { transform: scale(1); box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3); }
                50% { transform: scale(1.1); box-shadow: 0 8px 20px rgba(255, 211, 61, 0.6); }
            }
            
            .confetti {
                animation: confettiFall 3s linear forwards !important;
            }
            
            @keyframes confettiFall {
                0% { transform: rotate(0deg); opacity: 1; }
                100% { transform: rotate(720deg); opacity: 0; }
            }
            
            .notification {
                position: fixed;
                top: 20px;
                right: 20px;
                background: white;
                padding: 15px 20px;
                border-radius: 15px;
                border: 3px solid #2C3E50;
                box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
                max-width: 300px;
                z-index: 2000;
                transform: translateX(350px);
                transition: transform 0.3s ease;
                font-weight: 600;
            }
            
            .notification.show {
                transform: translateX(0);
            }
            
            .notification.success {
                background: #4ECDC4;
                border-color: #3DB8B2;
                color: white;
            }
            
            .notification.error {
                background: #FF6B6B;
                border-color: #E55555;
                color: white;
            }
            
            .notification.warning {
                background: #FFD93D;
                border-color: #E5C300;
                color: #2C3E50;
            }
            
            .notification.info {
                background: #4A90E2;
                border-color: #357ABD;
                color: white;
            }
            
            .notification-close {
                position: absolute;
                top: 5px;
                right: 10px;
                background: none;
                border: none;
                font-size: 16px;
                cursor: pointer;
                font-weight: bold;
                color: inherit;
            }
            
            .notification-close:hover {
                opacity: 0.7;
            }
        `)
        .appendTo('head');

    // Update progress when returning from a game
    // This function is called by games when completed
    window.updateGameProgress = function(gameNumber, data) {
        const progress = getProgress();
        
        // Update specific game progress
        if (data.questionsAnswered !== undefined) {
            // Grammar games
            progress.gameProgress[gameNumber].progress = data.questionsAnswered;
            progress.gameProgress[gameNumber].score = Math.max(
                progress.gameProgress[gameNumber].score || 0, 
                data.score
            );
            
            if (data.questionsAnswered >= 10 && data.score >= 70) {
                progress.gameProgress[gameNumber].completed = true;
                progress.gamesCompleted = Object.values(progress.gameProgress).filter(g => g.completed).length;
                progress.totalPoints += data.score;
            }
        } else if (data.wordsLearned !== undefined) {
            // Vocabulary games
            progress.gameProgress[gameNumber].wordsLearned = Math.max(
                progress.gameProgress[gameNumber].wordsLearned || 0,
                data.wordsLearned
            );
            progress.gameProgress[gameNumber].score = Math.max(
                progress.gameProgress[gameNumber].score || 0,
                data.score
            );
            
            const maxWords = getMaxWordsForGame(gameNumber);
            if (data.wordsLearned >= maxWords * 0.7) { // 70% of words learned
                progress.gameProgress[gameNumber].completed = true;
                progress.gamesCompleted = Object.values(progress.gameProgress).filter(g => g.completed).length;
            }
            
            progress.totalPoints += data.pointsGained || 0;
            progress.wordsLearned = Math.max(progress.wordsLearned, 
                Object.values(progress.gameProgress)
                    .filter(g => g.wordsLearned !== undefined)
                    .reduce((sum, g) => sum + (g.wordsLearned || 0), 0)
            );
        }
        
        saveProgress(progress);
        
        // Refresh the interface
        initializeInterface();
    };

    function getMaxWordsForGame(gameNumber) {
        const wordsPerGame = {
            1: 20,  // Basic Vocabulary
            2: 15,  // Memory Game
            3: 20,  // Hangman
            8: 15   // Prepositions
        };
        return wordsPerGame[gameNumber] || 10;
    }

    // Save game state when page unloads
    $(window).on('beforeunload', function() {
        saveProgress(getProgress());
    });
    
    // Add keyboard shortcuts
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });

    // Global functions for games
    window.englishTrainer = {
        getProgress,
        saveProgress,
        updateGameProgress: window.updateGameProgress,
        showNotification,
        updateDashboard: initializeInterface,
        getMaxWordsForGame,
        isGameUnlocked
    };
});