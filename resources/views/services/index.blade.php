@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Services
                        <a href="{{url('services/create')}}" class="btn btn-primary btn-xs pull-right">new service</a>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Available in M25</th>
                                <th>Info</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <td>{{$service->name}}</td>
                                    <td>{{$service->available_m25? 'Yes' : 'No'}}</td>
                                    <td>{{$service->other_info}}</td>
                                    <td>
                                        {!! Form::open(['url' => "services/{$service->id}", 'method' => 'delete']) !!}

                                        <a href="{{url('services', [$service])}}" class="btn btn-xs btn-warning">details</a>
                                        <a href="{{url("services/{$service->id}/edit")}}" class="btn btn-xs btn-success">edit</a>

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
