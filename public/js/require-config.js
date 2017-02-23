requirejs.config({
    paths: {
        'jquery': '/plugins/jquery/jquery.min',
        'bootstrap': '/plugins/bootstrap/js/bootstrap.min',
        'metisMenu': '/plugins/metisMenu/metisMenu.min',
        'utils': '/js/utils',
        'ajax': '/js/ajax',

        // UE 编辑器
        'ueditor': '/plugins/ueditor/ueditor.requirejs.min',
        'ueditor-lang': '/plugins/ueditor/lang/zh-cn/zh-cn',
        'zeroclipboard': '/plugins/ueditor/third-party/zeroclipboard/ZeroClipboard.min',

        'datetimepicker': '/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min',
        'datetimepicker-lang': '/plugins/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN'
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
        'ueditor-lang': {
            deps: ['ueditor']
        },
        'datetimepicker-lang': {
            deps: ['datetimepicker']
        }
    }
});

//# sourceMappingURL=require-config.js.map
