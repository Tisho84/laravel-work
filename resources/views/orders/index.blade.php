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
                                <th>Products</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Ordered on</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(count($orders) > 0)
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->user->first_name . ' ' . $order->user->last_name }}</td>
                                        <td>
                                            @foreach($order->products as $product)
                                                {{ $product->name . '(' . $product->pivot->quantity . ')' }},
                                            @endforeach
                                        </td>
                                        <td>{{ $order->amount }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->updated_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('orders.show', [$order])}}" class="btn btn-xs btn-warning">details</a>
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
