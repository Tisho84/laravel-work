@extends('app')
@section('title', 'Payments')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Payments
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Brand</th>
                                <th>Amount</th>
                                <th>Order</th>
                                <th>Order time</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($payments as $payment)
                                <tr>
                                    <td>{{ $payment->brand }}</td>
                                    <td>{{ $payment->amount }}</td>
                                    <td>{{ $payment->order()->get()->id }}</td>
                                    <td>{{ $payment->created_at }}</td>
                                    <td>
                                        <a href="{{ route('payments.show', [$payment->id]) }}" class="btn btn-xs btn-warning">details</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

