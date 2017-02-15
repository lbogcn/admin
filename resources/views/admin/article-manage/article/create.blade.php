@extends('admin.layout')

@section('title', '写文章')

@section('head-extend')
@endsection

@section('page-wrapper')
    <div class="col-lg-12">
        <h1 class="page-header">写文章</h1>
    </div>

    <script id="editor" type="text/plain" style="width:100%;height:300px;"></script>

@endsection

@section('body-extend')
    <script>
        require(['jquery', 'restful', 'ueditor', 'zeroclipboard', 'ueditor-lang'], function($, restful, UE, zcl) {
            window.uploadToken = '{{$uploadToken}}';
            window.ZeroClipboard = zcl;
            var ue = UE.getEditor('editor');
        });
    </script>
@endsection