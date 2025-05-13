// Mario Bros Style JavaScript for English Trainer
$(document).ready(function() {
    // Game state management
    const gameState = {
        totalPoints: 130,
        wordsLearned: 0,
        maxWords: 100,
        completedLevels: 2,
        totalLevels: 8,
        levels: {
            1: { status: 'completed', points: 50, stars: 3 },
            2: { status: 'completed', points: 30, stars: 2 },
            3: { status: 'unlocked', points: 0, stars: 0 },
            4: { status: 'locked', points: 0, stars: 0 },
            5: { status: 'locked', points: 0, stars: 0 },
            6: { status: 'locked', points: 0, stars: 0 },
            7: { status: 'locked', points: 0, stars: 0 },
            8: { status: 'locked', points: 0, stars: 0 }
        }
    };

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

    function initializeInterface() {
        // Update stats in header
        $('#total-points').text(gameState.totalPoints);
        $('#words-learned').text(`${gameState.wordsLearned}/${gameState.maxWords}`);
        $('#completed-levels').text(`${gameState.completedLevels}/${gameState.totalLevels}`);

        // Initialize level states
        $('.level-node').each(function() {
            const level = $(this).data('level');
            const levelData = gameState.levels[level];
            
            $(this).attr('data-status', levelData.status);
            
            // Update visual indicators
            const $circle = $(this).find('.node-circle');
            const $popup = $(this).find('.level-popup');
            
            $circle.removeClass('completed unlocked locked')
                   .addClass(levelData.status);
            
            if (levelData.status === 'completed') {
                const $stars = $popup.find('.stars .star');
                $stars.each(function(index) {
                    if (index < levelData.stars) {
                        $(this).addClass('filled');
                    }
                });
                $popup.find('.points').text(`+${levelData.points} puntos`);
            }
        });
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
        
        // Simulate level start
        showNotification('¡Iniciando nivel...', 'info');
        
        setTimeout(() => {
            // Redirect to the actual game
            window.location.href = `games/level${level}.php`;
        }, 1500);
    }

    function showReplayModal(level) {
        const levelData = gameState.levels[level];
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
        $('#earnedPoints').text(`+${levelData.points} puntos`);
        
        // Store current level for replay
        $('#progressModal').data('current-level', level);
        $('#progressModal').show();
    }

    function showLockedLevelMessage() {
        showNotification('¡Completa el nivel anterior para desbloquear!', 'warning');
    }

    function completeLevel(level, points, stars) {
        // Update game state
        gameState.levels[level] = {
            status: 'completed',
            points: points,
            stars: stars
        };
        
        // Update totals
        gameState.totalPoints += points;
        gameState.completedLevels++;
        
        // Unlock next level
        if (level < gameState.totalLevels) {
            gameState.levels[level + 1].status = 'unlocked';
        }
        
        // Update interface
        initializeInterface();
        
        // Show completion modal
        showCompletionModal(level, points, stars);
        
        // Move character to new position
        moveCharacterToLevel(level + 1);
    }

    function showCompletionModal(level, points, stars) {
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
        $('#modalDescription').text('¡Excelente trabajo!');
        $('#earnedPoints').text(`+${points} puntos`);
        
        // Update stars display
        const $starsContainer = $('.stars-celebration');
        let starsHTML = '';
        for (let i = 0; i < stars; i++) {
            starsHTML += '⭐';
        }
        $starsContainer.html(starsHTML);
        
        $('#progressModal').show();
        
        // Add celebration effects
        addCelebrationEffects();
    }

    function addCelebrationEffects() {
        // Create confetti effect
        for (let i = 0; i < 20; i++) {
            const $confetti = $('<div>')
                .addClass('confetti')
                .css({
                    position: 'fixed',
                    width: '10px',
                    height: '10px',
                    background: ['#FF6B6B', '#FFD93D', '#4ECDC4', '#FF9F43'][Math.floor(Math.random() * 4)],
                    left: Math.random() * 100 + '%',
                    top: '-10px',
                    zIndex: 3000
                });
            
            $('body').append($confetti);
            
            $confetti.animate({
                top: $(window).height() + 'px',
                left: '+=' + (Math.random() - 0.5) * 200
            }, 3000, function() {
                $(this).remove();
            });
        }
    }

    function moveCharacterToLevel(level) {
        if (level > gameState.totalLevels) return;
        
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
    // This would be called when a game is completed
    window.updateProgress = function(level, points, stars) {
        completeLevel(level, points, stars);
    };

    // Save game state to localStorage
    function saveGameState() {
        localStorage.setItem('englishTrainerState', JSON.stringify(gameState));
    }

    // Load game state from localStorage
    function loadGameState() {
        const savedState = localStorage.getItem('englishTrainerState');
        if (savedState) {
            Object.assign(gameState, JSON.parse(savedState));
        }
    }

    // Initialize game state
    loadGameState();
    
    // Save game state when page unloads
    $(window).on('beforeunload', function() {
        saveGameState();
    });
    
    // Add keyboard shortcuts
    $(document).on('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
});