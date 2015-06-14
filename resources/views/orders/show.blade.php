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
                        <div class="row">
                            <div class="col-md-4">Client:</div>
                            <div class="col-md-4">{{$order->user->name}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Service:</div>
                            <div class="col-md-4">{{$order->service->name}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Amount:</div>
                            <div class="col-md-4">{{$order->amount}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
