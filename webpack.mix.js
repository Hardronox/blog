const { mix } = require('laravel-mix');

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

mix.js(['resources/assets/js/app.js'], 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

//,
//'resources/assets/js/js_modules/angular.min.js',
//	'resources/assets/js/js_modules/angular-ui-router.min.js',
//	'resources/assets/js/js_modules/ui-bootstrap-tpls-1.2.5.min.js',
//	'resources/assets/js/angular/main.module.js',
//	'resources/assets/js/angular/main.config.js',
//	'resources/assets/js/angular/main.controller.js'