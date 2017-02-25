@extends('blog.basic')

@section('container')
    <div class="panel panel-default" id="center">
        <div class="panel-body">
            <div id="article">
                <h1 class="title">{{$article['title']}}</h1>
                <p>
                    <a href="javascript:void(0);" class="author">{{$article['author']}}</a>
                    <time class="time">{{date('Y-m-d')}}</time>
                </p>
                <br>

                <div class="content">
                    {!! $article['content'] !!}
                </div>

                @if(isset($article['tag']) && count($article['tag']) > 0)
                    <div class="tags">
                        <span class="glyphicon glyphicon-tags"></span>
                        @foreach($article['tag'] as $tag)
                            <a href="javascript:void(0);" class="tag">{{$tag}}</a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection