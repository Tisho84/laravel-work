@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Address information</div>
                    <div class="panel-body">
                        {!! Form::open(['route' => ['orders.address.store', $order->id], 'method' => 'post']) !!}
                        <div class="form-group">
                            {!! Form::label('type_id', 'Address Type', ['class' => 'control-label']) !!}
                            {!! Form::select('type_id', $types, null , ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('country', 'Country', ['class' => 'control-label']) !!}
                            {!! Form::text('country', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('city', 'City', ['class' => 'control-label']) !!}
                            {!! Form::text('city', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('street', 'Street', ['class' => 'control-label']) !!}
                            {!! Form::text('street', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('zip', 'Zip', ['class' => 'control-label']) !!}
                            {!! Form::text('zip', null, ['class' => 'form-control']) !!}
                        </div>
                        {!! Form::submit('Save', ['class' => 'btn btn-default']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
