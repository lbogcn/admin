@extends('blog.basic')

@section('container')
    <div id="index" class="bs">
        <article id="article" class="uk-article">
            <h1 class="uk-article-title">{{$article['title']}}</h1>
            <time class="uk-article-meta"><i class="uk-icon-calendar"></i>{{mb_substr($article['created_at'], 0, 10)}}
            </time>
            <br>
            @foreach($article['contents'] as $content)
                {!! $content['content'] !!}
            @endforeach

            <div class="tags uk-clearfix">
                <div class="tags uk-float-left">
                    <i class="uk-icon-tags"></i>
                    @foreach($article['tags'] as $tag)
                        <a href="{{url('tag/' . urlencode($tag['tag']))}}" rel="tag">{{$tag['tag']}}</a>
                    @endforeach
                </div>
                <div class="uk-float-right"></div>
            </div>
        </article>
    </div>
@endsection