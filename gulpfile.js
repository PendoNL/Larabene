var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    mix.styles([
        'bootstrap.css',
        'magnific-popup.css',
        'flexslider.css',
        'style.css',
        'pendo.css',
    ], 'public/css', 'resources/template/css');

    mix.scripts([
        'jquery.min.js',
        'jquery.migrate.js',
        'jquery.flexslider.js',
        'jquery.magnific-popup.min.js',
        'bootstrap.js',
        'jquery.imagesloaded.min.js',
        'jquery.isotope.min.js',
        'retina-1.1.0.min.js',
        'plugins-scroll.js',
        'waypoint.min.js',
        'script.js',
        'pendo.js',
    ], 'public/js', 'resources/template/js');

    mix.version(['public/css/all.css', 'public/js/all.js']);

    mix.copy('resources/template/images', 'public/images');
    mix.copy('resources/template/css/fonts', 'public/build/fonts');

});