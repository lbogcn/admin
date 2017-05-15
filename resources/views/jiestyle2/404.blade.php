<?php $pageName = '您访问的页面不存在'; ?>
@extends("jiestyle2.basic")

@section("main")
    <div class="col-md-8 col-md-offset-2 clearfix">
        <div class="errors_404"><img src="{{url('jiestyle2/images/404.png')}}" alt="404"></div>
        <div class="errors_link"><a class="btn btn-default btn-lg" href="/" role="button"><i class="fa fa-home" aria-hidden="true"></i> 回首页</a><a class="btn btn-default btn-lg" href="javascript:history.go(-1)" role="button"><i class="fa fa-reply" aria-hidden="true"></i> 返回上一页</a></div>
    </div>
@endsection