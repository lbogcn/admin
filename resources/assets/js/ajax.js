define(['jquery'], function($) {
    // 生成ajax对象
    function build(url, params, type) {
        return $.ajax({
            url: url,
            data: params || {},
            type: type || 'GET',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    // 处理
    function handle(url, params, type) {
        return build(url, params, type).then(function (resp) {
            // 成功回调
            if (resp.code == 0) {
                return resp.data; // 直接返回要处理的数据，作为默认参数传入之后done()方法的回调
            } else {
                return $.Deferred().reject(resp); // 返回一个失败状态的deferred对象，把错误代码作为默认参数传入之后fail()方法的回调
            }
        }, function (xhr) {
            console.log(xhr);
            alert(url + "\n" + '网络请求失败！');
        });
    }

    // handle('/').done(function (resp) {
    //     // 当result为true的回调
    // }).fail(function (err) {
    //     console.log(err);
    // });

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
        }
    };
});