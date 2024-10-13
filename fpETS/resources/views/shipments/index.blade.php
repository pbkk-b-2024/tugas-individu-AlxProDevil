@extends('layouts.master')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Shipment List</h1>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Order Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($orders->count() > 0)
                @foreach($orders as $order)
                    <tr>
                        <td class="align-middle">{{ $order->id }}</td>
                        <td class="align-middle">{{ $order->user->name }}</td>
                        <td class="align-middle">{{ $order->status }}</td>
                        <td class="align-middle">
                            @if(!$order->shipment) <!-- If shipment doesn't exist, show Process button -->
                                <a href="{{ route('shipments.create', $order->id) }}" class="btn btn-primary">Process</a>
                            @elseif($order->shipment->delivery_status !== 'delivered') <!-- If shipment exists but not completed, show Details and Update -->
                                <a href="{{ route('shipments.show', $order->shipment->id) }}" class="btn btn-secondary">Details</a>
                                <a href="{{ route('shipments.edit', $order->shipment->id) }}" class="btn btn-warning">Update</a>
                            @else <!-- If delivery status is completed, show only Details -->
                                <a href="{{ route('shipments.show', $order->shipment->id) }}" class="btn btn-secondary">Details</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="4">No orders found</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection