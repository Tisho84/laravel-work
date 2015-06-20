@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Order something</div>
                    <div class="panel-body">
                        {!! Form::open(['url' => 'orders', 'method' => 'post']) !!}
                        <div class="form-group">
                            {!! Form::label('category', 'Category', ['class' => 'control-label']) !!}
                            {!! Form::select('category', $categories, null , ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('product', 'Product', ['class' => 'control-label']) !!}
                            {!! Form::select('product', $products, null , ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('quantity', 'Quantity', ['class' => 'control-label']) !!}
                            {!! Form::text('quantity', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" onclick="addOrder()" class="btn">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </button>
                            </div>
                            <div class="col-md-6">
                                {!! Html::link(route('orders.address.create', [$order->id]), 'set address', ['class' => 'btn btn-default']) !!}
                            </div>
                        </div>

                        {!! Form::hidden('order_id', $order->id, ['class' => 'order_id']) !!}
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
