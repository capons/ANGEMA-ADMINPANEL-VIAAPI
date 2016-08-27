var elixir = require('laravel-elixir');
require('./elixir-extensions');
require('laravel-elixir-vueify');

elixir(function(mix) {
 mix
     .phpUnit()
     //.compressHtml()

    /**
     * Copy needed files from /node directories
     * to /public directory.
     */
     .copy(
       'node_modules/font-awesome/fonts',
       'public/build/fonts/font-awesome'
     )
     .copy(
       'node_modules/bootstrap-sass/assets/fonts/bootstrap',
       'public/build/fonts/bootstrap'
     )
     .copy(
       'node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js',
       'public/js/vendor/bootstrap'
     )
     .copy(
       'node_modules/jquery/dist/jquery.min.js',
       'public/js/vendor/jquery'
     )
     .copy(
       'node_modules/bootstrap-fileinput/js/fileinput.min.js',
       'public/js/vendor/bootstrap-fileinput'
     )
     .copy(
       'node_modules/bootstrap-fileinput/css/fileinput.min.css',
       'public/css/vendor/bootstrap-fileinput'
     )
     .copy(
       'node_modules/vue/dist/',
       'public/js/vendor/vue'
     )
     .copy(
       'node_modules/vue-strap/dist/',
       'public/js/vendor/vue-strap'
     )
     .copy(
       'node_modules/select2/dist/css/select2.min.css',
       'public/css/vendor/select2'
     )
     .copy(
       'node_modules/select2-bootstrap-theme/dist/select2-bootstrap.min.css',
       'public/css/vendor/select2'
     )
     .copy(
       'node_modules/select2/dist/js/select2.min.js',
       'public/js/vendor/select2'
     )
     /**
      * Process frontend SCSS stylesheets
      */
     .sass([
        'frontend/app.scss',
        'plugin/sweetalert/sweetalert.scss'
     ], 'resources/assets/css/frontend/app.css')

     /**
      * Combine pre-processed frontend CSS files
      */
     .styles([
        'frontend/app.css'
     ], 'public/css/frontend.css')

     /**
      * Combine frontend scripts
      */
     .scripts([
        'plugin/sweetalert/sweetalert.min.js',
        'plugins.js',
        'frontend/app.js'
     ], 'public/js/frontend.js')

     /**
      * Process backend SCSS stylesheets
      */
     .sass([
         'backend/app.scss',
         'backend/plugin/toastr/toastr.scss',
         'plugin/sweetalert/sweetalert.scss'
     ], 'resources/assets/css/backend/app.css')

     /**
      * Combine pre-processed backend CSS files
      */
     .styles([
         'backend/app.css'
     ], 'public/css/backend.css')

     /**
      * Combine backend scripts
      */
     .scripts([
         'plugin/sweetalert/sweetalert.min.js',
         'plugins.js',
         'backend/app.js',
         'backend/plugin/toastr/toastr.min.js',
         'backend/custom.js'
     ], 'public/js/backend.js')

     .browserify(['engena/app.js'], 'public/js/engena/app.js')
    /**
      * Apply version control
      */
     .version(["public/css/frontend.css", "public/js/frontend.js", "public/css/backend.css", "public/js/backend.js"])


     ;
});
