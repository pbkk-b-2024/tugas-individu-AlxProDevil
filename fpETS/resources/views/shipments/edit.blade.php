<!-- resources/views/shipments/edit.blade.php -->
@extends('layouts.master')

@section('contents')
    <div class="container">
        <h1 class="mb-4">Update Shipment</h1>
        
        @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
                {{ Session::get('success') }}
            </div>
        @endif

        <form action="{{ route('shipments.update', $shipment->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="order_id" class="form-label">Order ID</label>
                <input type="text" class="form-control" id="order_id" name="order_id" value="{{ $shipment->order_id }}" readonly>
            </div>

            <div class="mb-3">
                <label for="shipment_date" class="form-label">Shipment Date</label>
                <input type="date" class="form-control" id="shipment_date" name="shipment_date" value="{{ $shipment->shipment_date }}" required>
            </div>

            <div class="mb-3">
                <label for="carrier" class="form-label">Carrier</label>
                <input type="text" class="form-control" id="carrier" name="carrier" value="{{ $shipment->carrier }}" required>
            </div>

            <div class="mb-3">
                <label for="tracking_number" class="form-label">Tracking Number</label>
                <input type="text" class="form-control" id="tracking_number" name="tracking_number" value="{{ $shipment->tracking_number }}">
            </div>

            <div class="mb-3">
                <label for="delivery_status" class="form-label">Delivery Status</label>
                <select class="form-select" id="delivery_status" name="delivery_status" required>
                    <option value="shipped" {{ $shipment->delivery_status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                    <option value="delivered" {{ $shipment->delivery_status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update Shipment</button>
            <a href="{{ route('shipments.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection