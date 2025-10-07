<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:1000'
        ]);

        // Cek apakah user sudah punya order yang paid untuk package ini
        $hasPaidOrder = Order::where('user_id', Auth::id())
                           ->where('package_id', $request->package_id)
                           ->where('payment_status', 'paid')
                           ->exists();

        if (!$hasPaidOrder) {
            return back()->with('error', 'Anda hanya bisa memberikan ulasan untuk paket yang sudah Anda bayar.');
        }

        // Cek apakah user sudah pernah review package ini
        $existingReview = Review::where('user_id', Auth::id())
                              ->where('package_id', $request->package_id)
                              ->exists();

        if ($existingReview) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk paket ini.');
        }

        Review::create([
            'user_id' => Auth::id(),
            'package_id' => $request->package_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Ulasan berhasil dikirim!');
    }
}
