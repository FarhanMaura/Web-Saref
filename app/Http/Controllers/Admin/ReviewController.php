<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function hide(Review $review)
    {
        $review->update(['is_visible' => false]);

        return back()->with('success', 'Komentar berhasil dihide.');
    }

    public function show(Review $review)
    {
        $review->update(['is_visible' => true]);

        return back()->with('success', 'Komentar berhasil ditampilkan.');
    }
}
