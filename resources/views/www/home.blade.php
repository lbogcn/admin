<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Lenbo的博客</title>
    <link href="{{url('/css/home.css')}}" rel="stylesheet">
</head>
<body>

<div class="container" id="blogs">
    @foreach($paginate as $article)
        <div class="blog">
            <h3 class="title"><a href="{{url('blog', $article->id)}}">{{$article->title}}</a></h3>
            <p class="time">by {{$article->author}} / {{$article->created_at}}</p>
            <p class="excerpt">{{$article->excerpt}}</p>
        </div>
    @endforeach
</div>

<div class="container">
    <div id="paginate">
        <div class="prev">
            <a href="{{$paginate->previousPageUrl()}}">上一页</a>
        </div>

        <div class="next">
            <a href="{{$paginate->nextPageUrl()}}">下一页</a>
        </div>
    </div>
</div>

<div class="container" id="footer">
    <div id="copyright">
        <p>@Lenbo 粤ICP备17008394号</p>
    </div>
</div>

</body>
</html>