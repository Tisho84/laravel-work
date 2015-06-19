@extends('app')
@section('title', 'Order statuses')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Order statuses
                        <a href="{{ route('statuses.create') }}" class="btn btn-primary btn-xs pull-right"> new status</a>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($statuses as $status)
                                <tr>
                                    <td>{{ $status->name }}</td>
                                    <td>
                                        {!! Form::open(['url' => "statuses/{$status->id}", 'method' => 'delete']) !!}

                                        <a href="{{ route('statuses.edit', [$status->id])}}" class="btn btn-xs btn-success">edit</a>

                                        {!! Form::submit('delete', ['class' => 'btn btn-danger btn-xs']) !!}

                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

