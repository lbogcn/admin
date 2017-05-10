@extends('blog.basic')

@section('container')
    <div class="panel panel-default" id="center">
        <div class="panel-heading">
            <h4 class="header">标签</h4>
        </div>
        <div class="panel-body">
            <div id="tags">
                @foreach($tags as $tag)
                    <a href="{{url('tag/' . urlencode($tag['tag']))}}" class="tag">{{$tag['tag']}}</a>
                @endforeach
            </div>
        </div>
    </div>
@endsection