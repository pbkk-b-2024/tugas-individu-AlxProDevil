<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('user')->get();
        $userReview = Review::where('user_id', Auth::id())->first();
        return view('reviews.index', compact('reviews', 'userReview'));
    }

    public function create()
    {
        return view('reviews.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'review' => 'required|string|max:1000',
        ]);

        Review::updateOrCreate(
            ['user_id' => Auth::id()],
            ['review' => $request->review]
        );

        return redirect()->route('reviews.index')->with('success', 'Review submitted successfully.');
    }

    public function edit($id)
    {
        $review = Review::findOrFail($id);
        return view('reviews.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'review' => 'required|string|max:1000',
        ]);

        $review = Review::findOrFail($id);
        $review->update(['review' => $request->review]);

        return redirect()->route('reviews.index')->with('success', 'Review updated successfully.');
    }
}
