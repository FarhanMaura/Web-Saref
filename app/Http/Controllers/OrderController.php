<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
                      ->with('package')
                      ->orderBy('created_at', 'desc')
                      ->get();
        return view('orders.index', compact('orders'));
    }

    public function create(Package $package)
    {
        // Cek apakah user ada order yang belum lunas
        $unpaidOrders = Order::where('user_id', Auth::id())
                           ->whereIn('payment_status', ['unpaid', 'pending'])
                           ->first();

        if ($unpaidOrders) {
            return redirect()->route('orders.index')
                           ->with('error', 'Anda tidak bisa membuat pesanan baru karena masih ada pesanan yang belum lunas. Silakan selesaikan pembayaran terlebih dahulu.');
        }

        return view('orders.create', compact('package'));
    }

    public function store(Request $request)
    {
        $today = Carbon::today();
        $maxDate = $today->copy()->addYears(3);

        $request->validate([
            'package_id' => 'required|exists:packages,id',
            'event_date' => [
                'required',
                'date',
                'after:' . $today->format('Y-m-d'),
                'before_or_equal:' . $maxDate->format('Y-m-d')
            ],
            'event_location' => 'required|string|max:500',
            'special_requests' => 'nullable|string|max:1000'
        ], [
            'event_date.after' => 'Tanggal acara harus setelah hari ini.',
            'event_date.before_or_equal' => 'Tanggal acara maksimal 3 tahun dari sekarang.'
        ]);

        // Cek apakah user ada order yang belum lunas
        $unpaidOrders = Order::where('user_id', Auth::id())
                           ->whereIn('payment_status', ['unpaid', 'pending'])
                           ->first();

        if ($unpaidOrders) {
            return redirect()->route('orders.index')
                           ->with('error', 'Anda tidak bisa membuat pesanan baru karena masih ada pesanan yang belum lunas.');
        }

        Order::create([
            'user_id' => Auth::id(),
            'package_id' => $request->package_id,
            'event_date' => $request->event_date,
            'event_location' => $request->event_location,
            'special_requests' => $request->special_requests,
        ]);

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat! Silakan lakukan pembayaran.');
    }
}
