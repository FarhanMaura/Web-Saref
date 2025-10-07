<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pesan Paket') }} - {{ $package->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Package Info -->
                    <div class="bg-gray-50 p-4 rounded-lg mb-6">
                        <h3 class="text-lg font-semibold mb-2">Detail Paket</h3>
                        <p class="text-gray-600">{{ $package->name }}</p>
                        <p class="text-2xl font-bold text-green-600 mt-2">Rp {{ number_format($package->price, 0, ',', '.') }}</p>
                    </div>

                    <!-- Order Form -->
                    <form method="POST" action="{{ route('orders.store') }}">
                        @csrf
                        <input type="hidden" name="package_id" value="{{ $package->id }}">

                        <div class="space-y-6">
                            <!-- Event Date -->
                            <div>
                                <label for="event_date" class="block text-sm font-medium text-gray-700">Tanggal Acara</label>
                                <input type="date" name="event_date" id="event_date"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                       max="{{ date('Y-m-d', strtotime('+3 years')) }}"
                                       required>
                                <p class="text-sm text-gray-500 mt-1">
                                    Pilih tanggal antara besok hingga 3 tahun dari sekarang
                                </p>
                                @error('event_date')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Event Location -->
                            <div>
                                <label for="event_location" class="block text-sm font-medium text-gray-700">Lokasi Acara</label>
                                <textarea name="event_location" id="event_location" rows="3"
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                          placeholder="Masukkan alamat lengkap lokasi acara"
                                          required></textarea>
                                @error('event_location')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Special Requests -->
                            <div>
                                <label for="special_requests" class="block text-sm font-medium text-gray-700">Permintaan Khusus (Optional)</label>
                                <textarea name="special_requests" id="special_requests" rows="3"
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                          placeholder="Contoh: Konsep tertentu, pose khusus, dll."></textarea>
                                @error('special_requests')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex justify-end space-x-4 pt-6">
                                <a href="{{ route('packages.show', $package) }}"
                                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                                    Batal
                                </a>
                                <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                                    Buat Pesanan
                                </button>
                            </div>
                        </div>
                    </form>
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
    </script>
</x-app-layout>
