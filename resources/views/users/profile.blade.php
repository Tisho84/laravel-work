@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$user->name}} Profile</div>

                    <div class="panel-body">
                        {!! Form::model($user, ['route' => 'updateProfile', 'method' => 'put']) !!}
                            @include('users.form', ['button' => 'Update Profile'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
