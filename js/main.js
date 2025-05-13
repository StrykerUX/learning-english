$(document).ready(function() {
    // Initialize progress from localStorage
    initializeProgress();
    updateDashboard();
    
    // Add welcome animation
    if (!localStorage.getItem('visitedBefore')) {
        showNotification('¡Bienvenido a English Trainer! Comienza con el primer juego de vocabulario.', 'success');
        localStorage.setItem('visitedBefore', 'true');
    }

    // Handle game card clicks directly
    $('.game-card').click(function() {
        const category = $(this).data('category');
        const game = $(this).data('game');
        const status = $(this).data('status');
        const card = $(this);
        
        // Add click animation
        card.css('transform', 'scale(0.98)');
        setTimeout(() => {
            card.css('transform', '');
        }, 150);
        
        if (status === 'locked') {
            showNotification('Este juego está bloqueado. Completa el juego anterior primero.', 'warning');
            return;
        }
        
        // Navigate directly to game
        setTimeout(() => {
            navigateToGame(category, game);
        }, 200);
    });
    
    // Add hover effect for game cards
    $('.game-card').not('.locked').hover(
        function() {
            $(this).css('transform', 'translateY(-5px)');
        },
        function() {
            if (!$(this).hasClass('clicked')) {
                $(this).css('transform', '');
            }
        }
    );

    // No modal handlers needed in this simplified version
});

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

function updateDashboard() {
    const progress = getProgress();
    
    // Update header stats
    $('#total-points').text(progress.totalPoints);
    $('#words-learned').text(progress.wordsLearned);
    $('#completed-levels').text(progress.gamesCompleted);
    
    // Update game cards
    Object.entries(progress.gameProgress).forEach(([game, data]) => {
        const card = $(`.game-card[data-game="${game}"]`);
        const progressFill = card.find('.progress-fill');
        const progressText = card.find('.progress-text');
        
        // Update progress based on game type
        if ([1, 2, 3, 8].includes(parseInt(game))) {
            // Vocabulary games - track words learned
            const maxWords = getMaxWordsForGame(parseInt(game));
            const progressPercent = (data.wordsLearned / maxWords) * 100;
            progressFill.css('width', `${progressPercent}%`);
            progressText.text(`${data.wordsLearned}/${maxWords} palabras`);
        } else {
            // Grammar games - track completion
            const progressPercent = (data.progress / 10) * 100;
            progressFill.css('width', `${progressPercent}%`);
            progressText.text(`${data.progress || 0}/10 completado`);
        }
        
        // Update status
        if (data.completed) {
            card.removeClass('locked').addClass('completed');
            card.data('status', 'completed');
            card.find('.game-status').html(`
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="status-icon">
                    <path d="M9 12l2 2 4-4"></path>
                    <circle cx="12" cy="12" r="11"></circle>
                </svg>
            `);
        } else if (isGameUnlocked(parseInt(game))) {
            card.removeClass('locked').addClass('unlocked');
            card.data('status', 'unlocked');
        }
    });
}

function getMaxWordsForGame(gameNumber) {
    const wordsPerGame = {
        1: 20,  // Basic Vocabulary
        2: 15,  // Memory Game
        3: 20,  // Hangman
        8: 15   // Prepositions
    };
    return wordsPerGame[gameNumber] || 10;
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

// Modal functions removed - direct navigation now

function navigateToGame(category, game) {
    // Define navigation paths based on the new structure
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
}

function showNotification(message, type = 'info') {
    const notification = $(`
        <div class="notification ${type}">
            <span>${message}</span>
            <button class="notification-close">&times;</button>
        </div>
    `);
    
    $('body').append(notification);
    
    setTimeout(() => {
        notification.addClass('show');
    }, 100);
    
    setTimeout(() => {
        notification.removeClass('show');
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
    
    notification.find('.notification-close').click(function() {
        notification.removeClass('show');
        setTimeout(() => {
            notification.remove();
        }, 300);
    });
}

function updateGameProgress(gameNumber, data) {
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
}

// Global functions for games
window.englishTrainer = {
    getProgress,
    saveProgress,
    updateGameProgress,
    showNotification,
    updateDashboard,
    getMaxWordsForGame,
    isGameUnlocked
};