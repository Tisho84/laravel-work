@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        You are viewing: order from 
                        {!! Html::link(
                            route(
                                'users.show', 
                                [$payment->order->user->id]
                            ), 
                            $payment->order->user->first_name . ' ' . $payment->order->user->last_name ) 
                        !!}
                        <a href="{{ route('payments.index') }}" class="btn btn-primary btn-xs pull-right">all payments</a>
                    </div>
                    <div class="panel-body">
                        <div class="row-md">Payment information</div>
                        <div class="row">
                            <div class="col-md-6">Type</div>
                            <div class="col-md-6">{{ $payment->type->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Amount</div>
                            <div class="col-md-6">{{ $payment->amount }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Paid on</div>
                            <div class="col-md-6">
                                @if(isset($payment->paid_on))
                                    {{ $payment->paid_on }}
                                @endif
                            </div>
                        </div>
                        @if($payment->type->name == 'credit card' || $payment->type->id == 2)
                            <div class="row">
                                <div class="col-md-6">Brand</div>
                                <div class="col-md-6">{{ $payment->brand }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">Exp year</div>
                                <div class="col-md-6">{{ $payment->exp_year }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">Exp month</div>
                                <div class="col-md-6">{{ $payment->exp_month }}</div>
                            </div>
                        @endif
                        <hr>
                        <div class="row-md">Order information</div>
                        @if(isset($payment->order))
                            <div class="row">
                                <div class="col-md-6">Order status</div>
                                <div class="col-md-6">{{ $payment->order->status->name }}</div>
                            </div>
                            <div class="row-md">
                                @if(count($payment->order->products()))
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product Category</th>
                                                <th>Product Name</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($payment->order->products()->get() as $product) 
                                            <tr>
                                                <td> 
                                                    {!! Html::link(
                                                        route(
                                                            'categories.show', 
                                                            [$product->category->id]), 
                                                            $product->category->name
                                                        ) 
                                                    !!}
                                                </td>
                                                <td>{!! Html::link(route('products.show', [$product->id]), $product->name) !!}</td>
                                                <td>{{ $product->pivot->quantity }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
