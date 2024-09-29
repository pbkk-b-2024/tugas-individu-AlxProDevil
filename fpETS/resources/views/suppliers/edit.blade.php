@extends('layouts.master')

@section('contents')
    <h1 class="mb-0">Edit Supplier</h1>
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

    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $supplier->name }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Contact</label>
                <input type="text" name="contact_info" class="form-control" placeholder="Contact" value="{{ $supplier->contact_info }}" >
            </div>
        </div>

        <div class="row mb-3">
            <div class="col mb-3">
                <label class="form-label">Address</label>
                <textarea class="form-control" name="address" placeholder="Address" >{{ $supplier->address }}</textarea>
            </div>
        </div>

        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Update</button>
            </div>
        </div>
    </form>
@endsection