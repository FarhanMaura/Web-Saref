<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-playfair text-2xl font-bold text-gray-900">
                🎯 Dashboard Admin
            </h2>
            <div class="text-sm text-gray-600 bg-white px-4 py-2 rounded-xl border border-gray-200">
                Selamat datang, {{ Auth::user()->name }}!
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm mb-6">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <!-- Total Orders Card -->
                <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100 hover:shadow-xl transition duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-4 shadow-lg">
                                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Pesanan</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $totalOrders }}</p>
                                <p class="text-xs text-gray-400 mt-1">Semua pesanan</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Packages Card -->
                <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100 hover:shadow-xl transition duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-4 shadow-lg">
                                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Paket</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $totalPackages }}</p>
                                <p class="text-xs text-gray-400 mt-1">Paket tersedia</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Users Card -->
                <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100 hover:shadow-xl transition duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-4 shadow-lg">
                                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Users</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</p>
                                <p class="text-xs text-gray-400 mt-1">User terdaftar</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <a href="{{ route('admin.statistics') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white p-4 rounded-2xl text-center transition duration-300 shadow-lg hover:shadow-xl">
                    <div class="text-2xl mb-2">📊</div>
                    <div class="font-semibold">Statistik</div>
                </a>
                <a href="{{ route('admin.packages.index') }}" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white p-4 rounded-2xl text-center transition duration-300 shadow-lg hover:shadow-xl">
                    <div class="text-2xl mb-2">📦</div>
                    <div class="font-semibold">Kelola Paket</div>
                </a>
                <a href="{{ route('admin.users.index') }}" class="bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white p-4 rounded-2xl text-center transition duration-300 shadow-lg hover:shadow-xl">
                    <div class="text-2xl mb-2">👥</div>
                    <div class="font-semibold">Kelola User</div>
                </a>
                <a href="{{ route('packages.index') }}" class="bg-gradient-to-r from-pink-500 to-pink-600 hover:from-pink-600 hover:to-pink-700 text-white p-4 rounded-2xl text-center transition duration-300 shadow-lg hover:shadow-xl">
                    <div class="text-2xl mb-2">👀</div>
                    <div class="font-semibold">Lihat Paket</div>
                </a>
            </div>

            <!-- Recent Orders -->
            <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-playfair text-xl font-bold text-gray-900">🆕 Pesanan Terbaru</h3>
                        <div class="text-sm text-gray-600">
                            {{ $recentOrders->count() }} pesanan terbaru
                        </div>
                    </div>

                    @if($recentOrders->count() > 0)
                        <div class="overflow-x-auto rounded-xl border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Customer
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Paket & Harga
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Acara
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Pembayaran
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($recentOrders as $order)
                                        <tr class="hover:bg-pink-50 transition duration-150 group">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center space-x-3">
                                                    <div class="flex-shrink-0">
                                                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-10 w-10 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                                            {{ strtoupper(substr($order->user->name, 0, 1)) }}
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-semibold text-gray-900 group-hover:text-pink-600">
                                                            {{ $order->user->name }}
                                                        </div>
                                                        <div class="text-xs text-gray-500">{{ $order->user->email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-semibold text-gray-900">{{ $order->package->name }}</div>
                                                <div class="text-sm font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-600 to-purple-600">
                                                    Rp {{ number_format($order->package->price, 0, ',', '.') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ \Carbon\Carbon::parse($order->event_date)->format('d M Y') }}
                                                </div>
                                                <div class="text-xs text-gray-500 max-w-xs truncate">
                                                    📍 {{ Str::limit($order->event_location, 30) }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @php
                                                    $statusColors = [
                                                        'pending' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                                                        'confirmed' => 'bg-blue-100 text-blue-800 border border-blue-200',
                                                        'completed' => 'bg-green-100 text-green-800 border border-green-200',
                                                        'cancelled' => 'bg-red-100 text-red-800 border border-red-200'
                                                    ];
                                                    $statusIcons = [
                                                        'pending' => '⏳',
                                                        'confirmed' => '✅',
                                                        'completed' => '🎉',
                                                        'cancelled' => '❌'
                                                    ];
                                                @endphp
                                                <span class="px-3 py-2 inline-flex items-center text-xs font-semibold rounded-full {{ $statusColors[$order->status] }}">
                                                    {{ $statusIcons[$order->status] }}
                                                    <span class="ml-1">{{ ucfirst($order->status) }}</span>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @php
                                                    $paymentColors = [
                                                        'unpaid' => 'bg-red-100 text-red-800 border border-red-200',
                                                        'pending' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
                                                        'paid' => 'bg-green-100 text-green-800 border border-green-200'
                                                    ];
                                                    $paymentIcons = [
                                                        'unpaid' => '💳',
                                                        'pending' => '⏳',
                                                        'paid' => '✅'
                                                    ];
                                                @endphp
                                                <span class="px-3 py-2 inline-flex items-center text-xs font-semibold rounded-full {{ $paymentColors[$order->payment_status] }}">
                                                    {{ $paymentIcons[$order->payment_status] }}
                                                    <span class="ml-1">{{ ucfirst($order->payment_status) }}</span>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex flex-col space-y-2">
                                                    <!-- Payment Status Buttons -->
                                                    <div class="flex space-x-1">
                                                        <form action="{{ route('admin.orders.update-payment', $order) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="payment_status" value="unpaid">
                                                            <button type="submit"
                                                                    class="text-xs bg-red-100 hover:bg-red-200 text-red-800 py-1 px-2 rounded-lg transition duration-200 {{ $order->payment_status === 'unpaid' ? 'ring-2 ring-red-500 font-bold' : '' }}"
                                                                    title="Set Unpaid">
                                                                Unpaid
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('admin.orders.update-payment', $order) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="payment_status" value="pending">
                                                            <button type="submit"
                                                                    class="text-xs bg-yellow-100 hover:bg-yellow-200 text-yellow-800 py-1 px-2 rounded-lg transition duration-200 {{ $order->payment_status === 'pending' ? 'ring-2 ring-yellow-500 font-bold' : '' }}"
                                                                    title="Set Pending">
                                                                Pending
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('admin.orders.update-payment', $order) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="payment_status" value="paid">
                                                            <button type="submit"
                                                                    class="text-xs bg-green-100 hover:bg-green-200 text-green-800 py-1 px-2 rounded-lg transition duration-200 {{ $order->payment_status === 'paid' ? 'ring-2 ring-green-500 font-bold' : '' }}"
                                                                    title="Set Lunas">
                                                                Lunas
                                                            </button>
                                                        </form>
                                                    </div>

                                                    <!-- Order Status Buttons -->
                                                    <div class="flex space-x-1">
                                                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="pending">
                                                            <button type="submit"
                                                                    class="text-xs bg-yellow-100 hover:bg-yellow-200 text-yellow-800 py-1 px-2 rounded-lg transition duration-200 {{ $order->status === 'pending' ? 'ring-2 ring-yellow-500 font-bold' : '' }}"
                                                                    title="Set Pending">
                                                                Pending
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="confirmed">
                                                            <button type="submit"
                                                                    class="text-xs bg-blue-100 hover:bg-blue-200 text-blue-800 py-1 px-2 rounded-lg transition duration-200 {{ $order->status === 'confirmed' ? 'ring-2 ring-blue-500 font-bold' : '' }}"
                                                                    title="Set Confirmed">
                                                                Confirm
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="hidden" name="status" value="completed">
                                                            <button type="submit"
                                                                    class="text-xs bg-green-100 hover:bg-green-200 text-green-800 py-1 px-2 rounded-lg transition duration-200 {{ $order->status === 'completed' ? 'ring-2 ring-green-500 font-bold' : '' }}"
                                                                    title="Set Completed">
                                                                Complete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-6 text-center">
                            <a href="{{ route('admin.statistics') }}"
                               class="inline-flex items-center text-pink-600 hover:text-pink-800 font-medium">
                                Lihat Detail Statistik
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-24 h-24 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                            </div>
                            <h3 class="font-playfair text-2xl font-bold text-gray-900 mb-3">Belum Ada Pesanan</h3>
                            <p class="text-gray-600 mb-8 max-w-md mx-auto">
                                Saat ini belum ada pesanan yang masuk. Pesanan terbaru akan muncul di sini.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
