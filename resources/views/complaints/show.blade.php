@extends('layouts.app')

@section('content')
    <a href="/complaints" class="btn btn-default">Go Back</a>
    <h1>{{$complaint->title}}</h1>
    <br><br>
    <div>
        {!!$complaint->description!!}
    </div>

    @if(!Auth::guest())
        @if(Auth::user()->id == $complaint->user_id)
            <a href="/posts/{{$complaint->id}}/edit" class="btn btn-default">Edit</a>

            {!!Form::open(['action' => ['ComplaintsController@destroy', $complaint->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif
@endsection