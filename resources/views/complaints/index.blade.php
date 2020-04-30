@extends('layouts.app')

@section('content')
    <h1>Complaints</h1>
    @if(count($complaints) > 0)
        @foreach($complaints as $complaint)
            <div class="well">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/complaints/{{$complaint->id}}">{{$complaint->title}}</a></h3>
                        <small>Written on {{$complaint->created_at}} by {{$complaint->user->name}}</small>
                    </div>
                </div>
            </div>
        @endforeach
        {{$complaints->links()}}
    @else
        <p>No complaints found</p>
    @endif
@endsection