@extends('blog.basic')

@section('container')
    <div class="panel panel-default" id="center">
        <div class="panel-heading">
            <h3 class="header">{{$title}}</h3>
        </div>
        <div class="panel-body">
            @forelse($articles as $article)
                <article class="article">
                    <h3 class="title"><a href="{{url('blog/' . $article['id'])}}">{{$article['title']}}</a></h3>
                    <p class="excerpt">{{$article['excerpt']}}</p>
                    <p class="time">{{mb_substr($article['write_time'], 0, 10)}}</p>
                </article>
            @empty
                <p class="_404">没发现什么...</p>
            @endforelse

            @if(isset($paginate))
                {!! $paginate !!}
            @endif
        </div>
    </div>
@endsection