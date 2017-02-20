@extends('blog.basic')

@section('container')
    <div id="index" class="bs">
        <h1 class="h4">标签</h1>
        <div id="list" class="tag">
            <p class="date"><strong>{{get_option('blog_title')}}</strong>目前共有标签：  {{$stat['tagTotal']}}个  </p>
            @foreach($tags as $tag)
                <a href="{{url('tag/' . urlencode($tag['tag']))}}" class="tag-link-6 tag-link-position-1" style="font-size: 14px;">{{$tag['tag']}}</a>
            @endforeach
        </div>
    </div>
@endsection