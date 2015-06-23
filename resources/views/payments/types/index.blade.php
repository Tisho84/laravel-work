@extends('app')
@section('title', 'Payment types')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Payment types
                        <a href="{{ url('types/payments/create') }}" class="btn btn-primary btn-xs pull-right"> new type</a>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>More info</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($results as $result)
                                <tr>
                                    <td>{{ $result->name }}</td>
                                    <td>{{ $result->info? 'Yes': 'No' }}</td>
                                    <td>
                                        {!! Form::open(['url' => "types/payments/{$result->id}", 'method' => 'delete']) !!}

                                        <a href="{{ url('types/payments/' . $result->id . '/edit')}}" class="btn btn-xs btn-success">edit</a>

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

