/**
 * Dynamic Favicon based on Dark/Light Mode
 * Automatically switches between logo-sikemas-putih-removebg (dark mode) 
 * and logo-sikemas-2-removebg (light mode)
 */

(function() {
    // Function to update favicon based on color scheme
    function updateFavicon() {
        const isDarkMode = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        const favicon = document.querySelector("link[rel='icon']");
        
        if (favicon) {
            if (isDarkMode) {
                // Dark mode: use white logo
                favicon.href = '/assets/img/logo-sikemas-putih-removebg.png';
            } else {
                // Light mode: use colored logo
                favicon.href = '/assets/img/logo-sikemas-2-removebg.png';
            }
        }
    }

    // Update favicon on page load
    updateFavicon();

    // Listen for changes in color scheme preference
    if (window.matchMedia) {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', updateFavicon);
    }
})();
