@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Orders
                        <a href="{{url('orders/create')}}" class="pull-right btn btn-primary btn-xs">order something</a>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Client</th>
                                <th>Service</th>
                                <th>Amount</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->user->name}}</td>
                                    <td>{{$order->service->name}}</td>
                                    <td>{{$order->amount}}</td>
                                    <td>
                                        {!! Form::open(['url' => "orders/{$order->id}", 'method' => 'delete']) !!}

                                        <a href="{{url('orders', [$order])}}" class="btn btn-xs btn-warning">details</a>

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
