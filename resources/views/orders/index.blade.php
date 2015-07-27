@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div>
                            Orders
                            <div class="pull-right">
                                {!! Html::link(route('orders.create'), 'new order', ['class' => "btn btn-primary btn-xs"]) !!}
                                {!! Html::link(route('orders.index'), 'all orders', ['class' => "btn btn-default btn-xs"]) !!}
                                @foreach($statuses as $id => $status)
                                    {!! Html::link(route('orders.index', ['status=' . $id]), $status, ['class' => "btn btn-default btn-xs"]) !!}
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Client</th>
                                    <th>Products</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Paid</th>
                                    <th>Ordered on</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($orders) > 0)
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{!! Html::link(route('users.show', [$order->user->id]), $order->user->first_name . ' ' . $order->user->last_name) !!}</td>
                                        <td>
                                            @foreach($order->products as $product)
                                                {{ $product->name . '(' . $product->pivot->quantity . ')' }},
                                            @endforeach
                                        </td>
                                        <td>{{ $order->getAmount() }}</td>
                                        <td>{{ $order->getStatus() }}</td>
                                        <td>{{ $order->is_paid ? 'Yes': 'No' }}</td>
                                        <td>{{ $order->updated_at->diffForHumans() }}</td>
                                        <td>
                                            {!! Form::open(['url' => "orders/{$order->id}", 'method' => 'delete']) !!}

                                                <a href="{{ route('orders.show', [$order])}}" class="btn btn-xs btn-warning">details</a>
                                                {!! Form::submit('delete', ['class' => 'btn btn-danger btn-xs']) !!}

                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
