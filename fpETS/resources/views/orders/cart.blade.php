@extends('layouts.master')

@section('contents')
<h1>Your Cart</h1>

@if(Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger">{{ Session::get('error') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($cart))
            @foreach($cart as $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ $item['price'] }}</td>
                    <td>
                        <form action="{{ route('orders.removeFromCart', $item['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4" class="text-center">Your cart is empty!</td>
            </tr>
        @endif
    </tbody>
</table>

@if(!empty($cart))
    <form action="{{ route('orders.checkout') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="shipping_address">Shipping Address</label>
            <input type="text" name="shipping_address" id="shipping_address" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Checkout</button>
    </form>
@endif
@endsection