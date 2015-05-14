@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Adding new Service</div>

                    <div class="panel-body">
                        {!! Form::open(['url' => 'services', 'method' => 'post']) !!}
                        <div class="form-group">
                            {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                            {!! Form::text('name', '', ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('available', 'Available M25', ['class' => 'control-label']) !!}
                            {!! Form::select('available_m25', [0 => 'No', 1 => 'Yes'] , 1 , ['class' => 'form-control'])
                            !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('other_Info', 'Other Info', ['class' => 'control-label']) !!}
                            {!! Form::text('other_info', '', ['class' => 'form-control']) !!}
                        </div>
                        {!! Form::submit('Save', ['class' => 'form-control']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
