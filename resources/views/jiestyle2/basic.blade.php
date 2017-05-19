<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>{{$pageName}} - {{get_option('blog_title')}}</title>
    <meta name="keywords" content="@if(isset($blogKeywords)){{$blogKeywords}},@endif{{get_option('blog_keywords')}}" />
    <meta name="description" content="{{$blogDescription or get_option('blog_description')}}" />
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{url('jiestyle2/css/style.css')}}">
    @yield("head-extend")
</head>

<body>
<header id="header">
    <div class="avatar">
        <img src="{{get_option('avatar')}}" alt="{{get_option('blog_keywords')}}" class="img-circle" width="50%">
    </div>
    <h3 id="name">{{get_option('blog_title')}}</h3>
    <div class="sns">
        <a href="https://github.com/islenbo" rel="nofollow" title="Github"><i class="fa fa-github" aria-hidden="true"></i></a>
    </div>
    <div class="nav">
        <ul>
            @foreach(getBlogNavs() as $nav)
                @if($nav['active'])
                    <li><a href="{{$nav['url']}}">{{$nav['column_name']}}</a></li>
                @else
                    <li><a href="{{$nav['url']}}">{{$nav['column_name']}}</a></li>
                @endif
            @endforeach
        </ul>
    </div>
</header>

<div id="main">
    @yield("main")
</div>

<footer id="footer">
    <div class="copyright">
        <p><i class="fa fa-copyright" aria-hidden="true"></i> {{date('Y')}} <b>Lenbo</b></p>
        <p>Theme by <a target="_blank"><b>JieStyle Two</b></a> | {{get_option('icp_number')}}</p>
    </div>
</footer>
<script type="text/javascript" src="{{url('jiestyle2/js/skel.min.js')}}"></script>
<script type="text/javascript" src="{{url('jiestyle2/js/util.min.js')}}"></script>
<script type="text/javascript" src="{{url('jiestyle2/js/nav.js')}}"></script>
<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?d0754ebee2c0ba0c2983368f42b0462c";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();

    (function(){
        var bp = document.createElement('script');
        var curProtocol = window.location.protocol.split(':')[0];
        if (curProtocol === 'https') {
            bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';
        } else {
            bp.src = 'http://push.zhanzhang.baidu.com/push.js';
        }
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(bp, s);
    })();
</script>
@yield("body-extend")
</body>
</html>