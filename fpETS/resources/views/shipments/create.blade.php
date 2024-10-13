@extends('layouts.master')

@section('contents')
    <h1>Process Shipment for Order #{{ $order->id }}</h1>

    <form action="{{ route('shipments.store', $order->id) }}" method="POST">
        @csrf
        <input type="hidden" name="order_id" value="{{ $order->id }}">
        <div class="mb-3">
            <label for="shipment_date" class="form-label">Shipment Date</label>
            <input type="date" class="form-control" id="shipment_date" name="shipment_date" required>
        </div>
        <div class="mb-3">
            <label for="carrier" class="form-label">Carrier</label>
            <input type="text" class="form-control" id="carrier" name="carrier" required>
        </div>
        <div class="mb-3">
            <label for="tracking_number" class="form-label">Tracking Number</label>
            <input type="text" class="form-control" id="tracking_number" name="tracking_number">
        </div>
        <div class="mb-3">
            <label for="delivery_status" class="form-label">Delivery Status</label>
            <select class="form-select" id="delivery_status" name="delivery_status" required>
                <option value="Shipped">Shipped</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Process Shipment</button>
    </form>
@endsection