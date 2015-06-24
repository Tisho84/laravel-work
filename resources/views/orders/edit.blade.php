@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit order
                        {!! Html::link(route('orders.create', ['id' => $order->id]), 'add products', ['class' => 'pull-right btn btn-primary btn-xs']) !!}
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Product Category</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->products()->get() as $product)
                                <tr>
                                    <td>
                                        {!! Html::link(route('categories.show', [$product->category->id]), $product->category->name) !!}
                                    </td>
                                    <td>{!! Html::link(route('products.show', [$product->id]), $product->name) !!}</td>
                                    <td>{{ $product->pivot->quantity }}</td>
                                    <td>{{ $product->pivot->quantity * $product->price }}</td>
                                    <td>
                                        {!! Form::open(['route' => ['orders.products.destroy', $order->id, $product->id], 'method' => 'delete']) !!}

                                        <a href="{{ route('orders.products.edit', [$order->id, $product->id])}}" class="btn btn-xs btn-success">edit</a>

                                        {!! Form::submit('remove', ['class' => 'btn btn-danger btn-xs']) !!}
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
