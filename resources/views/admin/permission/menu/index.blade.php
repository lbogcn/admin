@extends('admin.layout')

@section('title', '菜单列表')

@section('head-extend')
    <link href="{{url('/plugins/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet">
@endsection

@section('page-wrapper')
    <div class="col-lg-12">
        <h1 class="page-header">菜单列表</h1>
    </div>

    <div class="row">
        <div class="col-xs-2 col-xs-offset-10">
            <div class="btn-group pull-right">
                <button class="btn btn-success" id="btn-add">新增</button>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>父ID</th>
                    <th>名称</th>
                    <th>权重</th>
                    <th>路由</th>
                    <th>所属权限节点</th>
                    <th>创建时间</th>
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

    <div class="modal fade" id="modal" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-xs-3 control-label">父ID</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="pid">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-3 control-label">名称</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-3 control-label">权重</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="weight" value="50">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-3 control-label">路由</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="route">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-xs-3 control-label">所属权限节点</label>
                            <div class="col-sm-9">
                                <select name="node_id" class="form-control">
                                @foreach($permissions as $permission)
                                    <option value="{{$permission->id}}">{{$permission->node}} - {{$permission->route}}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary btn-submit">提交</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body-extend')
    <div class="hide" id="paginate">{!! $paginate->toJson() !!}</div>
    <script>
        $(function() {

            // 显示modal
            function showModal(defObj, title) {
                defObj = defObj || {};
                var $modal = $('#modal').clone();

                $modal.on('hidden.bs.modal', function() {
                    $modal.remove();
                });

                $modal.find('.modal-title').html(title);
                $modal.find('[name=pid]').val(defObj.pid || '0');
                $modal.find('[name=name]').val(defObj.name || '');
                $modal.find('[name=weight]').val(defObj.weight || '');
                $modal.find('[name=route]').val(defObj.route || '');
                $modal.find('option[value=' + defObj.node_id + ']', '[name=node_id]').attr('selected', true);

                $modal.modal();

                return $modal;
            }

            // 新增事件
            $('#btn-add').click(function() {
                add();
            });

            // 新增
            function add(defObj) {
                var $modal = showModal(defObj, '新增'),
                    $form = $modal.find('form');

                $modal.find('.btn-submit').click(function() {
                    $.post('/permission/menu', $form.serialize(), function (resp) {
                        if (resp.code == 0) {
                            alert('提交成功');
                            window.location.reload();
                        } else {
                            alert(resp.msg);
                        }
                    });
                });
            }

            // 编辑
            function edit(obj) {
                var $modal = showModal(obj, '编辑'),
                    $form = $modal.find('form');

                $form.append('<input type="hidden" name="_method" value="PUT">');

                $modal.find('.btn-submit').click(function() {
                    $.post('/permission/menu/' + obj.id, $form.serialize(), function(resp) {
                        if (resp.code == 0) {
                            alert('提交成功');
                            window.location.reload();
                        } else {
                            alert(resp.msg);
                        }
                    });
                });
            }

            // 删除
            function deleted(id) {
                if (confirm('确认删除？')) {
                    $.post('/permission/menu/' + id, {_method: 'DELETE'}, function(resp) {
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
                var $tr = $('<tr></tr>');
                var $option = $('<td>\
                        <a href="javascript:void(0);" class="btn-edit">编辑</a>\
                        <a href="javascript:void(0);" class="btn-copy">复制</a>\
                        <a href="javascript:void(0);" class="btn-delete">删除</a>\
                        </td>');

                $tr.append('<td>' + obj.id + '</td>');
                $tr.append('<td>' + obj.pid + '</td>');
                $tr.append('<td>' + obj.name + '</td>');
                $tr.append('<td>' + obj.weight + '</td>');
                $tr.append('<td>' + obj.route + '</td>');
                $tr.append('<td>' + (obj.node ? obj.node.node : '') + '</td>');
                $tr.append('<td>' + obj.created_at + '</td>');
                $tr.append($option);

                $option.find('.btn-edit').click(function() {edit(obj)});
                $option.find('.btn-copy').click(function() {add(obj)});
                $option.find('.btn-delete').click(function() {deleted(obj.id)});
                $tableBody.append($tr);
            });
        });
    </script>
@endsection