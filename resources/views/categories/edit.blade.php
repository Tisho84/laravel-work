@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Category</div>

                    <div class="panel-body">
                        {!! Form::model($category, ['route' => ['categories.update', $category->id], 'method' => 'put']) !!}
                        @include('categories.form', ['button' => 'Update'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
