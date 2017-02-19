@extends('blog.basic')

@section('container')
    <div id="index" class="bs">
        <article id="article" class="uk-article">
            <h1 class="uk-article-title">{{$article['title']}}</h1>
            <time class="uk-article-meta"><i class="uk-icon-calendar"></i>{{date('Y-m-d H:i:s')}}
            </time>
            <br>
            {!! $article['content'] !!}

            <div class="tags uk-clearfix">
                @if(isset($article['tag']) && count($article['tag']) > 0)
                <div class="tags uk-float-left">
                    <i class="uk-icon-tags"></i>
                    @foreach($article['tag'] as $tag)
                        <a href="javascript:void(0);" rel="tag">{{$tag}}</a>
                    @endforeach
                </div>
                @endif
                <div class="uk-float-right"></div>
            </div>
        </article>
    </div>
@endsection