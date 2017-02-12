@extends('blog.nav')

@section('container')
    <div id="index" class="bs">
        <h4>最新文章</h4>
        <div id="list">
            @foreach($articles as $article)
                <article class="article">
                    <h1><a href="{{url('blog/' . $article['id'])}}">{{$article['title']}}</a></h1>
                    <p>
                        {{$article['excerpt']}}
                        <time><br>{{mb_substr($article['created_at'], 0, 10)}}</time>
                    </p>
                </article>
            @endforeach
        </div>
    </div>
    <ul class="uk-pagination">
    </ul>
@endsection