define(['vue', 'uploader', 'uploader', 'hyperdown', 'vue-datetime-picker', 'css!/css/admin/article.css'], function(Vue, Uploader) {
    Vue.config.debug = true;
    var HyperDown = window.HyperDown;
    var parser = new HyperDown;
    var uploader = new Uploader($('#uploadToken').html());

    var container = new Vue({
        el: '#container',
        data: {
            form: {
                title: '',
                author: '',
                content: '',
                status: '2',
                type: '1',
                write_time: '',
                cover_type: '1',
                cover_url: ''
            },
            preview: '',
            isShowCoverBox: false
        },
        methods: {
            // 上传封面
            coverUpload: function() {
                var self = this;
                uploader.upload(function(url) {
                    self.form.cover_url = url;
                });
            }
        },
        watch: {
            'form.content': function(val) {
                this.preview = parser.makeHtml(val);
            },
            'form.cover_type': function(val) {
                this.isShowCoverBox = parseInt(val) !== 1;
            }
        },
        created: function() {
            this.form = window.form;
        }
    });
});