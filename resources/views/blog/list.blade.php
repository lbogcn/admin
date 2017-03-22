@extends('blog.basic')

@section('container')
    <div class="panel panel-default" id="center">
        <div class="panel-heading">
            <h3 class="header">{{$title}}</h3>
        </div>
        <div class="panel-body">
            @forelse($articles as $article)
                <div class="media article">

                @if ($article['cover_type'] != 1)

                    {{--小图--}}
                    @if ($article['cover_type'] == 2)
                    <div class="media-left media-middle hidden-xs">
                        <a href="{{url('blog/' . $article['id'])}}">
                            <img class="cover-small media-object img-rounded" src="{{$article['cover_url']}}">
                        </a>
                    </div>
                    @endif

                    {{--大图--}}
                    <div class="row @if ($article['cover_type'] == 2) visible-xs-block @endif">
                        <div class="col-xs-12">
                            <a href="{{url('blog/' . $article['id'])}}">
                                <img class="cover-big media-object img-rounded" src="{{$article['cover_url']}}">
                            </a>
                        </div>
                    </div>
                @endif

                    <div class="media-body">
                        <h3 class="title"><a href="{{url('blog/' . $article['id'])}}">{{$article['title']}}</a></h3>
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