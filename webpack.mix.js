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

mix.styles([
    'resources/css/app.css',
    'resources/assets/admin/plugins/fontawesome-free/css/all.min.css',
    'resources/assets/admin/css/adminlte.min.css',
    'resources/assets/front/css/front.css',
    'resources/assets/admin/plugins/jquery-ui/jquery-ui.theme.css',
    'resources/assets/admin/plugins/jquery-ui/jquery-ui.css',
    'resources/assets/admin/plugins/jquery-ui/theme.css',
    'resources/assets/admin/plugins/jquery-ui/jquery-ui.structure.css',
    'resources/assets/admin/plugins/select2/css/select2.css',
    'resources/assets/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.css',
    'node_modules/air-datepicker/dist/css/datepicker.min.css'
], 'public/assets/admin/css/all.min.css');

mix.scripts([
    'resources/js/app.js',
    'resources/assets/admin/plugins/jquery/jquery.min.js',
/*    'resources/assets/admin/plugins/table-to-excel-master/dist/index.js',*/
    'resources/assets/admin/plugins/jquery-ui/jquery-ui.js',
    'resources/assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'resources/assets/admin/plugins/bootstrap/js/bootstrap-switch.js',
    'resources/assets/admin/plugins/select2/js/select2.full.js',
    'resources/assets/admin/js/adminlte.min.js',
    'resources/assets/admin/js/demo.js',
    'node_modules/air-datepicker/dist/js/datepicker.min.js',
    'resources/assets/front/js/task.js'
], 'public/assets/admin/js/all.js');
/*mix.js([
    'resources/assets/admin/plugins/table-to-excel-master/dist/index.js',
], 'public/assets/admin/js/all2.js');*/
mix.copyDirectory('resources/assets/admin/plugins/fontawesome-free/webfonts', 'public/assets/admin/webfonts');
mix.copyDirectory('resources/assets/admin/img', 'public/assets/admin/img');
mix.copyDirectory('resources/assets/front/img', 'public/assets/front/img');
mix.copyDirectory('resources/assets/admin/css/images', 'public/assets/admin/css/images');

mix.copy('resources/assets/admin/css/adminlte.min.css.map', 'public/assets/admin/css/adminlte.min.css.map');
mix.copy('resources/assets/admin/js/adminlte.min.js.map', 'public/assets/admin/js/adminlte.min.js.map');
