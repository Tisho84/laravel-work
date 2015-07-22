@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Address information</div>
                    <div class="panel-body">
                        {!! Form::open(['route' => ['orders.address.store', $order->id], 'method' => 'post']) !!}
                            @include('address.form', [ 'button' => 'Save'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
