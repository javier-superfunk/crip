const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('node_modules/@fortawesome/fontawesome-free/js/all.min.js', 'public/js')
    .sass('resources/scss/styles.scss', 'public/css', [
        //
    ]);

mix.copyDirectory('resources/assets/fonts', 'public/assets/fonts');
mix.copyDirectory('resources/assets/img', 'public/assets/img');
mix.copy('node_modules/feather-icons/dist/icons', 'public/vendor/feather-icons');