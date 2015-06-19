@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Users
                        <a href="{{url('users')}}" class="btn btn-primary btn-xs pull-right">all users</a>
                    </div>

                    <div class="panel-body">
                        {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}
                            @include('users.form', ['button' => 'Update'])
                            {!! Form::hidden('id', $user->id) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
