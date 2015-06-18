@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        You are viewing: {{ $category->name }}
                        <a href="{{ route('categories.index') }}" class="btn btn-primary btn-xs pull-right">all categories</a>
                        <a href="{{ route('categories.edit', [$category->id])}}" class="btn btn-success btn-xs pull-right">edit</a>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">Products count</div>
                            <div class="col-md-4">{{ count($products) }}</div>
                        </div>
                        @if(count($products))
                            <div class="row">
                                <div class="col-md-4">
                                    <ul>
                                        @foreach($products as $product)
                                            <li>{!! Html::link(route('products.show', [$product->id]), $product->name) !!}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
