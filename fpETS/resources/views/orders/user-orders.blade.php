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
            <th>Status</th>
            <th>Total Price</th>
            <th>Shipping Address</th>
            <th>Payment Status</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->total_price }}</td>
                <td>{{ $order->shipping_address }}</td>
                <td>{{ $order->payment_status }}</td>
                <td>{{ $order->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection