@extends('layouts.master')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Product List</h1>
    </div>

    <hr />
    <!-- Search Bar -->
    <div class="row mb-3">
        <div class="col-md-12">
            <form action="{{ route('products.index') }}" method="GET" class="form-inline">
                <div class="input-group w-100">
                    <input type="text" name="search" class="form-control bg-white border-0 small" placeholder="Search for products..." aria-label="Search" aria-describedby="basic-addon2" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Product Code</th>
                <th>Description</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>+
            @if($products->count() > 0)
                @foreach($products as $rs)
                    <tr>
                        <td class="align-middle">{{ $rs->name }}</td>
                        <td class="align-middle">{{ $rs->price }}</td>
                        <td class="align-middle">{{ $rs->product_code }}</td>
                        <td class="align-middle">{{ $rs->description }}</td> 
                        <td>{{ $rs->category ? $rs->category->name : 'No Category' }}</td> <!-- Display category name --> 
                        <td class="align-middle">{{ $rs->quantity }}</td>  
                        <td class="align-middle">
                        @if($rs->quantity > 0)
                            <form action="{{ route('orders.addToCart') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $rs->id }}">
                                <button type="submit" class="btn btn-primary btn-sm">Add to Cart</button>
                            </form>
                        @else
                            <button class="btn btn-secondary btn-sm" disabled>Out of Stock</button>
                        @endif
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="6">Product not found</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $products->links('pagination::bootstrap-4') }}
    </div>
@endsection