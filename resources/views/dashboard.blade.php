@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a href="/complaints/create" class="btn btn-primary">Submit Complaint</a>
                    <h3>Your Complaints</h3>
                    @if(count($complaints) > 0)
                        <table class="table table-striped">
                            <tr>
                                <th>Title</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($complaints as $complaint)
                                <tr>
                                    <td>{{$complaint->title}}</td>
                                    <td><a href="/complaints/{{$complaint->id}}/edit" class="btn btn-default">Edit</a></td>
                                    <td>
                                        {!!Form::open(['action' => ['ComplaintsController@destroy', $complaint->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                        {!!Form::close()!!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>You have no complaints</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
