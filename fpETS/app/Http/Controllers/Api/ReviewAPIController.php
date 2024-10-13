<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewAPIController extends Controller
{
    /**
     * Display a listing of reviews.
     */
    public function index()
    {
        $reviews = Review::with('user')->get();

        $userReview = Auth::check() ? Review::where('user_id', Auth::id())->first() : null;

        return response()->json([
            'reviews' => $reviews,
            'userReview' => $userReview,
        ], 200);
    }

    /**
     * Store a new review.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'review' => 'required|string|max:1000',
        ]);

        $review = Review::updateOrCreate(
            ['user_id' => $request->user_id],
            ['review' => $request->review]
        );

        return response()->json(['message' => 'Review submitted successfully.', 'review' => $review], 201);
    }

    /**
     * Show a specific review.
     */
    public function show($id)
    {
        $review = Review::with('user')->findOrFail($id);

        return response()->json($review, 200);
    }

    /**
     * Update a review.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'review' => 'required|string|max:1000',
        ]);

        $review = Review::findOrFail($id);

        $review->update(['review' => $request->review]);

        return response()->json(['message' => 'Review updated successfully.', 'review' => $review], 200);
    }

    /**
     * Delete a review.
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        $review->delete();
        
        return response()->json(['message' => 'Review deleted successfully.'], 200);
    }
}