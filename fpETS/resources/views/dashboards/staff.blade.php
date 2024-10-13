@extends('layouts.master')

@section('title', 'Staff Dashboard')

@section('contents')
<div class="row">
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Manage Products</h5>
                <a href="{{ route('products.index') }}" class="btn btn-light">Go to Products</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card text-white bg-info">
            <div class="card-body">
                <h5 class="card-title">Manage Categories</h5>
                <a href="{{ route('categories.index') }}" class="btn btn-light">Go to Categories</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Manage Orders</h5>
                <a href="{{ route('orders.all') }}" class="btn btn-light">Go to Orders</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card text-white bg-danger">
            <div class="card-body">
                <h5 class="card-title">Manage Shipments</h5>
                <a href="{{ route('shipments.index') }}" class="btn btn-light">Go to Shipments</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">Manage Suppliers</h5>
                <a href="{{ route('suppliers') }}" class="btn btn-light">Go to Suppliers</a>
            </div>
        </div>
    </div>
</div>
@endsection
