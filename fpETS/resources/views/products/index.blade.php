@extends('layouts.master')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Product List</h1>

        <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
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
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('products.show', $rs->id) }}" type="button" class="btn btn-secondary">Detail</a>
                                <a href="{{ route('products.edit', $rs->id)}}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('products.destroy', $rs->id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger m-0">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="5">Product not found</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $products->links('pagination::bootstrap-4') }}
    </div>
@endsection