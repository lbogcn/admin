@extends('blog.basic')

@section('container')
    <div id="index" class="bs">
        <h4>{{$title}}</h4>
        <div id="list">
            @forelse($articles as $article)
                <article class="article">
                    <h1><a href="{{url('blog/' . $article['id'])}}">{{$article['title']}}</a></h1>
                    <p>
                        {{$article['excerpt']}}
                        <time><br>{{mb_substr($article['created_at'], 0, 10)}}</time>
                    </p>
                </article>
            @empty
                <p class="_404">没发现什么...</p>
            @endforelse
        </div>
    </div>

    @if(isset($paginate))
        {!! $paginate !!}
    @endif
@endsection