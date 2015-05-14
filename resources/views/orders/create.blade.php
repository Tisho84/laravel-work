@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Order something & tell us how much you would like for it</div>

                    <div class="panel-body">
                        {!! Form::open(['url' => 'orders', 'method' => 'post']) !!}
                        <div class="form-group">
                            {!! Form::label('service', 'Service', ['class' => 'control-label']) !!}
                            {!! Form::select('service_id', $services , null , ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('amount', 'Amount', ['class' => 'control-label']) !!}
                            {!! Form::text('amount', '', ['class' => 'form-control']) !!}
                        </div>
                        {!! Form::submit('Save', ['class' => 'form-control']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
