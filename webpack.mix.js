const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');

mix.scripts([
    'node_modules/select2/dist/js/select2.full.js',
    'resources/js/recipe.js',
    'resources/js/notify.min.js'
], 'public/js/bundle.js');

mix.styles([
    'resources/css/404.css',
], 'public/css/error.css');

mix.styles([
    'node_modules/select2/dist/css/select2.min.css',
    'resources/css/welcome.css',
], 'public/css/welcome.css');

mix.copyDirectory([
    'resources/img',
], 'public/img');