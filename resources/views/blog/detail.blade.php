@extends('blog.basic')

@section('head-extend')
<script type="text/javascript" src="{{cdn('/plugins/ueditor/third-party/SyntaxHighlighter/shCore.js')}}"></script>
<link rel="stylesheet" href="{{cdn('/plugins/ueditor/third-party/SyntaxHighlighter/shCoreDefault.css')}}">
<script type="text/javascript">
    SyntaxHighlighter.all();
</script>
@endsection

@section('container')
    <div class="panel panel-default" id="center">
        <div class="panel-body">
            <div id="article">
                <h1 class="title">{{$article['title']}}</h1>
                <p>
                    <a href="javascript:void(0);" class="author">{{$article['author']}}</a>
                    <time class="time">{{mb_substr($article['write_time'], 0, 10)}}</time>
                </p>
                <br>

                <div class="content">
                    @foreach($article['contents'] as $content)
                        {!! $content['content'] !!}
                    @endforeach
                </div>

                @if(count($article['tags']) > 0)
                    <div class="tags">
                        <span class="glyphicon glyphicon-tags"></span>
                        @foreach($article['tags'] as $tag)
                            <a href="{{url('tag/' . urlencode($tag['tag']))}}" class="tag">{{$tag['tag']}}</a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection