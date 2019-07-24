let mix = require('laravel-mix');

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

mix.sass('resources/assets/sass/app.scss', 'public/css');
mix.combine([
      'vendor/jquery/jquery.min.js',
      'vendor/bootstrap/js/bootstrap.bundle.min.js',
      'node_modules/jquery-ui/ui/widgets/autocomplete.js',
      'vendor/jquery-easing/jquery.easing.min.js',
      'vendor/chart.js/Chart.min.js',    
      'resources/assets/js/sb-admin-2.min.js',
      'resources/assets/js/demo/chart-area-demo.js',
      'resources/assets/js/demo/chart-pie-demo.js'
  ], 'public/js/app.js');