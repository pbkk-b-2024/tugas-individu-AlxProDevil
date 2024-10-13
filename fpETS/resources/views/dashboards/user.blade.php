@extends('layouts.master')

@section('title', 'User Dashboard')

@section('contents')
<div class="row">
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">View Products</h5>
                <a href="{{ route('products.index') }}" class="btn btn-light">Go to Products</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">View Cart</h5>
                <a href="{{ route('orders.cart') }}" class="btn btn-light">Go to Cart</a>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 mb-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Your Orders</h5>
                <a href="{{ route('orders.user') }}" class="btn btn-light">Go to Your Orders</a>
            </div>
        </div>
    </div>
</div>
@endsection
