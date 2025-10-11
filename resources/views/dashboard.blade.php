<x-app-layout>
    <x-slot name="header">
        <h2 class="font-playfair text-2xl font-bold text-gray-900">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="mb-8">
                <h1 class="font-playfair text-3xl font-bold text-gray-900">
                    Selamat Datang, {{ Auth::user()->name }}!
                </h1>
                <p class="mt-2 text-gray-600">
                    Kelola pesanan dan pantau status pembayaran Anda di sini.
                </p>
            </div>

            <!-- Stats Cards untuk User -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                <!-- Total Orders User -->
                <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-pink-100 hover:border-pink-300 transition duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-r from-pink-500 to-purple-600 rounded-xl p-4">
                                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Pesanan Saya</p>
                                <p class="text-2xl font-bold text-gray-900">{{ Auth::user()->orders()->count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Payments -->
                <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-yellow-100 hover:border-yellow-300 transition duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-xl p-4">
                                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Menunggu Pembayaran</p>
                                <p class="text-2xl font-bold text-gray-900">
                                    {{ Auth::user()->orders()->whereIn('payment_status', ['unpaid', 'pending'])->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Completed Orders -->
                <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-green-100 hover:border-green-300 transition duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-r from-green-500 to-teal-500 rounded-xl p-4">
                                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Pesanan Selesai</p>
                                <p class="text-2xl font-bold text-gray-900">
                                    {{ Auth::user()->orders()->where('payment_status', 'paid')->where('status', 'completed')->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent User Orders -->
            <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-playfair text-xl font-bold text-gray-900">Pesanan Terbaru Saya</h3>
                        <a href="{{ route('packages.index') }}" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-2 rounded-full text-sm font-medium transition duration-300">
                            Pesan Paket Baru
                        </a>
                    </div>

                    @php
                        $userOrders = Auth::user()->orders()->with('package')->orderBy('created_at', 'desc')->take(5)->get();
                    @endphp

                    @if($userOrders->count() > 0)
                        <div class="overflow-x-auto rounded-xl border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Paket
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal Acara
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Pembayaran
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($userOrders as $order)
                                        <tr class="hover:bg-pink-50 transition duration-150">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-semibold text-gray-900">{{ $order->package->name }}</div>
                                                <div class="text-sm text-gray-500">Rp {{ number_format($order->package->price, 0, ',', '.') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($order->event_date)->format('d M Y') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @php
                                                    $statusColors = [
                                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                                        'confirmed' => 'bg-blue-100 text-blue-800',
                                                        'completed' => 'bg-green-100 text-green-800',
                                                        'cancelled' => 'bg-red-100 text-red-800'
                                                    ];
                                                @endphp
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$order->status] }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @php
                                                    $paymentColors = [
                                                        'unpaid' => 'bg-red-100 text-red-800',
                                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                                        'paid' => 'bg-green-100 text-green-800'
                                                    ];
                                                @endphp
                                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $paymentColors[$order->payment_status] }}">
                                                    {{ ucfirst($order->payment_status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6 text-center">
                            <a href="{{ route('orders.index') }}" class="inline-flex items-center text-pink-600 hover:text-pink-800 font-medium">
                                Lihat Semua Pesanan
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    @else
                        <div class="text-center py-10">
                            <div class="bg-pink-50 rounded-full p-4 w-20 h-20 mx-auto mb-4 flex items-center justify-center">
                                <svg class="w-10 h-10 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <p class="text-gray-500 text-lg mb-4">Belum ada pesanan.</p>
                            <a href="{{ route('packages.index') }}" class="inline-flex items-center bg-pink-500 hover:bg-pink-600 text-white font-bold py-3 px-6 rounded-full transition duration-300">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Lihat Paket
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gradient-to-r from-pink-500 to-purple-600 rounded-2xl p-6 text-white">
                    <h3 class="font-playfair text-xl font-bold mb-2">Butuh Bantuan?</h3>
                    <p class="mb-4">Tim kami siap membantu Anda dengan pertanyaan tentang pesanan atau paket.</p>
                    <button class="bg-white text-pink-600 hover:bg-pink-50 px-4 py-2 rounded-full text-sm font-medium transition duration-300">
                        Hubungi Kami
                    </button>
                </div>
                <div class="bg-gradient-to-r from-blue-500 to-teal-500 rounded-2xl p-6 text-white">
                    <h3 class="font-playfair text-xl font-bold mb-2">Lihat Portfolio</h3>
                    <p class="mb-4">Jelajahi hasil karya terbaru kami untuk mendapatkan inspirasi.</p>
                    <button class="bg-white text-blue-600 hover:bg-blue-50 px-4 py-2 rounded-full text-sm font-medium transition duration-300">
                        Lihat Gallery
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
