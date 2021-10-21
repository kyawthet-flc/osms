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
//  mix.js(["resources/js/app.js", "resources/js/custom.js"], "public/js")
//  .sass("resources/sass/app.scss", "public/css");
//  .sourceMaps();

/* mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css'); */

// mix.styles([
//     'public/css/app.css',
//     'public/css/admin-template.css',
//     'public/css/daterangepicker.css',
//     'public/css/bootstrap-datepicker3.min.css',
//     'public/css/select2.min.css',
//     'public/css/summernote.min.css',
//     'public/css/app-header.css',
//     'public/css/jquery.flexdatalist.min.css',
//     'public/css/toastr.min.css',
// ], 'public/css/all.css');

mix.js([
    'resources/js/app.js'
], 'public/js/app.js');

mix.scripts([

	// 'public/assets/vendors/js/vendor.bundle.base.js',
	// 'public/assets/vendors/js/vendor.bundle.addons.js',
	// 'public/assets/js/shared/wizard.js',
	// 'public/assets/vendors/daterangepicker/moment.min.js',
	// 'public/assets/vendors/daterangepicker/daterangepicker.js',
	'public/assets/js/shared/off-canvas.js',
	// 'public/assets/js/shared/hoverable-collapse.js',
	'public/assets/js/shared/misc.js',

	// 'public/assets/js/shared/settings.js',
	// 'public/assets/js/shared/todolist.js',
	// 'public/assets/js/shared/select2.js',

	// 'public/assets/js/shared/formpickers.js',

], 'public/js/dashboard.js');
