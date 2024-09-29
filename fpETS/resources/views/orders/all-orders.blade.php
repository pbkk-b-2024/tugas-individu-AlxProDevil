@extends('layouts.master')

@section('contents')
<h1>All Orders</h1>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>User ID</th>
            <th>Status</th>
            <th>Total Price</th>
            <th>Shipping Address</th>
            <th>Payment Status</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user_id }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->total_price }}</td>
                <td>{{ $order->shipping_address }}</td>
                <td>{{ $order->payment_status }}</td>
                <td>{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">No orders found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection