@extends('layouts.master')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Product List</h1>
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
                <th>#</th>
                <th>Name</th>
                <th>Price</th>
                <th>Product Code</th>
                <th>Description</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>+
            @if($product->count() > 0)
                @foreach($product as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $rs->name }}</td>
                        <td class="align-middle">{{ $rs->price }}</td>
                        <td class="align-middle">{{ $rs->product_code }}</td>
                        <td class="align-middle">{{ $rs->description }}</td>  
                        <td class="align-middle">{{ $rs->quantity }}</td>  
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
        {{ $product->links() }}
    </div>
@endsection