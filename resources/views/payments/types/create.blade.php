@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Payment Type</div>

                    <div class="panel-body">
                        {!! Form::open(['url' => 'types/payments', 'method' => 'post']) !!}
                            @include('payments.types.form', ['button' => 'Save', 'text' => 'Payment Type', 'field' => 'name'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
