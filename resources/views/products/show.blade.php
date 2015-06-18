@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">

                <div class="panel panel-default">
                    <div class="panel-heading">Service {{$service->name}}
                        <a href="{{url('services')}}" class="btn btn-xs btn-primary pull-right"> all services</a>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-4">Name:</div>
                            <div class="col-md-4">{{$service->name}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Available m25?:</div>
                            <div class="col-md-4">{{$service->available_m25? 'Yes' : 'No'}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">Info:</div>
                            <div class="col-md-4">{{$service->other_info}}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
