<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>{{$pageName}} - {{get_option('blog_title')}}</title>
    <meta name="keywords" content="{{$blogKeywords or get_option('blog_keywords')}}"/>
    <meta name="description" content="{{$blogDescription or get_option('blog_description')}}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" href="{{cdn('css/style.css')}}" type="text/css" media="all" />
</head>
<body>

<div id="main" class="wp uk-grid uk-grid-collapse">
    <div class="uk-width-small-1-1 uk-width-medium-1-4 uk-width-large-1-5">
        <div id="head" data-uk-sticky="{boundary: true}">
            <div class="uk-panel">
                <div class="tx">
                    <img src="{{get_option('avatar')}}" />
                </div>
                <h1 class="uk-panel-title">{{get_option('blog_title')}}</h1>
                <span> {{get_option('blog_subtitle')}}</span>
                <div class="my uk-grid-collapse uk-grid uk-grid-width-1-3">
                    <div>
                        <span>{{$stat['articleTotal']}}</span>
                        <span><i class="uk-icon-file-text"></i></span>
                        <a href="{{url('blog')}}" title="文章" data-uk-tooltip="{pos:'bottom'}"></a>
                    </div>
                    <div>
                        <span>{{$stat['columnTotal']}}</span>
                        <span><i class="uk-icon-folder"></i></span>
                        <a href="{{url('column')}}" title="分类" data-uk-tooltip="{pos:'bottom'}"></a>
                    </div>
                    <div>
                        <span>{{$stat['tagTotal']}}</span>
                        <span><i class="uk-icon-tags"></i></span>
                        <a href="{{url('tag')}}" title="标签" data-uk-tooltip="{pos:'bottom'}"></a>
                    </div>
                </div>
                <ul id="nav-top" class="uk-nav">
                    @foreach($navs as $nav)
                        @if($nav['active'])
                            <li class="uk-active"><a href="{{$nav['url']}}">{{$nav['column_name']}}</a></li>
                        @else
                            <li><a href="{{$nav['url']}}">{{$nav['column_name']}}</a></li>
                        @endif
                    @endforeach
                </ul>
                {{--<form class="uk-form" id="searchform" method="get" action="http://www.lbog.cn">--}}
                    {{--<input class="uk-width-1-1 " type="text" value="" name="s" id="s" placeholder="搜索" />--}}
                {{--</form>--}}
            </div>
            <div class="ft uk-hidden-small">
                <p>
                    <span style="font-family: arial; font-size: 13px;">&copy; lenbo {{date('Y')}} </span>
                    <br>
                    <span style="font-family: arial; font-size: 13px;">{{get_option('icp_number')}}</span>
                </p>
            </div>
        </div>
    </div>

    <div class="uk-width-small-1-1 uk-width-medium-3-4 uk-width-large-4-5">
        @yield('container')

        <div class="ft uk-visible-small">
            <p>
                <span style="font-family: arial; font-size: 13px;">&copy; lenbo {{date('Y')}} </span>
                <br>
                <span style="font-family: arial; font-size: 13px;">{{get_option('icp_number')}}</span>
            </p>
        </div>
    </div>
</div>

<script src="//libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
<script src="{{cdn('js/blog.js')}}"></script>

@yield('footer')

<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?d0754ebee2c0ba0c2983368f42b0462c";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>

<script type="text/javascript">
    /*底部悬浮*/
    var cpro_id = "u2900501";
</script>
<script type="text/javascript" src="http://cpro.baidustatic.com/cpro/ui/c.js"></script>

</body>
</html>