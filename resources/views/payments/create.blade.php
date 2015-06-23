@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Payment information</div>
                    <div class="panel-body">
                        {!! Form::open(['route' => ['orders.payment.store', $order->id], 'method' => 'post']) !!}
                        @include('payments.form', ['button' => 'Save'])
                        {!! Html::link(route('orders.address.create', [$order->id]), 'set address', ['class' => 'btn btn-default']) !!}
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
