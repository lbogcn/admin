@extends('blog.basic')

@section('container')
    <div class="panel panel-default" id="center">
        <div class="panel-heading">
            <h4 class="header">所有栏目</h4>
        </div>
        <div class="panel-body">
            @foreach($columns as $column)
                <a href="{{url('column/' . urlencode($column['alias']))}}" class="column">{{$column['column_name']}}</a>
            @endforeach
        </div>
    </div>
@endsection