@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Order something</div>
                    <div class="panel-body">
                        {!! Form::model($product, ['route' => ['orders.products.update', $order->id, $product->id], 'method' => 'put']) !!}
                        <div class="form-group">
                            {!! Form::label('category', 'Category', ['class' => 'control-label']) !!}
                            {!! Form::select('category', $categories, $product->category->id , ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('product_id', 'Product', ['class' => 'control-label']) !!}
                            {!! Form::select('product_id', $products, $product->id , ['class' => 'form-control', 'id' => 'product']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('price', 'Price per 1:', ['class' => 'control-label']) !!}
                            <span class="product-price">{{ $product->price }}</span>
                        </div>
                        <div class="form-group">
                            {!! Form::label('quantity', 'Quantity', ['class' => 'control-label']) !!}
                            {!! Form::text('quantity', $pivot->quantity, ['class' => 'form-control']) !!}
                        </div>
                        {!! Form::submit('Save', ['class' => 'btn btn-default']) !!}
                        {!! Form::hidden('pivot_id', $pivot->id)!!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


{!! Html::style('css/style.css') !!}

{!! Html::script('javascripts/jquery-2.1.4.min.js') !!}
{!! Html::script('javascripts/scripts.js') !!}
