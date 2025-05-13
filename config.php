<?php
// English Trainer Configuration File
// Version: 1.0 - MVP

// Application Information
define('APP_NAME', 'English Trainer');
define('APP_VERSION', '1.0.0-MVP');
define('APP_DESCRIPTION', 'Plataforma gamificada para aprender inglés');

// Levels Configuration
$levels = [
    1 => [
        'name' => 'Vocabulario Básico',
        'description' => 'Aprende palabras esenciales',
        'icon' => 'message-circle',
        'color' => 'vocabulary',
        'theory_file' => 'theory/level-1.php',
        'game_file' => 'games/level-1.php',
        'topics' => ['colors', 'numbers', 'family', 'animals']
    ],
    2 => [
        'name' => 'Presente Simple',
        'description' => 'Oraciones en presente',
        'icon' => 'calendar',
        'color' => 'present-simple',
        'theory_file' => 'theory/level-2.php',
        'game_file' => 'games/level-2.php',
        'topics' => ['affirmative', 'negative', 'questions', 'third_person']
    ],
    3 => [
        'name' => 'Presente Continuo',
        'description' => 'Acciones en progreso',
        'icon' => 'clock',
        'color' => 'present-continuous',
        'theory_file' => 'theory/level-3.php',
        'game_file' => 'games/level-3.php',
        'topics' => ['am_is_are', 'verb_ing', 'negative', 'questions']
    ],
    4 => [
        'name' => 'Pasado Simple',
        'description' => 'Eventos del pasado',
        'icon' => 'trending-up',
        'color' => 'past-simple',
        'theory_file' => 'theory/level-4.php',
        'game_file' => 'games/level-4.php',
        'topics' => ['regular_verbs', 'irregular_verbs', 'negative', 'questions']
    ],
    5 => [
        'name' => 'Futuro Simple',
        'description' => 'Planes y predicciones',
        'icon' => 'plus-square',
        'color' => 'future-simple',
        'theory_file' => 'theory/level-5.php',
        'game_file' => 'games/level-5.php',
        'topics' => ['will_future', 'going_to', 'negative', 'questions']
    ]
];

// Game Configuration
define('QUESTIONS_PER_LEVEL', 10);
define('PASSING_SCORE_PERCENTAGE', 70);
define('POINTS_PER_CORRECT_ANSWER', 10);

// UI Configuration
$colors = [
    'primary' => '#E8F4FD',
    'secondary' => '#F0E6FF',
    'accent' => '#FFEAE6',
    'success' => '#E6F7F1',
    'warning' => '#FFF3E6'
];

// Functions
function getLevels() {
    global $levels;
    return $levels;
}

function getLevel($levelNumber) {
    global $levels;
    return isset($levels[$levelNumber]) ? $levels[$levelNumber] : null;
}

function getPassingScore() {
    return floor((QUESTIONS_PER_LEVEL * PASSING_SCORE_PERCENTAGE) / 100);
}

function getMaxPoints() {
    return QUESTIONS_PER_LEVEL * POINTS_PER_CORRECT_ANSWER;
}

// Utility function to include common head elements
function includeHead($title = 'English Trainer') {
    echo '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>' . htmlspecialchars($title) . '</title>
    <meta name="description" content="' . APP_DESCRIPTION . '">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>';
}

// Utility function to include common footer scripts
function includeFooter() {
    echo '
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>';
}
?>