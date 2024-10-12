@extends('layouts.master')

@section('contents')
<h1>Your Orders</h1>

@if(Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@endif

<table class="table table-hover">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Total Price</th>
            <th>Shipping Address</th>
            <th>Payment Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->created_at }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->total_price }}</td>
                <td>{{ $order->shipping_address }}</td>
                <td>{{ $order->payment_status }}</td>
                <td>
                    @if($order->payment_status === 'Unpaid')
                        <a href="{{ route('payment.show', $order->id) }}" class="btn btn-primary">Pay</a>
                    @else
                        <span class="badge badge-success">Paid</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection