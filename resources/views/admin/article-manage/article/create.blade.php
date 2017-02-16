@extends('admin.layout')

@section('title', '写文章')

@section('head-extend')
    <style>
        .tag .glyphicon{top: 2px; color: #337ab7; cursor: pointer}
        .tag .glyphicon:hover,
        .tag .glyphicon:focus{color: #ff2020;}
        .tag a:hover,
        .tag a:focus{text-decoration: none;}
    </style>
@endsection

@section('page-wrapper')
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">写文章</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <form class="form-horizontal">
                <div class="row">

                    <div class="col-xs-8">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <input type="text" class="form-control" placeholder="标题">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12">
                                <script id="editor" type="text/plain" style="width:100%;height:300px;"></script>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-2">
                                <button class="btn btn-primary" type="button">提交</button>
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
                                                <input type="radio" name="status" value="2" checked>草稿
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="status" value="1">发布
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="pull-left"><label class="control-label">类型</label></div>
                                        <div class="col-xs-8">
                                            <label class="radio-inline">
                                                <input type="radio" name="type" value="1" checked>文章
                                            </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="type" value="2">页面
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
                                            <div class="checkbox"><label><input type="checkbox" name="column" value="{{$column['id']}}">{{$column['column_name']}}</label></div>
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
                                        <input type="text" class="form-control" name="tag">
                                    </div>
                                    <div class="col-xs-4">
                                        <button class="btn btn-default btn-block">添加</button>
                                    </div>

                                    <br>
                                    <div class="col-xs-12">
                                        <span id="helpBlock" class="help-block">多个标签请用英文逗号（,）分开</span>
                                    </div>
                                </div>

                                <div class="form-group" id="tagBox">
                                    <div class="col-xs-12">
                                        <span class="tag">
                                            <span class="glyphicon glyphicon-remove-sign"></span>
                                            <a href="javascript:void(0);">test</a>
                                        </span>
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
                                            <a href="javascript:void(0);"><u>{{$tag['tag']}}</u></a>
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
<script>
    require(['jquery', 'restful', 'ueditor', 'zeroclipboard', 'ueditor-lang'], function($, restful, UE, zcl) {
        window.ZeroClipboard = zcl;
        window.uploadToken = '{{$uploadToken}}';
        var ue = UE.getEditor('editor');

        function addTag(tag) {
            console.log(tag);
        }

        $('#btnAllTagBox').click(function() {
            if ($('#allTagBox').hasClass('hide')) {
                $('#allTagBox').removeClass('hide');
            } else {
                $('#allTagBox').addClass('hide');
            }
        });

        $('a', '#allTagBox').click(function() {
            addTag($(this).html());
        });
    });
</script>
@endsection