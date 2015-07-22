@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <div class="panel panel-default">
                    <div class="panel-heading">Order
                        <a href="{{ route('orders.index') }}" class="btn btn-xs btn-primary pull-right"> all orders</a>
                    </div>
                    <div class="panel-body">
                        <div class="row-md">Order information</div>
                        <div class="row">
                            <div class="col-md-6">Order status</div>
                            <div class="col-md-6">{{ $order->getStatus() }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Ordered at</div>
                            <div class="col-md-6">{{ $order->updated_at }}</div>
                        </div>
                        <hr>
                        <div class="row-md">Products:</div>
                        <div class="row-md">
                            @if(!count($order->products))
                                <div class="col-md">
                                    {!! Html::link(route('orders.create', ['id' => $order->id]), 'add products', ['class' => 'btn btn-small btn-warning']) !!}
                                </div>
                            @else
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product Category</th>
                                            <th>Product Name</th>
                                            <th>Amount</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->products as $product)
                                        <tr>
                                            <td>{!! Html::link(route('categories.show', [$product->category->id]), $product->category->name) !!}</td>
                                            <td>{!! Html::link(route('products.show', [$product->id]), $product->name) !!}</td>
                                            <td>{{ $product->pivot->quantity }}</td>
                                            <td>{{ $product->pivot->quantity * $product->price }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="col-md">
                                    {!! Html::link(route('orders.edit', [$order->id]), 'edit products', ['class' => 'btn btn-default']) !!}
                                </div>
                            @endif
                        </div>
                        <hr>
                        <div class="row-md">
                            <div class="row-md">Address information:</div>
                            @if($order->address !== null)
                                <div class="row">
                                    <div class="col-md-6">Address type</div>
                                    <div class="col-md-6">{{ $order->address->getAddress() }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">Country</div>
                                    <div class="col-md-6">{{ $order->address->country }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">City</div>
                                    <div class="col-md-6">{{ $order->address->city }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">Street</div>
                                    <div class="col-md-6">{{ $order->address->street }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">Zip</div>
                                    <div class="col-md-6">{{ $order->address->zip }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        {!! Html::link(route('orders.address.edit', [$order->id, $order->address->id]), 'edit', ['class' => 'btn btn-default']) !!}
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-6">
                                        {!! Html::link(route('orders.address.create', [$order->id]), 'add address', ['class' => 'btn btn-small btn-warning']) !!}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
