@extends('layouts.master')

@section('contents')
<h1>Available Products</h1>

@if(Session::has('success'))
    <div class="alert alert-success">{{ Session::get('success') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>
                    <form action="{{ route('orders.addToCart') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="quantity" min="1" required>
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection