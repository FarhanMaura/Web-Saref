<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\ReviewReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewReplyController extends Controller
{
    /**
     * Store a newly created review reply.
     */
    public function store(Request $request)
    {
        // Validasi bahwa hanya admin yang bisa membalas
        if (!Auth::user()->isAdmin()) {
            return back()->with('error', 'Hanya admin yang dapat membalas komentar.');
        }

        $request->validate([
            'review_id' => 'required|exists:reviews,id',
            'reply_message' => 'required|string|max:1000'
        ]);

        // Cek apakah review exists
        $review = Review::findOrFail($request->review_id);

        // Buat balasan
        ReviewReply::create([
            'review_id' => $request->review_id,
            'user_id' => Auth::id(),
            'reply_message' => $request->reply_message,
        ]);

        return back()->with('success', 'Balasan berhasil dikirim!');
    }

    /**
     * Update the specified review reply.
     */
    public function update(Request $request, ReviewReply $reviewReply)
    {
        if (!Auth::user()->isAdmin()) {
            return back()->with('error', 'Hanya admin yang dapat mengedit balasan.');
        }

        $request->validate([
            'reply_message' => 'required|string|max:1000'
        ]);

        $reviewReply->update([
            'reply_message' => $request->reply_message,
        ]);

        return back()->with('success', 'Balasan berhasil diperbarui!');
    }

    /**
     * Remove the specified review reply.
     */
    public function destroy(ReviewReply $reviewReply)
    {
        if (!Auth::user()->isAdmin()) {
            return back()->with('error', 'Hanya admin yang dapat menghapus balasan.');
        }

        $reviewReply->delete();

        return back()->with('success', 'Balasan berhasil dihapus!');
    }

    /**
     * Hide the specified review reply.
     */
    public function hide(ReviewReply $reviewReply)
    {
        if (!Auth::user()->isAdmin()) {
            return back()->with('error', 'Hanya admin yang dapat menyembunyikan balasan.');
        }

        $reviewReply->update([
            'is_visible' => false,
        ]);

        return back()->with('success', 'Balasan berhasil disembunyikan!');
    }

    /**
     * Show the specified review reply.
     */
    public function show(ReviewReply $reviewReply)
    {
        if (!Auth::user()->isAdmin()) {
            return back()->with('error', 'Hanya admin yang dapat menampilkan balasan.');
        }

        $reviewReply->update([
            'is_visible' => true,
        ]);

        return back()->with('success', 'Balasan berhasil ditampilkan!');
    }
}
