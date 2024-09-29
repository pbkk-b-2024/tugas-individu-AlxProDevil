@extends('layouts.master')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Supplier List</h1>
        <a href="{{ route('suppliers.create') }}" class="btn btn-primary">Add Supplier</a>
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
                <th>Contact Info</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>+
            @if($supplier->count() > 0)
                @foreach($supplier as $sp)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $sp->name }}</td>
                        <td class="align-middle">{{ $sp->contact_info }}</td>
                        <td class="align-middle">{{ $sp->address }}</td>
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('suppliers.show', $sp->id) }}" type="button" class="btn btn-secondary">Detail</a>
                                <a href="{{ route('suppliers.edit', $sp->id)}}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('suppliers.destroy', $sp->id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
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
                    <td class="text-center" colspan="6">Supplier not found</td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $supplier->links() }}
    </div>
@endsection