@extends('layouts.master')

@section('contents')
    <h1>Add Review</h1>
    
    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="review">Your Review</label>
            <textarea name="review" id="review" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit Review</button>
    </form>
@endsection
