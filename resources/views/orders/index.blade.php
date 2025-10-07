<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pesanan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($orders->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Paket
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal Acara
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Pembayaran
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($orders as $order)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">{{ $order->package->name }}</div>
                                                <div class="text-sm text-gray-500">Rp {{ number_format($order->package->price, 0, ',', '.') }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($order->event_date)->format('d M Y') }}</div>
                                                <div class="text-sm text-gray-500">{{ Str::limit($order->event_location, 30) }}</div>
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
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusColors[$order->status] }}">
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
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $paymentColors[$order->payment_status] }}">
                                                    {{ ucfirst($order->payment_status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                @if($order->payment_status === 'unpaid')
                                                    @php
                                                        $whatsappMessage = "Halo Admin, saya ingin melakukan pembayaran untuk pesanan berikut:%0A%0A" .
                                                        "📦 Paket: " . $order->package->name . "%0A" .
                                                        "💰 Harga: Rp " . number_format($order->package->price, 0, ',', '.') . "%0A" .
                                                        "📅 Tanggal Acara: " . \Carbon\Carbon::parse($order->event_date)->format('d M Y') . "%0A" .
                                                        "📍 Lokasi: " . $order->event_location . "%0A%0A" .
                                                        "Mohon info cara pembayaran dan diskusi lebih lanjut. Terima kasih!";
                                                    @endphp
                                                    <a href="https://wa.me/6289616378823?text={{ $whatsappMessage }}"
                                                       target="_blank"
                                                       class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded text-xs">
                                                        Bayar via WA
                                                    </a>
                                                @endif
                                                <button onclick="showOrderDetail({{ $order }})"
                                                        class="text-blue-600 hover:text-blue-900 ml-3 text-xs bg-blue-100 hover:bg-blue-200 py-1 px-3 rounded">
                                                    Detail
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 text-lg">Belum ada pesanan.</p>
                            <a href="{{ route('packages.index') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Lihat Paket
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Order Details -->
    <div id="orderDetailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Pesanan</h3>

                <div id="modalContent" class="space-y-3">
                    <!-- Content will be filled by JavaScript -->
                </div>

                <div class="flex justify-end mt-4">
                    <button onclick="closeModal()"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showOrderDetail(order) {
            const modal = document.getElementById('orderDetailModal');
            const content = document.getElementById('modalContent');

            const orderDate = new Date(order.created_at).toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            const eventDate = new Date(order.event_date).toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            content.innerHTML = `
                <div class="border-b pb-2">
                    <strong>Paket:</strong> ${order.package.name}
                </div>
                <div class="border-b pb-2">
                    <strong>Harga:</strong> Rp ${new Intl.NumberFormat('id-ID').format(order.package.price)}
                </div>
                <div class="border-b pb-2">
                    <strong>Tanggal Pesan:</strong> ${orderDate}
                </div>
                <div class="border-b pb-2">
                    <strong>Tanggal Acara:</strong> ${eventDate}
                </div>
                <div class="border-b pb-2">
                    <strong>Lokasi:</strong> ${order.event_location}
                </div>
                <div class="border-b pb-2">
                    <strong>Status:</strong> <span class="capitalize">${order.status}</span>
                </div>
                <div class="border-b pb-2">
                    <strong>Pembayaran:</strong> <span class="capitalize">${order.payment_status}</span>
                </div>
                ${order.special_requests ? `
                <div class="border-b pb-2">
                    <strong>Permintaan Khusus:</strong> ${order.special_requests}
                </div>
                ` : ''}
            `;

            modal.classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('orderDetailModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modal = document.getElementById('orderDetailModal');
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>
</x-app-layout>
