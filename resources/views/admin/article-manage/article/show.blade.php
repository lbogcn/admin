@extends('admin.layout')

@section('title', '编辑文章')

@section('head-extend')
    <style>
        .tag .glyphicon{top: 2px; color: #337ab7; cursor: pointer}
        .tag .glyphicon:hover,
        .tag .glyphicon:focus{color: #ff3d36;}
        .tag a:hover,
        .tag a:focus{text-decoration: none;}
    </style>
@endsection

@section('page-wrapper')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">编辑文章</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <form class="form-horizontal" id="dataForm">
                <div class="row">

                    <div class="col-xs-8">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input type="text" class="form-control" name="title" placeholder="标题" value="{{$model->title}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <script id="editor" name="content" type="text/plain" style="width:100%;height:500px;">@foreach($model->contents as $content){!! $content['content'] !!}@endforeach</script>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-2">
                                <button class="btn btn-primary" id="btnSubmit" type="button">提交</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-4">
                        <div class="panel panel-default">
                            <div class="panel-heading"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> 选项</div>
                            <div class="panel-body">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <div class="pull-left"><label class="control-label">状态</label></div>
                                        <div class="col-xs-8">
                                            <label class="radio-inline">
                                                <input type="radio" name="status" value="2" @if($model->status == 2) checked @endif>下线
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="status" value="1" @if($model->status == 1) checked @endif>发布
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="pull-left"><label class="control-label">类型</label></div>
                                        <div class="col-xs-8">
                                            <label class="radio-inline">
                                                <input type="radio" name="type" value="1" @if($model->type == 1) checked @endif>文章
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="type" value="2" @if($model->type == 2) checked @endif>页面
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> 栏目</div>
                            <div class="panel-body">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        @foreach($columns as $column)
                                            @if(in_array($column['id'], $columnIds))
                                                <div class="checkbox"><label><input type="checkbox" name="column[]" value="{{$column['id']}}" checked>{{$column['column_name']}}</label></div>
                                            @else
                                                <div class="checkbox"><label><input type="checkbox" name="column[]" value="{{$column['id']}}">{{$column['column_name']}}</label></div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading"><span class="glyphicon glyphicon-tag" aria-hidden="true"></span> 标签</div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="col-xs-8">
                                        <input type="text" class="form-control" id="iptTags">
                                    </div>
                                    <div class="col-xs-4">
                                        <button class="btn btn-default btn-block" id="btnAddTag" type="button">添加</button>
                                    </div>

                                    <br>
                                    <div class="col-xs-12">
                                        <span id="helpBlock" class="help-block">多个标签请用英文逗号（,）分开</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-12" id="tagBox">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <a href="javascript:void(0);" id="btnAllTagBox">从常用标签中选择</a>
                                    </div>
                                </div>

                                <div class="form-group hide" id="allTagBox">
                                    <div class="col-xs-12">
                                        @foreach($tags as $tag)
                                            <a href="javascript:void(0);"><u class="tag">{{$tag['tag']}}</u></a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection

@section('body-extend')
<script type="text/plain" id="uploadToken">{{$uploadToken}}</script>
<script type="text/plain" id="jsonTags">{!! json_encode(array_column($model->tags->toArray(), 'tag')) !!}</script>
<script>
    require(['jquery', 'restful', 'ueditor', 'zeroclipboard', 'ueditor-lang'], function($, restful, UE, zcl) {
        window.ZeroClipboard = zcl;
        window.uploadToken = '{{$uploadToken}}';
        var ue = UE.getEditor('editor');

        // 添加标签
        function addTag(tag) {
            if (!tag) {
                return;
            }

            var exists = false;
            $('.tag', '#tagBox').each(function() {
                if ($(this).data('tag') == tag) {
                    exists = true;
                    return false;
                }
            });

            if (!exists) {
                var $tag = $('<div class="tag pull-left" style="margin-right: 5px;">\
                    <span class="glyphicon glyphicon-remove-sign"></span>\
                    <a href="javascript:void(0);"></a>\
                    <input type="hidden" name="tag[]" role="tag">\
                    </div>');

                $tag.attr('data-tag', tag).data('tag', tag);
                $tag.find('a').html(tag);
                $tag.find('[role=tag]').val(tag);
                $('#tagBox').append($tag);
                $tag.find('.glyphicon-remove-sign').click(function() {
                    $tag.remove();
                });
            }
        }

        // 添加标签按钮
        $('#btnAddTag').click(function() {
            var tags = $('#iptTags').val().split(',');
            $('#iptTags').val('');
            for (var i in tags) {
                addTag(tags[i]);
            }
        });

        // 显示隐藏常用标签
        $('#btnAllTagBox').click(function() {
            if ($('#allTagBox').hasClass('hide')) {
                $('#allTagBox').removeClass('hide');
            } else {
                $('#allTagBox').addClass('hide');
            }
        });

        // 选择常用标签
        $('.tag', '#allTagBox').click(function() {
            addTag($(this).html());
        });

        // 提交
        $('#btnSubmit').click(function() {
            restful.put('/article-manage/article/{{$model->id}}', $('#dataForm').serialize());
        });

        var tags = JSON.parse($('#jsonTags').html());
        for (var i in tags) {
            addTag(tags[i]);
        }
    });
</script>
@endsection