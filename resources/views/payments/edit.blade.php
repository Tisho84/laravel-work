@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Payment information</div>
                    <div class="panel-body">
                        {!! Form::model($payment, ['route' => ['orders.payment.update', $order->id, $payment->id], 'method' => 'put']) !!}
                        @include('payments.form', [ 'button' => 'Edit', 'action' => 'update'])
                        {!! Html::link(route('orders.address.create', [$order->id]), 'set address', ['class' => 'btn btn-default']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
