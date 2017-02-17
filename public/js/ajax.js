define(['jquery'], function($) {
    function handle(url, params, type, showError) {
        showError = showError || true;

        return $.ajax({
            url: url,
            data: params || {},
            type: type || 'GET',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).then(function (resp, status, xhr) {
            // 成功回调
            if (resp.code == 0) {
                // 直接返回要处理的数据，作为默认参数传入之后done()方法的回调
                return resp.data;
            } else {
                // 返回一个失败状态的deferred对象，把错误代码作为默认参数传入之后fail()方法的回调
                return $.Deferred().reject(xhr, resp.msg);
            }
        }, function (xhr) {
            return $.Deferred().reject(xhr);
        }).fail(function(xhr, msg) {
            if (!msg) {
                msg = 'URL：' + url + "\n" + '网络请求失败！' + "\n" + xhr.status + '：' + xhr.statusText;
                console.log(xhr);
            }

            if (showError) {
                alert(msg);
            }
        });
    }

    return {
        apiGet: function(url, params) {
            return handle(url, params);
        },
        apiPost: function(url, params) {
            return handle(url, params, 'POST');
        },
        apiPut: function(url, params) {
            return handle(url, params, 'PUT');
        },
        apiPatch: function(url, params) {
            return handle(url, params, 'PATCH');
        },
        apiDelete: function(url, params) {
            return handle(url, params, 'DELETE');
        },
        handle: handle
    };
});
//# sourceMappingURL=ajax.js.map
