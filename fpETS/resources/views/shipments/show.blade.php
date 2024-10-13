@extends('layouts.master')

@section('contents')
    <h1>Shipment Details</h1>
    <p><strong>Order ID:</strong> {{ $shipment->order_id }}</p>
    <p><strong>Shipment Date:</strong> {{ $shipment->shipment_date }}</p>
    <p><strong>Carrier:</strong> {{ $shipment->carrier }}</p>
    <p><strong>Tracking Number:</strong> {{ $shipment->tracking_number }}</p>
    <p><strong>Delivery Status:</strong> {{ $shipment->delivery_status }}</p>

    <a href="{{ route('shipments.index') }}" class="btn btn-primary">Back to Shipments</a>
@endsection
