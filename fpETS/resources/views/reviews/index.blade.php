@extends('layouts.master')

@section('contents')
    <h1>Reviews</h1>

    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>User</th>
                <th>Review</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
                <tr>
                    <td>{{ $review->user->name }}</td>
                    <td>{{ $review->review }}</td>
                    <td>
                        @if ($userReview && $userReview->id === $review->id)
                            <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-warning">Edit</a>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @can('review')
        @if (!$userReview)
        <a href="{{ route('reviews.create') }}" class="btn btn-primary">Add Review</a>
        @endif
    @endcan
@endsection
