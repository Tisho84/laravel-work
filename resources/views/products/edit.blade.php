@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Adding new Product</div>

                    <div class="panel-body">
                        {!! Form::model($product, ['route' => ['products.update', $product->id], 'method' => 'put']) !!}
                            @include('products.form', ['button' => 'Update'])
                            {!! Form::hidden('id', $product->id) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
