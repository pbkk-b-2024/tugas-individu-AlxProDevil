@extends('layouts.master')

@section('contents')
    <h1 class="mb-0">Add Product</h1>
    <hr />

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name') }}">
            </div>
            <div class="col">
                <input type="text" name="price" class="form-control" placeholder="Price" value="{{ old('price') }}">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="product_code" class="form-control" placeholder="Product Code" value="{{ old('product_code') }}">
            </div>
            <div class="col">
                <input type="integer" name="quantity" class="form-control" placeholder="Quantity" value="{{ old('quantity') }}">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <textarea class="form-control" name="description" placeholder="Description">{{ old('description') }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="category_id">Category (Optional)</label>
            <select name="category_id" id="category_id" class="form-control">
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ isset($product) && $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection