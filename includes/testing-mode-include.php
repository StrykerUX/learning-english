<?php
// Incluir el script de testing mode en todas las páginas
?>
<script>
// Verificar la ruta correcta dependiendo de dónde estamos
const currentPath = window.location.pathname;
let scriptPath = '../js/testing-mode.js';

// Si estamos en el directorio raíz, ajustar la ruta
if (currentPath === '/' || currentPath.includes('index.html')) {
    scriptPath = 'js/testing-mode.js';
}

// Verificar si el testing mode ya está cargado
if (typeof TestingMode === 'undefined') {
    // Create a script element to load testing-mode.js
    const script = document.createElement('script');
    script.src = scriptPath;
    script.onload = function() {
        console.log('Testing mode script loaded successfully');
    };
    script.onerror = function() {
        console.error('Failed to load testing mode script');
    };
    document.head.appendChild(script);
}
</script>
