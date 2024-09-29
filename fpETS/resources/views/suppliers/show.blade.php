@extends('layouts.master')

@section('contents')
    <h1 class="mb-0">Supplier Detail</h1>
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $supplier->name }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Contact</label>
            <input type="text" name="contact_info" class="form-control" placeholder="Contact" value="{{ $supplier->contact_info }}" readonly>
        </div>
    </div>
    
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Address</label>
            <textarea class="form-control" name="address" placeholder="Address" readonly>{{ $supplier->address }}</textarea>
        </div>
    </div>

    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $supplier->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Updated At</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $supplier->updated_at }}" readonly>
        </div>
    </div>
@endsection