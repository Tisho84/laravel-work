@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Payment Type</div>

                    <div class="panel-body">
                        {!! Form::model($type, ['url' => 'types/payment/' . $type->id, 'method' => 'put']) !!}
                            @include('payments.types.form', ['button' => 'Update', 'text' => 'Payment Type', 'field' => 'name'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
