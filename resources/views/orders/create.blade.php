<x-app-layout>
    <x-slot name="header">
        <h2 class="font-playfair text-2xl font-bold text-gray-900">
            {{ __('Pesan Paket') }} - {{ $package->name }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Package Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100 sticky top-8">
                        <div class="p-6">
                            @if($package->image)
                                <img src="{{ Storage::disk('public')->exists($package->image) ? asset('storage/' . $package->image) : asset('images/default-package.jpg') }}"
                                     alt="{{ $package->name }}"
                                     class="w-full h-48 object-cover rounded-xl mb-4">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-pink-50 to-purple-50 rounded-xl flex items-center justify-center mb-4">
                                    <div class="text-center">
                                        <div class="w-12 h-12 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                            <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <span class="text-gray-400 text-sm">Gambar Paket</span>
                                    </div>
                                </div>
                            @endif

                            <h3 class="font-playfair text-xl font-bold text-gray-900 mb-2">{{ $package->name }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($package->description, 120) }}</p>

                            <div class="bg-gradient-to-r from-pink-50 to-purple-50 p-4 rounded-xl mb-4">
                                <div class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-600 to-purple-600">
                                    Rp {{ number_format($package->price, 0, ',', '.') }}
                                </div>
                                <p class="text-sm text-gray-600 mt-1">Harga sudah termasuk pajak</p>
                            </div>

                            <!-- Features List -->
                            <div class="space-y-2">
                                <h4 class="font-semibold text-gray-900 text-sm mb-3">Fitur yang didapat:</h4>
                                @if(is_array($package->features))
                                    @foreach(array_slice($package->features, 0, 5) as $feature)
                                        <div class="flex items-center text-sm">
                                            <svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span class="text-gray-600">{{ $feature }}</span>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100">
                        <div class="p-8">
                            <!-- Form Header -->
                            <div class="mb-8">
                                <h3 class="font-playfair text-2xl font-bold text-gray-900 mb-2">
                                    Formulir Pemesanan
                                </h3>
                                <p class="text-gray-600">
                                    Isi data acara Anda dengan lengkap untuk proses pemesanan yang lancar.
                                </p>
                            </div>

                            <form method="POST" action="{{ route('orders.store') }}" class="space-y-8">
                                @csrf
                                <input type="hidden" name="package_id" value="{{ $package->id }}">

                                <!-- Event Date -->
                                <div class="space-y-3">
                                    <label for="event_date" class="block text-lg font-semibold text-gray-900">
                                        📅 Tanggal Acara
                                    </label>
                                    <div class="relative">
                                        <input type="date"
                                               name="event_date"
                                               id="event_date"
                                               class="w-full px-4 py-4 border-2 border-gray-200 rounded-2xl shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg transition duration-200"
                                               min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                               max="{{ date('Y-m-d', strtotime('+3 years')) }}"
                                               required>
                                        <div class="absolute right-4 top-1/2 transform -translate-y-1/2">
                                            <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-500 flex items-center">
                                        <svg class="w-4 h-4 mr-1 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Pilih tanggal antara besok hingga 3 tahun dari sekarang
                                    </p>
                                    @error('event_date')
                                        <p class="text-red-500 text-sm mt-2 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Event Location -->
                                <div class="space-y-3">
                                    <label for="event_location" class="block text-lg font-semibold text-gray-900">
                                        📍 Lokasi Acara
                                    </label>
                                    <textarea name="event_location"
                                              id="event_location"
                                              rows="4"
                                              class="w-full px-4 py-4 border-2 border-gray-200 rounded-2xl shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg transition duration-200 resize-none"
                                              placeholder="Masukkan alamat lengkap lokasi acara, termasuk nama venue, jalan, kota, dan kode pos..."
                                              required></textarea>
                                    @error('event_location')
                                        <p class="text-red-500 text-sm mt-2 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Special Requests -->
                                <div class="space-y-3">
                                    <label for="special_requests" class="block text-lg font-semibold text-gray-900">
                                        💫 Permintaan Khusus (Opsional)
                                    </label>
                                    <textarea name="special_requests"
                                              id="special_requests"
                                              rows="4"
                                              class="w-full px-4 py-4 border-2 border-gray-200 rounded-2xl shadow-sm focus:border-pink-500 focus:ring-pink-500 text-lg transition duration-200 resize-none"
                                              placeholder="Contoh: Konsep foto tertentu, pose khusus, waktu khusus, kebutuhan lighting, dll."></textarea>
                                    <p class="text-sm text-gray-500">
                                        Beri tahu kami jika ada kebutuhan khusus untuk acara Anda
                                    </p>
                                    @error('special_requests')
                                        <p class="text-red-500 text-sm mt-2 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <!-- Terms and Conditions -->
                                <div class="bg-gradient-to-r from-blue-50 to-cyan-50 p-6 rounded-2xl border border-blue-200">
                                    <div class="flex items-start space-x-3">
                                        <div class="flex-shrink-0">
                                            <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-900 mb-2">Informasi Penting</h4>
                                            <ul class="text-sm text-gray-600 space-y-1">
                                                <li>• Pesanan akan diproses setelah pembayaran dikonfirmasi</li>
                                                <li>• Tanggal acara dapat diubah maksimal 2 minggu sebelum H-1</li>
                                                <li>• Pembatalan pesanan dapat dilakukan dengan syarat tertentu</li>
                                                <li>• Tim kami akan menghubungi Anda untuk konfirmasi detail</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex flex-col sm:flex-row gap-4 pt-6">
                                    <a href="{{ route('packages.show', $package) }}"
                                       class="flex-1 border-2 border-gray-300 hover:border-gray-400 text-gray-700 hover:text-gray-900 font-bold py-4 px-6 rounded-2xl transition duration-300 text-center text-lg">
                                        Kembali
                                    </a>
                                    <button type="submit"
                                            class="flex-1 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-bold py-4 px-6 rounded-2xl transition duration-300 shadow-lg hover:shadow-xl text-lg transform hover:-translate-y-0.5">
                                        Buat Pesanan Sekarang
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Set min date to tomorrow and max date to 3 years from now
        const today = new Date();
        const tomorrow = new Date(today);
        tomorrow.setDate(today.getDate() + 1);

        const maxDate = new Date(today);
        maxDate.setFullYear(today.getFullYear() + 3);

        document.getElementById('event_date').min = tomorrow.toISOString().split('T')[0];
        document.getElementById('event_date').max = maxDate.toISOString().split('T')[0];

        // Add some interactivity
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input, textarea');

            inputs.forEach(input => {
                // Add focus styles
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('ring-2', 'ring-pink-200');
                });

                input.addEventListener('blur', function() {
                    this.parentElement.classList.remove('ring-2', 'ring-pink-200');
                });

                // Add character counter for textareas
                if (input.tagName === 'TEXTAREA') {
                    const counter = document.createElement('div');
                    counter.className = 'text-sm text-gray-500 text-right mt-1';
                    counter.textContent = `${input.value.length} karakter`;

                    input.parentElement.appendChild(counter);

                    input.addEventListener('input', function() {
                        counter.textContent = `${this.value.length} karakter`;
                    });
                }
            });
        });
    </script>
</x-app-layout>
