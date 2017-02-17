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
    var javascripts = [
        {scripts: 'require-config.js'},
        {scripts: 'utils.js'},
        {scripts: 'ajax.js'},
        {scripts: 'admin/sb-admin-2.js'},
        {scripts: 'admin/restful.js'},
        {scripts: 'blog.js'}
    ];

    for (var i in javascripts) {
        var javascript = javascripts[i];
        var version = 'js/' + javascript.scripts;

        mix.scripts(javascript.scripts, javascript.output).version(version);
    }

    mix.styles('sb-admin-2.css', 'public/css/sb-admin-2.css');

    mix.styles('style.css', 'public/css/style.css');
});
