@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Payment information</div>
                    <div class="panel-body">
                        {!! Form::open(['route' => ['orders.payment.store', $order->id], 'method' => 'post']) !!}
                        <div class="form-group">
                            {!! Form::label('payment_type', 'Payment Type', ['class' => 'control-label']) !!}
                            {!! Form::select('payment_type', $payments, null , ['class' => 'form-control']) !!}
                        </div>
                        <div class="more-info">
                            <div class="form-group">
                                {!! Form::label('brand', 'Brand', ['class' => 'control-label']) !!}
                                {!! Form::text('brand', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('exp_year', 'Exp year', ['class' => 'control-label']) !!}
                                {!! Form::text('exp_year', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('exp_month', 'Exp month', ['class' => 'control-label']) !!}
                                {!! Form::text('exp_month', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('last4', 'Last 4', ['class' => 'control-label']) !!}
                                {!! Form::text('last4', null, ['class' => 'form-control']) !!}
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

{!! Html::style('css/style.css') !!}

{!! Html::script('javascripts/jquery-2.1.4.min.js') !!}
{!! Html::script('javascripts/scripts.js') !!}
