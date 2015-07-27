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
                        <div class="row-md">Order information</div>
                        <div class="row">
                            <div class="col-md-6">Ordered by</div>
                            <div class="col-md-6">{{ $order->user->username }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">Order status</div>
                           <div class="col-md-6"> <b>{{ $order->getStatus() }}</b></div>
                        </div>

                        @if(count($dates))
                            @foreach($dates as $date)
                                <div class="row">
                                    <div class="col-md-6">{{ $date['text'] }}</div>
                                    <div class="col-md-6">{{ $date['date'] }}</div>
                                </div>
                            @endforeach
                        @endif
                        <div class="row">
                            <div class="col-md-6">Paid</div>
                            <div class="col-md-6">{{ $order->is_paid ? 'Yes': 'No' }}</div>
                        </div>
                        <hr>
                        @if(Auth::user()->is_admin)
                            {!! Form::open(['route' => ['orders.update', $order->id], 'method' => 'put']) !!}
                                <div class="form-group">
                                    {!! Form::label('user', 'users', ['class' => 'control-label']) !!}
                                    {!! Form::select('user', $users, $order->user->id , ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('status', 'Status', ['class' => 'control-label']) !!}
                                    {!! Form::select('status', $statuses, $order->status , ['class' => 'form-control']) !!}
                                </div>
                                {!! Form::submit('save', ['class' => 'btn btn-default']) !!}
                            {!! Form::close() !!}
                            <hr>
                        @endif
                        <div class="row-md">Products:</div>
                        <div class="row-md">
                            @if(!count($order->products))
                                <div class="col-md">
                                    {!! Html::link(route('orders.create', ['id' => $order->id]), 'add products', ['class' => 'btn btn-small btn-primary']) !!}
                                </div>
                            @else
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product Category</th>
                                            <th>Product Name</th>
                                            <th>Amount</th>
                                            <th>Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->products as $product)
                                        <tr>
                                            <td>{!! Html::link(route('categories.show', [$product->category->id]), $product->category->name) !!}</td>
                                            <td>{!! Html::link(route('products.show', [$product->id]), $product->name) !!}</td>
                                            <td>{{ $product->pivot->quantity }}</td>
                                            <td>{{ $product->price }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-md-2 pull-right">
                                        Total - {{ $order->getAmount() }}
                                    </div>
                                    @if($order->canEdit())
                                        <div class="col-md-2">
                                            {!! Html::link(route('orders.edit', [$order->id]), 'Edit', ['class' => 'btn btn-default']) !!}
                                        </div>
                                    @endif
                                    @if($order->canCancel())
                                        <div class="col-md-2">
                                            {!! Html::link(route('orders.cancel', [$order->id]), 'Cancel', ['class' => 'btn btn-default']) !!}
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                        <hr>
                        <div class="row-md">
                            <div class="row-md">Address information:</div>
                            @if($order->address !== null)
                                <div class="row">
                                    <div class="col-md-6">Address type</div>
                                    <div class="col-md-6">{{ $order->address->getAddress() }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">Country</div>
                                    <div class="col-md-6">{{ $order->address->country }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">City</div>
                                    <div class="col-md-6">{{ $order->address->city }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">Street</div>
                                    <div class="col-md-6">{{ $order->address->street }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">Zip</div>
                                    <div class="col-md-6">{{ $order->address->zip }}</div>
                                </div>
                                @if($order->canEdit())
                                    <div class="row">
                                        <div class="col-md-6">
                                            {!! Html::link(route('orders.address.edit', [$order->id, $order->address->id]), 'Edit', ['class' => 'btn btn-default']) !!}
                                        </div>
                                    </div>
                                @endif
                            @else
                                @if($order->canEdit())
                                    <div class="row">
                                        <div class="col-md-6">
                                            {!! Html::link(route('orders.address.create', [$order->id]), 'Add', ['class' => 'btn btn-small btn-primary']) !!}
                                        </div>
                                    </div>
                                @endif
                            @endif
                        </div>
                        @if(!$order->is_paid)
                            <hr>
                            <div class="row-md">
                                <div>Payment:</div>
                                <div>
                                    {!! Form::open(['route' => ['orders.payment', $order], 'method' => 'post']) !!}
                                        <script
                                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                            data-key="pk_test_6pRNASCoBOKtIshFeQd4XMUh"
                                            data-amount="{{ $order->getStripeAmount() }}"
                                            data-name="Order"
                                            data-description="{{ count($order->products) }} items {{ $order->getStripeAmount() }}"
                                            data-email="{{ Auth::user()->email  }}">
                                        </script>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
