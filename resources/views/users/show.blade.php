@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        You are viewing: {{ $user->username }}
                        <a href="{{ route('users.index') }}" class="btn btn-primary btn-xs pull-right">all users</a>
                        <a href="{{ route('users.edit', [$user->id])}}" class="btn btn-success btn-xs pull-right">edit</a>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">Name:</div>
                            <div class="col-md-4">{{ $user->first_name . ' ' . $user->last_name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Username:</div>
                            <div class="col-md-4">{{ $user->username }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Email:</div>
                            <div class="col-md-4">{{ $user->email }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Phone:</div>
                            <div class="col-md-4">{{ $user->phone }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Active:</div>
                            <div class="col-md-4">{{ $user->active == 1 ? 'yes': 'no'}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">User registered:</div>
                            <div class="col-md-4">{{ $user->created_at }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">User last updated:</div>
                            <div class="col-md-4">{{ $user->updated_at }}</div>
                        </div>
                        @if(count($orders))
                            <div class="row">
                                <div class="col-md-4">Orders:</div>
                                <div class="col-md-4">
                                    <ul>
                                        @foreach($orders as $k => $order)
                                            <?php $k++; ?>
                                            <li>
                                                {!! Form::open(['url' => "orders/{$order->id}", 'method' => 'delete']) !!}

                                                {!! Html::link(route('orders.show', [$order->id]), 'Order No.' . $k) !!}

                                                {!! Form::submit('delete', ['class' => 'btn btn-danger btn-xs']) !!}

                                                {!! Form::close() !!}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
