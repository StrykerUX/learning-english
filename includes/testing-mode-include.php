<?php
// Incluir el script de testing mode simplificado
?>
<script>
// Simple include for testing mode
(function() {
    // Check if already loaded
    if (document.getElementById('testing-mode-script')) {
        return;
    }
    
    // Create script element
    const script = document.createElement('script');
    script.id = 'testing-mode-script';
    
    // Determine correct path
    const currentPath = window.location.pathname;
    if (currentPath === '/' || currentPath.includes('index.html')) {
        script.src = 'js/testing-mode.js';
    } else {
        script.src = '../js/testing-mode.js';
    }
    
    script.onload = function() {
        console.log('Simple testing mode loaded');
    };
    
    script.onerror = function() {
        console.error('Failed to load testing mode');
    };
    
    // Append to head
    document.head.appendChild(script);
})();
</script>
