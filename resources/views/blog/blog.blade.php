<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{$article->title}} - Lenbo的博客</title>
    <link href="{{url('/css/blog.css')}}" rel="stylesheet">
</head>
<body>

<div class="container" id="article">
    <h1 class="title">{{$article->title}}</h1>
    <p class="time">by {{$article->author}} / {{$article->created_at}}</p>

    <div class="content">
        @foreach($article->contents as $content){!! $content->content !!}@endforeach
    </div>
</div>

<div class="container" id="footer">
    <div id="copyright">
        <p>&copy; {{date('Y')}} Lenbo 粤ICP备17008394号</p>
    </div>
</div>

</body>
</html>