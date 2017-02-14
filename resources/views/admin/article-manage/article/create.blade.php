@extends('admin.layout')

@section('title', '写文章')

@section('head-extend')
@endsection

@section('page-wrapper')
    <div class="col-lg-12">
        <h1 class="page-header">写文章</h1>
    </div>


    <form method="post" action="http://up-z2.qiniu.com" enctype="multipart/form-data">
        <input name="token" type="hidden" value="{{$uploadToken}}">
        <input name="file" type="file" />
        <input type="submit" value="submit">
    </form>

@endsection

@section('body-extend')
<script>
require(['jquery', 'restful'], function($, restful) {
});
</script>
@endsection