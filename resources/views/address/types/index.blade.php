@extends('app')
@section('title', 'Address types')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Address types
                        <a href="{{ url('types/addresses/create') }}" class="btn btn-primary btn-xs pull-right"> new type</a>
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
                            @foreach($results as $result)
                                <tr>
                                    <td>{{ $result->name }}</td>
                                    <td>
                                        {!! Form::open(['url' => "types/addresses/{$result->id}", 'method' => 'delete']) !!}

                                        <a href="{{ url('types/addresses/' . $result->id . '/edit')}}" class="btn btn-xs btn-success">edit</a>

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

