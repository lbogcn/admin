@extends('blog.basic')

@section('container')
    <div id="index" class="bs">
        <h1 class="h4">所有栏目</h1>
        <div id="list" class="category">
            <p class="date"><strong>{{get_option('blog_name')}}</strong>目前共有栏目：{{$stat['columnTotal']}}</p>

            @foreach($columns as $column)
                <a href="{{url('column/' . urlencode($column['alias']))}}" data-uk-tooltip="">{{$column['column_name']}}</a>
            @endforeach


        </div>
    </div>
@endsection