@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Status</div>

                    <div class="panel-body">
                        {!! Form::model($status, ['route' => ['statuses.update', $status->id], 'method' => 'put']) !!}
                            @include('partials.simple_create', ['button' => 'Update', 'text' => 'Status', 'field' => 'name'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
