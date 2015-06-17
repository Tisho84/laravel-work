@extends('app')
@section('title', 'Users')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Users
                        <a href="{{url('users/create')}}" class="btn btn-primary btn-xs pull-right">new user</a>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Full name</th>
                                <th>Phone</th>
                                <th>Active</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->first_name . ' ' . $user->last_name }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->active == 1 ? 'yes': 'no'}}</td>
                                    <td>
                                        {!! Form::open(['url' => "users/{$user->id}", 'method' => 'delete']) !!}

                                            <a href="{{url('users', [$user])}}" class="btn btn-xs btn-warning">details</a>
                                            <a href="{{url("users/{$user->id}/edit")}}" class="btn btn-xs btn-success">edit</a>

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
