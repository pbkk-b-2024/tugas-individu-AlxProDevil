@extends('layouts.master')

@section('contents')
    <h1>Edit Review</h1>
    
    <form action="{{ route('reviews.update', $review->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="review">Your Review</label>
            <textarea name="review" id="review" class="form-control" required>{{ $review->review }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Review</button>
    </form>
@endsection
