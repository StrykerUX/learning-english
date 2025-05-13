<?php
/**
 * Script para añadir testing mode a todas las páginas PHP
 */

// Directorios a procesar
$directories = ['theory', 'games'];

$includeCode = "\n    <?php include '../includes/testing-mode-include.php'; ?>";

foreach ($directories as $dir) {
    $dirPath = __DIR__ . '/' . $dir;
    if (!is_dir($dirPath)) {
        echo "Directory $dir does not exist\n";
        continue;
    }
    
    // Obtener todos los archivos PHP
    $files = glob($dirPath . '/*.php');
    
    foreach ($files as $file) {
        $filename = basename($file);
        echo "Processing: $filename\n";
        
        // Leer el contenido del archivo
        $content = file_get_contents($file);
        
        // Verificar si ya tiene el include
        if (strpos($content, 'testing-mode-include.php') !== false) {
            echo "  - Already has testing mode include\n";
            continue;
        }
        
        // Encontrar la posición de </body>
        $bodyClosePos = strrpos($content, '</body>');
        
        if ($bodyClosePos === false) {
            echo "  - No closing </body> tag found\n";
            continue;
        }
        
        // Insertar el include antes de </body>
        $newContent = substr($content, 0, $bodyClosePos) . $includeCode . "\n" . substr($content, $bodyClosePos);
        
        // Escribir el archivo modificado
        if (file_put_contents($file, $newContent)) {
            echo "  - Successfully added testing mode include\n";
        } else {
            echo "  - Failed to write file\n";
        }
    }
}

echo "\nAll PHP files processed!\n";
?>
