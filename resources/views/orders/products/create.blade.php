@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! Form::open(['route' => ['orders.products.store', $order->id], 'method' => 'post']) !!}
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="form-group">
                                        {!! Form::label('product', 'Product', ['class' => 'control-label']) !!}
                                        {!! Form::select('product_id', $products, null , ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        {!! Form::label('quantity', 'Quantity', ['class' => 'control-label']) !!}
                                        {!! Form::text('quantity', null, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            {!! Form::submit('Save', ['class' => 'btn btn-default']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection