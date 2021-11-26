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


mix.setPublicPath('public_html/');
mix
    .js('resources/js/app.js',                           'js')
    .js('resources/js/bootstrap.js',                     'js')
    .js('node_modules/lightbox2/src/js/lightbox.js',     'js')
    .js('resources/js/admin/app.js',                     'js/admin')
    .sass('resources/sass/app.scss',                     'css')
    .css('node_modules/lightbox2/src/css/lightbox.css',  'css/')
    .sass('resources/sass/admin/app.scss',               'css/admin')
    .sourceMaps();
