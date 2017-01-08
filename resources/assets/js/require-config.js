requirejs.config({
    paths: {
        'jquery': '/plugins/jquery/jquery.min',
        'bootstrap': '/plugins/bootstrap/js/bootstrap.min',
        'metisMenu': '/plugins/metisMenu/metisMenu.min',
        'utils': '/js/utils',
        'ajax': '/js/ajax'
    },
    shim: {
        'bootstrap': {
            deps: ['jquery']
        },
        'metisMenu': {
            deps: ['bootstrap']
        }
    }
});
