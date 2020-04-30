@extends('layouts.app')

@section('content')
    <h1>Edit Complaint</h1>
    {!! Form::open(['action' => ['ComplaintsController@update', $complaint->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $complaint->title, ['class' => 'form-control', 'placeholder' => 'Complaint Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('description', 'Description')}}
            {{Form::textarea('description', $complaint->description, [ 'class' => 'form-control', 'placeholder' => 'Complaint Description'])}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection