<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function updatePaymentStatus(Order $order, Request $request)
    {
        $request->validate([
            'payment_status' => 'required|in:unpaid,pending,paid'
        ]);

        $order->update([
            'payment_status' => $request->payment_status
        ]);

        return back()->with('success', 'Status pembayaran berhasil diupdate menjadi: ' . $request->payment_status);
    }

    public function updateOrderStatus(Order $order, Request $request)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $order->update([
            'status' => $request->status
        ]);

        return back()->with('success', 'Status pesanan berhasil diupdate menjadi: ' . $request->status);
    }
}
