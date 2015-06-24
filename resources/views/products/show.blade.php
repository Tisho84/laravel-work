@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <div class="panel panel-default">
                    <div class="panel-heading">Product {{$product->name }}
                        <a href="{{ route('products.index') }}" class="btn btn-xs btn-primary pull-right"> all products</a>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">Category:</div>
                            <div class="col-md-4">{{ $product->category->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Name:</div>
                            <div class="col-md-4">{{ $product->name }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Price:</div>
                            <div class="col-md-4">{{ $product->price }}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Description:</div>
                            <div class="col-md-4">{{ $product->description }}</div>
                        </div>
                        @if(Auth::user()->is_admin)
                            <div class="row">
                                <div class="col-md-4">Quantity:</div>
                                <div class="col-md-4">{{ $product->quantity }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">Available:</div>
                                <div class="col-md-4">{{ $product->available? 'Yes' : 'No' }}</div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">Active:</div>
                                <div class="col-md-4">{{ $product->active? 'Yes' : 'No' }}</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
