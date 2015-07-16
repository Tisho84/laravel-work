@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Address information</div>
                    <div class="panel-body">
                        {!! Form::model($address, ['route' => ['orders.address.update', $order->id, $address->id], 'method' => 'put']) !!}
                        @include('address.form', [ 'button' => 'Edit'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
