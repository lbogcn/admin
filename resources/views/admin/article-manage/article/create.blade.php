@extends('admin.layout')

@section('title', '写文章')

@section('head-extend')
    <script type="text/javascript" charset="utf-8" src="{{cdn('plugins/ueditor/ueditor.config.js')}}"></script>
    <script type="text/javascript" charset="utf-8" src="{{cdn('plugins/ueditor/ueditor.all.min.js')}}"> </script>
    <script type="text/javascript" charset="utf-8" src="{{cdn('plugins/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
@endsection

@section('page-wrapper')
    <div class="col-lg-12">
        <h1 class="page-header">写文章</h1>
    </div>

    <script id="editor" type="text/plain" style="width:100%;height:500px;"></script>

@endsection

@section('body-extend')
<script>
require(['jquery', 'restful'], function($, restful) {
    var ue = UE.getEditor('editor');
});
</script>
@endsection