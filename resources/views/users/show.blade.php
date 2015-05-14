@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        You are viewing: {{$user->name}}
                        <a href="{{url('users')}}" class="btn btn-primary btn-xs pull-right">all users</a>
                        <a href="{{url("users/{$user->id}/edit")}}" class="btn btn-success btn-xs pull-right">edit</a>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">Name:</div>
                            <div class="col-md-4">{{$user->name}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Email:</div>
                            <div class="col-md-4">{{$user->email}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">User registered:</div>
                            <div class="col-md-4">{{$user->created_at}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">User last updated:</div>
                            <div class="col-md-4">{{$user->updated_at}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Orders:</div>
                            <div class="col-md-4">
                                <ul>
                                    @foreach($user->orders as $order)
                                        <li>{{$order->service->name}} - {{$order->amount}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
