@extends("jiestyle2.basic")

@section("main")
    <article class="col-md-8 col-md-offset-2 view clearfix">
        <h1 class="view-title">{{$article['title']}}</h1>
        <div class="view-content">@foreach($article['contents'] as $content){!! $content['content'] !!}@endforeach</div>
    </article>
@endsection