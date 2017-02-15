requirejs.config({
    paths: {
        'jquery': '/plugins/jquery/jquery.min',
        'bootstrap': '/plugins/bootstrap/js/bootstrap.min',
        'metisMenu': '/plugins/metisMenu/metisMenu.min',
        'utils': '/js/utils',
        'ajax': '/js/ajax',

        'ueditor': '/plugins/ueditor/ueditor.requirejs',
        'ueditor-lang': '/plugins/ueditor/lang/zh-cn/zh-cn',
        'zeroclipboard': '/plugins/ueditor/third-party/zeroclipboard/ZeroClipboard.min'
    },
    shim: {
        'bootstrap': {
            deps: ['jquery']
        },
        'metisMenu': {
            deps: ['bootstrap']
        },

        'ueditor': {
            deps: ['/plugins/ueditor/ueditor.config.js']
        },
        'ueditor-lang':{
            deps: ['ueditor']
        }
    }
});

//# sourceMappingURL=require-config.js.map
