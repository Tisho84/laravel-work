@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Products
                        <a href="{{ route('products.create') }}" class="btn btn-primary btn-xs pull-right">new product</a>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Info</th>
                                <th>Price per 1</th>
                                <th>Quantity</th>
                                <th>Available</th>
                                <th>Active</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{!! Html::link(route('categories.show', [$product->category->id]), $product->category->name) !!}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->available? 'Yes' : 'No' }}</td>
                                    <td>{{ $product->active? 'Yes' : 'No' }}</td>
                                    <td>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['products.destroy', $product]]) !!}

                                        <a href="{{ route('products.show', [$product]) }}" class="btn btn-xs btn-warning">details</a>
                                            <a href="{{ route('products.edit', [$product->id]) }}" class="btn btn-xs btn-success">edit</a>

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
