const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.scripts('require-config.js');
    mix.scripts('utils.js');
    mix.scripts('ajax.js');

    mix.scripts('admin/sb-admin-2.js', 'public/js/admin');
    mix.scripts('admin/restful.js', 'public/js/admin');
});
