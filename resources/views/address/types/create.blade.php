@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Address Type</div>

                    <div class="panel-body">
                        {!! Form::open(['url' => 'types/address', 'method' => 'post']) !!}
                            @include('partials.simple_create', ['button' => 'Save', 'text' => 'Address Type', 'field' => 'name'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
