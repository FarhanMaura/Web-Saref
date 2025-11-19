<x-app-layout>
    <x-slot name="header">
        <h2 class="font-playfair text-2xl font-bold text-gray-900">
            {{ __('Pesanan Saya') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm mb-8">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            <!-- Header Stats -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-4 rounded-2xl shadow-lg">
                    <div class="text-2xl font-bold">{{ $orders->count() }}</div>
                    <div class="text-sm opacity-90">Total Pesanan</div>
                </div>
                <div class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white p-4 rounded-2xl shadow-lg">
                    <div class="text-2xl font-bold">{{ $orders->whereIn('payment_status', ['unpaid', 'pending'])->count() }}</div>
                    <div class="text-sm opacity-90">Menunggu Bayar</div>
                </div>
                <div class="bg-gradient-to-r from-green-500 to-teal-500 text-white p-4 rounded-2xl shadow-lg">
                    <div class="text-2xl font-bold">{{ $orders->where('payment_status', 'paid')->where('status', 'completed')->count() }}</div>
                    <div class="text-sm opacity-90">Selesai</div>
                </div>
                <div class="bg-gradient-to-r from-purple-500 to-pink-500 text-white p-4 rounded-2xl shadow-lg">
                    <div class="text-2xl font-bold">{{ $orders->where('status', 'confirmed')->count() }}</div>
                    <div class="text-sm opacity-90">Dikonfirmasi</div>
                </div>
            </div>

            <!-- Orders Table -->
            <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100">
                <div class="p-6">
                    @if($orders->count() > 0)
                        <div class="overflow-x-auto rounded-xl border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                    <tr>
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
                                    @foreach($orders as $order)
                                        <tr class="hover:bg-pink-50 transition duration-150 group" data-order-id="{{ $order->id }}">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center space-x-3">
                                                    @if($order->package->image)
                                                        <img src="{{ Storage::disk('public')->exists($order->package->image) ? asset('storage/' . $order->package->image) : asset('images/default-package.jpg') }}"
                                                             alt="{{ $order->package->name }}"
                                                             class="w-12 h-12 object-cover rounded-lg">
                                                    @else
                                                        <div class="w-12 h-12 bg-gradient-to-br from-pink-100 to-purple-100 rounded-lg flex items-center justify-center">
                                                            <svg class="w-6 h-6 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                            </svg>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <div class="text-sm font-semibold text-gray-900 group-hover:text-pink-600">{{ $order->package->name }}</div>
                                                        <div class="text-sm font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-600 to-purple-600">
                                                            Rp {{ number_format($order->package->price, 0, ',', '.') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ \Carbon\Carbon::parse($order->event_date)->format('d M Y') }}
                                                </div>
                                                <div class="text-sm text-gray-500 max-w-xs truncate">
                                                    📍 {{ Str::limit($order->event_location, 35) }}
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
                                                <div class="flex items-center space-x-2">
                                                    @if($order->payment_status === 'unpaid')
                                                        @php
                                                            $whatsappMessage = "Halo Admin RJ Visual Stories, saya ingin melakukan pembayaran untuk pesanan berikut:%0A%0A" .
                                                            "📦 *Paket:* " . $order->package->name . "%0A" .
                                                            "💰 *Harga:* Rp " . number_format($order->package->price, 0, ',', '.') . "%0A" .
                                                            "📅 *Tanggal Acara:* " . \Carbon\Carbon::parse($order->event_date)->format('d M Y') . "%0A" .
                                                            "📍 *Lokasi:* " . $order->event_location . "%0A%0A" .
                                                            "Mohon info cara pembayaran dan diskusi lebih lanjut. Terima kasih! 🙏";
                                                        @endphp
                                                        <a href="https://wa.me/62895800561354?text={{ $whatsappMessage }}"
                                                           target="_blank"
                                                           class="inline-flex items-center bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold py-2 px-4 rounded-xl transition duration-300 shadow-lg hover:shadow-xl text-sm">
                                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893-.001-3.189-1.262-6.209-3.553-8.485"/>
                                                            </svg>
                                                            Bayar via WA
                                                        </a>
                                                    @endif

                                                    <button onclick="showOrderDetail({{ $order->id }})"
                                                            class="inline-flex items-center bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-semibold py-2 px-4 rounded-xl transition duration-300 shadow-lg hover:shadow-xl text-sm">
                                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        Detail
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination or Additional Info -->
                        <div class="mt-6 flex justify-between items-center">
                            <p class="text-gray-600 text-sm">
                                Menampilkan {{ $orders->count() }} pesanan
                            </p>
                            <a href="{{ route('packages.index') }}"
                               class="inline-flex items-center bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-semibold py-2 px-6 rounded-xl transition duration-300 shadow-lg hover:shadow-xl">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Pesan Paket Baru
                            </a>
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-16">
                            <div class="w-32 h-32 bg-gradient-to-br from-pink-50 to-purple-50 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-16 h-16 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                            </div>
                            <h3 class="font-playfair text-2xl font-bold text-gray-900 mb-3">Belum Ada Pesanan</h3>
                            <p class="text-gray-600 mb-8 max-w-md mx-auto">
                                Mulai pesan paket photography pertama Anda dan abadikan momen spesial bersama kami.
                            </p>
                            <a href="{{ route('packages.index') }}"
                               class="inline-flex items-center bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-bold py-4 px-8 rounded-xl transition duration-300 shadow-lg hover:shadow-xl text-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Jelajahi Paket
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Order Details -->
    <div id="orderDetailModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden transition-opacity duration-300">
        <div class="bg-white rounded-2xl shadow-2xl w-11/12 md:w-2/3 lg:w-1/2 max-w-2xl mx-4 transform transition-transform duration-300 scale-95">
            <div class="p-6">
                <!-- Modal Header -->
                <div class="flex justify-between items-center mb-6">
                    <h3 class="font-playfair text-2xl font-bold text-gray-900">Detail Pesanan</h3>
                    <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 transition duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Modal Content -->
                <div id="modalContent" class="space-y-4 max-h-96 overflow-y-auto">
                    <!-- Content will be filled by JavaScript -->
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end mt-6 pt-4 border-t border-gray-200">
                    <button onclick="closeModal()"
                            class="bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-semibold py-3 px-6 rounded-xl transition duration-300">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showOrderDetail(orderId) {
        const modal = document.getElementById('orderDetailModal');
        const content = document.getElementById('modalContent');

        // Cari baris order yang sesuai
        const orderRow = document.querySelector(`tr[data-order-id="${orderId}"]`);
        if (!orderRow) {
            console.error('Order row not found');
            return;
        }

        // Ambil data dari baris
        const packageName = orderRow.querySelector('.text-sm.font-semibold').textContent;
        const priceElement = orderRow.querySelector('.bg-gradient-to-r');
        const price = priceElement ? priceElement.textContent : 'Rp 0';
        const eventDate = orderRow.querySelector('.text-sm.font-medium').textContent;
        const locationElement = orderRow.querySelector('.text-gray-500');
        const location = locationElement ? locationElement.textContent.replace('📍 ', '') : '';

        const statusBadges = orderRow.querySelectorAll('[class*="bg-"]');
        const status = statusBadges[0] ? statusBadges[0].textContent.trim() : 'Unknown';
        const paymentStatus = statusBadges[1] ? statusBadges[1].textContent.trim() : 'Unknown';

        const orderDate = new Date().toLocaleDateString('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        content.innerHTML = `
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="bg-gradient-to-r from-pink-50 to-purple-50 p-4 rounded-xl">
                        <h4 class="font-semibold text-gray-900 mb-2">Informasi Paket</h4>
                        <p class="text-gray-700">${packageName}</p>
                        <p class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-600 to-purple-600">${price}</p>
                    </div>

                    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 p-4 rounded-xl">
                        <h4 class="font-semibold text-gray-900 mb-2">Status Pesanan</h4>
                        <div class="flex items-center space-x-2">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">${status}</span>
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">${paymentStatus}</span>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-4 rounded-xl">
                        <h4 class="font-semibold text-gray-900 mb-2">Detail Acara</h4>
                        <div class="space-y-2">
                            <div class="flex items-center text-sm">
                                <svg class="w-4 h-4 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                ${eventDate}
                            </div>
                            <div class="flex items-start text-sm">
                                <svg class="w-4 h-4 mr-2 text-gray-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                ${location}
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-yellow-50 to-amber-50 p-4 rounded-xl">
                        <h4 class="font-semibold text-gray-900 mb-2">Informasi Pesanan</h4>
                        <div class="text-sm text-gray-600">
                            <p>Tanggal Pesan: ${orderDate}</p>
                            <p class="mt-1">ID Pesanan: #${orderId.toString().padStart(6, '0')}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-4 rounded-xl">
                <h4 class="font-semibold text-gray-900 mb-2">Butuh Bantuan?</h4>
                <p class="text-sm text-gray-600 mb-3">Hubungi kami melalui WhatsApp untuk pertanyaan tentang pesanan Anda.</p>
                <a href="https://wa.me/62895800561354"
                target="_blank"
                class="inline-flex items-center bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-semibold py-2 px-4 rounded-xl transition duration-300 text-sm">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893-.001-3.189-1.262-6.209-3.553-8.485"/>
                    </svg>
                    Hubungi Admin
                </a>
            </div>
        `;

        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.querySelector('.transform').classList.remove('scale-95');
            modal.querySelector('.transform').classList.add('scale-100');
        }, 50);
    }

        function closeModal() {
            const modal = document.getElementById('orderDetailModal');
            modal.querySelector('.transform').classList.remove('scale-100');
            modal.querySelector('.transform').classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('orderDetailModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        // Close modal with ESC key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</x-app-layout>
