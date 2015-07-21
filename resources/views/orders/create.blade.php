@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Order something</div>
                    <div class="panel-body">
                        {!! Form::open(['url' => 'orders', 'method' => 'post']) !!}
                        <div class="repeat">
                            <?php $counter = 0; ?>
                            @if(count($selectedProducts) > 0)
                                @foreach($selectedProducts as $value)
                                    <div class="single-repeat">
                                        <div class="row">
                                            <div class="col-sm-9">
                                                <div class="form-group">
                                                    {!! Form::label('product', 'Product', ['class' => 'control-label']) !!}
                                                    {!! Form::select('product[]', $products, $value['product_id'] , ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    {!! Form::label('quantity', 'Quantity', ['class' => 'control-label']) !!}
                                                    {!! Form::text('quantity[]', $value['quantity'], ['class' => 'form-control']) !!}
                                                </div>
                                            </div>
                                            @if($counter == 0)
                                                <div class="coll-sm-1 remove-button hidden" >
                                            @else
                                                <div class="coll-sm-1">
                                            @endif
                                                <div class="form-group">
                                                    {!! Form::label('quantity', 'Remove', ['class' => 'control-label']) !!}
                                                    <button type="button" onclick="removeOrder(this)" class="btn">
                                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $counter++; ?>
                                @endforeach
                            @else
                                <div class="single-repeat">
                                    <div class="row">
                                        <div class="col-sm-9">
                                            <div class="form-group ">
                                                {!! Form::label('product', 'Product', ['class' => 'control-label']) !!}
                                                {!! Form::select('product[]', $products, 0 , ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-group">
                                                {!! Form::label('quantity', 'Quantity', ['class' => 'control-label']) !!}
                                                {!! Form::text('quantity[]', '', ['class' => 'form-control']) !!}
                                            </div>
                                        </div>
                                        <div class="coll-sm-1 remove-button hidden">
                                            <div class="form-group">
                                                {!! Form::label('quantity', 'Remove', ['class' => 'control-label']) !!}
                                                <button type="button" onclick="removeOrder(this)" class="btn">
                                                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <button type="button" onclick="addOrder()" class="btn">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </button>
                            </div>
                            <div class="col-md-4">
                            {!! Form::submit('Save', ['class' => 'btn btn-default']) !!}
                            </div>
                        </div>

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
