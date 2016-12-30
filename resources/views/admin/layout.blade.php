<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{env('APP_NAME')}}</title>
    <link href="{{url('/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{url('/css/sb-admin-2.css')}}" rel="stylesheet">
    <link href="{{url('/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{url('/plugins/metisMenu/metisMenu.min.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="//oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @yield('head-extend')
</head>

<body>
<div id="wrapper">
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <!-- 导航左部 -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="javascript:void(0);">{{env('APP_NAME')}}</a>
        </div>

        <!-- 导航右部 -->
        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li>
                        <a href="javascript:void(0);"><i class="fa fa-user fa-fw"></i> {{Auth::guard('admin')->user()->name}}</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{route('logout')}}"><i class="fa fa-sign-out fa-fw"></i> 退出登录</a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- 菜单栏 -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    {!! $share['menu'] !!}
                </ul>
            </div>
        </div>
    </nav>

    <div id="page-wrapper">
        @yield('page-wrapper')
    </div>
</div>

<script src="{{url('/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{url('/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{url('/plugins/metisMenu/metisMenu.min.js')}}"></script>
<script src="{{url('/js/sb-admin-2.min.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('body-extend')
</body>
</html>