const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Gestion des ressources avec Mix
 |--------------------------------------------------------------------------
 |
 | Mix offre une API propre et fluide pour définir les étapes de compilation
 | de Webpack pour vos applications Laravel. Par défaut, nous compilons le
 | fichier CSS de l'application ainsi que l'ensemble des fichiers JS.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css') // Compile app.scss en app.css
    .sass('public/assets/scss/soft-ui-dashboard.scss', 'public/assets/css') // Compile soft-ui-dashboard.scss en CSS
    .minify('public/assets/js/soft-ui-dashboard.js'); // Minifie soft-ui-dashboard.js
