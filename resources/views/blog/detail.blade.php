@extends('blog.basic')

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