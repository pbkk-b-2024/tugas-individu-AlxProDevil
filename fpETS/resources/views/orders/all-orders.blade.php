@extends('layouts.master')

@section('contents')
<h1>All Orders</h1>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>User ID</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Total Price</th>
            <th>Shipping Address</th>
            <th>Payment Status</th>
            <th>Receipt</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user_id }}</td>
                <td>{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->total_price }}</td>
                <td>{{ $order->shipping_address }}</td>
                <td>
                    @if($order->payment_status === 'Completed')
                        <span class="badge badge-success">Paid</span>
                    @elseif($order->payment_status === 'Pending')
                        <span class="badge badge-warning">Pending</span>
                    @else
                        <span class="badge badge-danger">Unpaid</span>
                    @endif
                </td>
                <td>
                    @if($order->payment) <!-- Check if payment exists -->
                        @if($order->payment->receipt_path) <!-- Show receipt if it exists -->
                        <a href="{{ asset('storage/' . $order->payment->receipt_path) }}" target="_blank">View Receipt</a>
                        @else
                            No Receipt
                        @endif
                    @else
                        No Payment Record <!-- Handle case where payment doesn't exist -->
                    @endif
                </td>
                <td>
                    @if($order->payment_status === 'Pending') <!-- Show confirm button only if receipt is not uploaded -->
                        <form action="{{ route('payment.confirm', $order->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Confirm Payment</button>
                        </form>
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="9" class="text-center">No orders found.</td>
            </tr>
        @endforelse
    </tbody>
</table>
@endsection