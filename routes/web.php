<?php

use App\Http\Controllers\PackageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Package Routes
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{package}', [PackageController::class, 'show'])->name('packages.show');

// Order Routes (hanya untuk user yang login)
Route::middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/create/{package}', [OrderController::class, 'create'])->name('orders.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

    // Review Routes
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

    // Admin Routes (hanya untuk admin yang login)
    Route::prefix('admin')->group(function () {

        // Dashboard (yang lama - untuk konfirmasi pembayaran)
        Route::get('/dashboard', function () {
            if (!Auth::user()->isAdmin()) {
                return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
            }

            $totalOrders = \App\Models\Order::count();
            $totalPackages = \App\Models\Package::count();
            $totalUsers = \App\Models\User::count();
            $recentOrders = \App\Models\Order::with(['user', 'package'])
                                           ->orderBy('created_at', 'desc')
                                           ->take(10)
                                           ->get();

            return view('admin.dashboard', compact(
                'totalOrders',
                'totalPackages',
                'totalUsers',
                'recentOrders'
            ));
        })->name('admin.dashboard');

        // Statistics (halaman baru untuk grafik)
        Route::get('/statistics', function () {
            if (!Auth::user()->isAdmin()) {
                return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
            }

            $totalOrders = \App\Models\Order::count();
            $totalPackages = \App\Models\Package::count();
            $totalUsers = \App\Models\User::count();

            // Menghitung total pendapatan dari order yang sudah dibayar
            $totalRevenue = \App\Models\Order::where('payment_status', 'paid')
                ->with('package')
                ->get()
                ->sum(function($order) {
                    return $order->package->price;
                });

            // Mendapatkan tahun dan bulan yang dipilih atau nilai default
            $selectedYear = request('year', date('Y'));
            $selectedMonth = request('month', date('n'));

            // Menghitung data mingguan untuk bulan dan tahun yang dipilih
            $weeklyData = [];

            for ($week = 1; $week <= 4; $week++) {
                // Menghitung tanggal mulai dan akhir untuk setiap minggu
                $startDay = ($week - 1) * 7 + 1;
                $endDay = min($week * 7, cal_days_in_month(CAL_GREGORIAN, $selectedMonth, $selectedYear));

                $startDate = $selectedYear . '-' . str_pad($selectedMonth, 2, '0', STR_PAD_LEFT) . '-' . str_pad($startDay, 2, '0', STR_PAD_LEFT);
                $endDate = $selectedYear . '-' . str_pad($selectedMonth, 2, '0', STR_PAD_LEFT) . '-' . str_pad($endDay, 2, '0', STR_PAD_LEFT);

                // Menghitung jumlah order yang dibuat pada minggu ini
                $weekOrders = \App\Models\Order::whereDate('created_at', '>=', $startDate)
                    ->whereDate('created_at', '<=', $endDate)
                    ->count();

                $weeklyData[$week] = $weekOrders;
            }

            return view('admin.statistics', compact(
                'totalOrders',
                'totalPackages',
                'totalUsers',
                'totalRevenue',
                'weeklyData',
                'selectedYear',
                'selectedMonth'
            ));
        })->name('admin.statistics');

        // Review Management
        Route::patch('/reviews/{review}/hide', [\App\Http\Controllers\Admin\ReviewController::class, 'hide'])
             ->name('admin.reviews.hide');
        Route::patch('/reviews/{review}/show', [\App\Http\Controllers\Admin\ReviewController::class, 'show'])
             ->name('admin.reviews.show');

        // Order Management
        Route::patch('/orders/{order}/update-payment', [\App\Http\Controllers\Admin\OrderController::class, 'updatePaymentStatus'])
             ->name('admin.orders.update-payment');
        Route::patch('/orders/{order}/update-status', [\App\Http\Controllers\Admin\OrderController::class, 'updateOrderStatus'])
             ->name('admin.orders.update-status');

        // Package Management (CRUD)
        Route::get('/packages', [\App\Http\Controllers\Admin\PackageController::class, 'index'])
             ->name('admin.packages.index');
        Route::get('/packages/create', [\App\Http\Controllers\Admin\PackageController::class, 'create'])
             ->name('admin.packages.create');
        Route::post('/packages', [\App\Http\Controllers\Admin\PackageController::class, 'store'])
             ->name('admin.packages.store');
        Route::get('/packages/{package}/edit', [\App\Http\Controllers\Admin\PackageController::class, 'edit'])
             ->name('admin.packages.edit');
        Route::patch('/packages/{package}', [\App\Http\Controllers\Admin\PackageController::class, 'update'])
             ->name('admin.packages.update');
        Route::delete('/packages/{package}', [\App\Http\Controllers\Admin\PackageController::class, 'destroy'])
             ->name('admin.packages.destroy');
    });
});

require __DIR__.'/auth.php';
