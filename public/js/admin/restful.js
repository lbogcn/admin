define(['ajax', 'jquery'], function(ajax, $) {
    var $backDrop;

    function loading() {
        $backDrop = $('<div class="modal-backdrop fade in" style="z-index: 9999;"></div>\
        <div style="position: fixed;top: 50%; left: 50%; background: #FFF; border: 1px #000 solid;z-index: 10000; padding: 5px;">\
            <img src="/images/loading.gif" alt="loading">加载中...\
        </div>\
        ');

        $('body').append($backDrop);
    }

    function removeLoading() {
        $backDrop.remove();
    }

    return {
        deny: function(url) {
            if (confirm('确认禁用？')) {
                loading();

                ajax.apiPatch(url).done(function() {
                    alert('操作成功');
                    window.location.reload();
                }).fail(function (resp) {
                    alert(resp.msg);
                }).always(function () {
                    removeLoading();
                });
            }
        },
        restore: function(url) {
            if (confirm('确认恢复？')) {
                loading();

                ajax.apiPatch(url).done(function() {
                    alert('操作成功');
                    window.location.reload();
                }).fail(function (resp) {
                    alert(resp.msg);
                }).always(function () {
                    removeLoading();
                });
            }
        },
        get: function (url, params) {
            loading();

            return ajax.apiGet(url, params).fail(function (resp) {
                alert(resp.msg);
            }).always(function () {
                removeLoading();
            });
        },
        post: function (url, params) {
            loading();

            ajax.apiPost(url, params).done(function() {
                alert('操作成功');
                window.location.reload();
            }).fail(function (resp) {
                alert(resp.msg);
            }).always(function () {
                removeLoading();
            });
        },
        put: function(url, params) {
            loading();

            ajax.apiPut(url, params).done(function() {
                alert('操作成功');
                window.location.reload();
            }).fail(function (resp) {
                alert(resp.msg);
            }).always(function () {
                removeLoading();
            });
        },
        patch: function(url, params) {
            loading();

            if (confirm('是否继续？')) {
                ajax.apiPatch(url, params).done(function() {
                    alert('操作成功');
                    window.location.reload();
                }).fail(function (resp) {
                    alert(resp.msg);
                }).always(function () {
                    removeLoading();
                });
            }
        },
        del: function(url) {
            loading();

            if (confirm('确认删除？')) {
                ajax.apiDelete(url).done(function() {
                    alert('操作成功');
                    window.location.reload();
                }).fail(function (resp) {
                    alert(resp.msg);
                }).always(function () {
                    removeLoading();
                });
            }
        }
    };
});
//# sourceMappingURL=restful.js.map