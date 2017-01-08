define(['ajax'], function(ajax) {
    return {
        deny: function(url) {
            if (confirm('确认禁用？')) {
                ajax.apiPatch(url);
            }
        },
        restore: function(url) {
            if (confirm('确认恢复？')) {
                ajax.apiPatch(url);
            }
        },
        get: function (url, params) {
            return ajax.apiGet(url, params);
        },
        post: function (url, params) {
            ajax.apiPost(url, params);
        },
        put: function(url, params) {
            ajax.apiPut(url, params);
        },
        patch: function(url, params) {
            if (confirm('是否继续？')) {
                ajax.apiPatch(url, params);
            }
        },
        del: function(url) {
            if (confirm('确认删除？')) {
                ajax.apiDelete(url);
            }
        }
    };
});