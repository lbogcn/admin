@extends('admin.layout')

@section('title', '评论列表')

@section('head-extend')
    <link href="{{url('/plugins/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet">
@endsection

@section('page-wrapper')
    <div class="col-lg-12">
        <h1 class="page-header">评论列表</h1>
    </div>

    <div class="row">
        <div class="col-xs-2 col-xs-offset-10">
            <div class="btn-group pull-right">
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>文章ID</th>
                    <th>用户</th>
                    <th>内容</th>
                    <th>状态</th>
                    <th>创建时间</th>
                    <th>是否删除</th>
                    <th>操作</th>
                </tr>
                </thead>

                <tbody id="table-body">
                <tr><td colspan="50">暂无数据。</td></tr>
                </tbody>

            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6 col-xs-offset-6 text-right">
            {!! $paginate->render() !!}
        </div>
    </div>

@endsection

@section('body-extend')
    <div class="hide" id="paginate">{!! $paginate->toJson() !!}</div>
    <script>
        $(function() {

            // 删除
            function deny(id) {
                if (confirm('确认禁用？')) {
                    $.post('/article-manage/comment/deny/' + id, {_method: 'PATCH'}, function(resp) {
                        if (resp.code == 0) {
                            alert('成功');
                            window.location.reload();
                        } else {
                            alert(resp.msg);
                        }
                    });
                }
            }

            // 恢复
            function restore(id) {
                if (confirm('确认恢复？')) {
                    $.post('/article-manage/comment/restore/' + id, {_method: 'PATCH'}, function(resp) {
                        if (resp.code == 0) {
                            alert('成功');
                            window.location.reload();
                        } else {
                            alert(resp.msg);
                        }
                    });
                }
            }

            // 加载数据
            var data = JSON.parse($('#paginate').html()).data,
                $tableBody = $('#table-body');
            $tableBody.html('');
            $.each(data, function(i, obj) {
                var $tr = $('<tr></tr>'),
                    $option = $('<td>\
                        <a href="javascript:void(0);" class="btn-deny">禁用</a>\
                        <a href="javascript:void(0);" class="btn-restore">恢复</a>\
                        </td>'),
                    $statusLabel = $('<label class="label"></label>'),
                    isDeleted = obj.is_deleted ? '是' : '否' ;

                var title = obj.article ? obj.article.title : '';
                var username = obj.user ? obj.user.username : '';

                if (obj.status == 1) {
                    $statusLabel.html('正常');
                    $statusLabel.addClass('label-info');
                    $option.find('.btn-restore').hide();
                } else {
                    $statusLabel.html('禁用');
                    $statusLabel.addClass('label-default');
                    $option.find('.btn-deny').hide();
                }

                $tr.append('<td>' + obj.id + '</td>');
                $tr.append('<td>' + title + '</td>');
                $tr.append('<td>' + username + '</td>');
                $tr.append('<td>' + obj.content + '</td>');
                $tr.append($('<td></td>').append($statusLabel));
                $tr.append('<td>' + obj.created_at + '</td>');
                $tr.append('<td>' + isDeleted + '</td>');
                $tr.append($option);

                $option.find('.btn-deny').click(function() {deny(obj.id)});
                $option.find('.btn-restore').click(function() {restore(obj.id)});
                $tableBody.append($tr);
            });
        });
    </script>
@endsection