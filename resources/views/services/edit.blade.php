@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Editing {{$service->name}}</div>

                    <div class="panel-body">
                        {!! Form::open(['url' => 'services/'.$service->id, 'method' => 'put']) !!}
                        	<div class="form-group">
                                <div class="form-group">
                                    {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
                                    {!! Form::text('name', $service->name, ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('available_m25', 'Available m25?', ['class' => 'control-label']) !!}
                                    {!! Form::select('available_m25', [0 => 'No', 1 => 'yes'] , $service->available_m25 , ['class' => 'form-control']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('info', 'Info', ['class' => 'control-label']) !!}
                                    {!! Form::text('other_info', $service->other_info, ['class' => 'form-control']) !!}
                                </div>
                                {!! Form::submit('Update', ['class' => 'form-control']) !!}
                        	</div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
