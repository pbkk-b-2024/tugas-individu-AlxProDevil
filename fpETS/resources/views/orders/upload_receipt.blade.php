@extends('layouts.master')

@section('contents')
    <h1>Upload Payment Receipt</h1>
    
    <form action="{{ route('payment.uploadReceipt.post', $order->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="receipt">Upload Receipt:</label>
            <input type="file" class="form-control" id="receipt" name="receipt" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Upload Receipt</button>
    </form>
@endsection
