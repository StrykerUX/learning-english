<?php
// Incluir el script de testing mode en todas las páginas
?>
<script>
// Verificar si el testing mode ya está cargado
if (typeof TestingMode === 'undefined') {
    // Create a script element to load testing-mode.js
    const script = document.createElement('script');
    script.src = '../js/testing-mode.js';
    script.onload = function() {
        // Initialize testing mode after script loads
        if (typeof TestingMode !== 'undefined') {
            setTimeout(() => {
                window.testingMode = new TestingMode();
            }, 100);
        }
    };
    document.head.appendChild(script);
}
</script>
