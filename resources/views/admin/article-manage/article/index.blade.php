@extends('admin.layout')

@section('title', '文章列表')

@section('head-extend')
    <link href="{{cdn('/plugins/datatables-plugins/dataTables.bootstrap.css')}}" rel="stylesheet">
@endsection

@section('page-wrapper')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">文章列表</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-2 col-xs-offset-10">
            <div class="btn-group pull-right">
                <a class="btn btn-success" href="{{url('/article-manage/article/create')}}">写文章</a>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>用户</th>
                    <th>标题</th>
                    <th>作者</th>
                    <th>类型</th>
                    <th>状态</th>
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

@endsection

@section('body-extend')
<div class="hide" id="paginate">{!! $paginate->toJson() !!}</div>
<script>
require(['jquery', 'restful'], function($, restful) {
    function detail(id) {
        window.open('//{{env('DOMAIN_BLOG')}}/blog/' + id);
    }

    // 加载数据
    var data = JSON.parse($('#paginate').html()).data,
        $tableBody = $('#table-body');
    $tableBody.html('');
    $.each(data, function(i, obj) {
        var $tr = $('<tr></tr>'),
            $option = $('<td>\
                <a href="javascript:void(0);" class="btn-detail">详情</a>\
                <a href="javascript:void(0);" class="btn-up">上架</a>\
                <a href="javascript:void(0);" class="btn-down">下架</a>\
                <a href="/article-manage/article/' + obj.id + '" class="btn-edit">编辑</a>\
                <a href="javascript:void(0);" class="btn-delete">删除</a>\
                </td>'),
            $statusLabel = $('<label class="label"></label>');

        // 上下架按钮只显示一个
        if (obj.status == 1) {
            $option.find('.btn-up').hide();
            $statusLabel.addClass('label-info');
        } else {
            $option.find('.btn-down').hide();
            $statusLabel.addClass('label-default');
        }

        $statusLabel.html(obj.status_text);

        $tr.append('<td>' + obj.id + '</td>');
        $tr.append('<td>' + obj.user_id + '</td>');
        $tr.append('<td>' + obj.title + '</td>');
        $tr.append('<td>' + obj.author + '</td>');
        $tr.append('<td>' + obj.type_text + '</td>');
        $tr.append($('<td></td>').append($statusLabel));
        $tr.append('<td>' + obj.created_at + '</td>');
        $tr.append($option);

        $option.find('.btn-detail').click(function() {detail(obj.id)});
        $option.find('.btn-up').click(function() {restful.patch('/article-manage/article/up/' + obj.id)});
        $option.find('.btn-down').click(function() {restful.patch('/article-manage/article/down/' + obj.id)});
        $option.find('.btn-delete').click(function() {restful.del('/article-manage/article/' + obj.id)});
        $tableBody.append($tr);
    });
});
</script>
@endsection