<?php

use App\Http\Controllers\PackageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Welcome Page (Landing Page - tampil untuk semua, termasuk user login)
Route::get('/', function () {
    return view('welcome');
});

// Redirect route untuk user yang login agar diarahkan ke dashboard sesuai peran
Route::get('/home', function () {
    if (Auth::check()) {
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('dashboard');
    }
    return redirect('/');
});

// Dashboard untuk user biasa - MODIFIED: Admin tidak bisa akses
Route::get('/dashboard', function () {
    // Jika user adalah admin, redirect ke admin dashboard
    if (Auth::user()->isAdmin()) {
        return redirect()->route('admin.dashboard')->with('info', 'Admin diarahkan ke dashboard admin.');
    }

    // Jika user biasa, tampilkan dashboard user
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ==================== PUBLIC ROUTES ==================== //
// Menampilkan semua paket & detail paket
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/packages/{package}', [PackageController::class, 'show'])->name('packages.show');

// ==================== AUTHENTICATED USER ROUTES ==================== //
Route::middleware(['auth'])->group(function () {

    // Orders - MODIFIED: Hanya user biasa yang bisa akses
    Route::get('/orders', function () {
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('error', 'Admin tidak dapat mengakses halaman orders user.');
        }
        return app(OrderController::class)->index();
    })->name('orders.index');

    // FIXED: orders.create - cari package by ID dulu
    Route::get('/orders/create/{package}', function ($packageId) {
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('error', 'Admin tidak dapat membuat pesanan.');
        }

        // Cari package by ID
        $package = \App\Models\Package::find($packageId);

        if (!$package) {
            return redirect()->route('packages.index')->with('error', 'Paket tidak ditemukan.');
        }

        return app(OrderController::class)->create($package);
    })->name('orders.create');

    // FIXED: orders.store - pass request object dengan benar
    Route::post('/orders', function () {
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('error', 'Admin tidak dapat membuat pesanan.');
        }
        return app(OrderController::class)->store(request());
    })->name('orders.store');

    // Reviews (user dapat memberikan review) - MODIFIED: Hanya user biasa
    Route::post('/reviews', function () {
        if (Auth::user()->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('error', 'Admin tidak dapat memberikan review.');
        }
        return app(ReviewController::class)->store(request());
    })->name('reviews.store');

    // ==================== ADMIN ROUTES ==================== //
    Route::prefix('admin')->group(function () {

        // Dashboard Admin
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

        // Statistik Admin (halaman grafik)
        Route::get('/statistics', function () {
            if (!Auth::user()->isAdmin()) {
                return redirect()->route('dashboard')->with('error', 'Akses ditolak.');
            }

            $totalOrders = \App\Models\Order::count();
            $totalPackages = \App\Models\Package::count();
            $totalUsers = \App\Models\User::count();

            $totalRevenue = \App\Models\Order::where('status', 'completed')
                ->where('payment_status', 'paid')
                ->with('package')
                ->get()
                ->sum(function($order) {
                    return $order->package->price;
                });

            $selectedYear = request('year', date('Y'));
            $selectedMonth = request('month', date('n'));

            $weeklyData = [];
            for ($week = 1; $week <= 4; $week++) {
                $startDay = ($week - 1) * 7 + 1;
                $endDay = min($week * 7, cal_days_in_month(CAL_GREGORIAN, $selectedMonth, $selectedYear));

                $startDate = $selectedYear . '-' . str_pad($selectedMonth, 2, '0', STR_PAD_LEFT) . '-' . str_pad($startDay, 2, '0', STR_PAD_LEFT);
                $endDate = $selectedYear . '-' . str_pad($selectedMonth, 2, '0', STR_PAD_LEFT) . '-' . str_pad($endDay, 2, '0', STR_PAD_LEFT);

                $weekOrders = \App\Models\Order::where('status', 'completed')
                    ->where('payment_status', 'paid')
                    ->whereDate('created_at', '>=', $startDate)
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

        // Review Management oleh admin
        Route::patch('/reviews/{review}/hide', [\App\Http\Controllers\Admin\ReviewController::class, 'hide'])
             ->name('admin.reviews.hide');
        Route::patch('/reviews/{review}/show', [\App\Http\Controllers\Admin\ReviewController::class, 'show'])
             ->name('admin.reviews.show');

        // Order Management oleh admin
        Route::patch('/orders/{order}/update-payment', [\App\Http\Controllers\Admin\OrderController::class, 'updatePaymentStatus'])
             ->name('admin.orders.update-payment');
        Route::patch('/orders/{order}/update-status', [\App\Http\Controllers\Admin\OrderController::class, 'updateOrderStatus'])
             ->name('admin.orders.update-status');

        // CRUD Paket oleh admin
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

        // ==================== USER MANAGEMENT oleh Admin ==================== //
        Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])
             ->name('admin.users.index');
        Route::patch('/users/{user}/role', [\App\Http\Controllers\Admin\UserController::class, 'updateRole'])
             ->name('admin.users.update-role');
        Route::delete('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])
             ->name('admin.users.destroy');
    });
});

// Authentication Routes (login, register, dll)
require __DIR__.'/auth.php';
