@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Orders
                        <a href="{{url('orders/create')}}" class="pull-right btn btn-primary btn-xs">new order</a>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
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
                                        <td>
                                            @foreach($order->products as $product)
                                                {{ $product->name . '(' . $product->pivot->quantity . ')' }},
                                            @endforeach
                                        </td>
                                        <td>{{ $order->getAmount() }}</td>
                                        <td>{{ $order->getStatus() }}</td>
                                        <td>{{ $order->updated_at->diffForHumans() }}</td>
                                        <td>
                                            {!! Form::open([route('orders.destroy', [$order->id]), 'method' => 'delete']) !!}
                                                <a href="{{ route('orders.show', [$order])}}" class="btn btn-xs btn-warning">details</a>
                                            @if($order->status == 1)
                                                {!! Form::submit('delete', ['class' => 'btn btn-danger btn-xs']) !!}
                                            @endif
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
