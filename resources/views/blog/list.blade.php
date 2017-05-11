@extends('blog.basic')

@section('container')
    <div class="panel panel-default" id="center">
        <div class="panel-heading">
            <h4 class="header">{{$title}}</h4>
        </div>
        <div class="panel-body">
            @forelse($articles as $article)
                <div class="media article">

                @if ($article['cover_type'] != 1)

                    {{--小图--}}
                    @if ($article['cover_type'] == 2)
                    <div class="media-left media-middle hidden-xs">
                        <a href="{{url('blog/' . $article['id'])}}" title="{{$article['title']}}">
                            <img class="cover-small media-object img-rounded" src="{{$article['cover_url']}}" alt="{{get_option('blog_keywords')}}">
                        </a>
                    </div>
                    @endif

                    {{--大图--}}
                    <div class="row @if ($article['cover_type'] == 2) visible-xs-block @endif">
                        <div class="col-xs-12">
                            <a href="{{url('blog/' . $article['id'])}}" title="{{$article['title']}}">
                                <img class="cover-big media-object img-rounded" src="{{$article['cover_url']}}" alt="{{get_option('blog_keywords')}}">
                            </a>
                        </div>
                    </div>
                @endif

                    <div class="media-body">
                        <h1 class="title h3"><a href="{{url('blog/' . $article['id'])}}" title="{{$article['title']}}">{{$article['title']}}</a></h1>
                        <p class="excerpt">{{$article['excerpt']}}</p>
                        <p class="time">{{mb_substr($article['write_time'], 0, 10)}}</p>
                    </div>
                </div>
            @empty
                <p class="_404">没发现什么...</p>
            @endforelse

            @if(isset($paginate))
                {!! $paginate !!}
            @endif
        </div>
    </div>
@endsection