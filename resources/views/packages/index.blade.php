<x-app-layout>
    <x-slot name="header">
        <h2 class="font-playfair text-2xl font-bold text-gray-900">
            {{ __('Paket Wedding & Event Content Creator') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="font-playfair text-3xl font-bold text-gray-900 mb-2">
                    Pilih Paket Terbaik untuk Momen Spesial Anda
                </h1>
                <p class="text-gray-600">
                    Temukan paket yang sesuai dengan kebutuhan dan budget Anda. Setiap momen berharga layak diabadikan dengan sempurna.
                </p>
            </div>

            <!-- Package Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($packages as $package)
                    <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100 hover:border-pink-300 hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <!-- Image Section -->
                        @if($package->image)
                            <div class="relative overflow-hidden">
                                <img src="{{ Storage::disk('public')->exists($package->image) ? asset('storage/' . $package->image) : asset('images/default-package.jpg') }}"
                                     alt="{{ $package->name }}"
                                     class="w-full h-56 object-cover transition-transform duration-300 hover:scale-105">
                                <div class="absolute top-4 right-4">
                                    @if($package->is_popular)
                                        <span class="bg-gradient-to-r from-pink-500 to-purple-600 text-white px-3 py-1 rounded-full text-xs font-bold shadow-lg">
                                            POPULAR
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="w-full h-56 bg-gradient-to-br from-pink-50 to-purple-50 flex items-center justify-center">
                                <div class="text-center">
                                    <div class="w-12 h-12 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                        <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-gray-400 text-sm">Gambar Tidak Tersedia</span>
                                </div>
                            </div>
                        @endif

                        <!-- Content Section -->
                        <div class="p-6">
                            <!-- Package Name and Rating -->
                            <div class="flex justify-between items-start mb-3">
                                <h3 class="text-xl font-bold text-gray-900">{{ $package->name }}</h3>
                                <div class="flex items-center bg-yellow-50 px-2 py-1 rounded-full">
                                    <span class="text-yellow-500 text-sm">★</span>
                                    <span class="ml-1 text-sm font-medium text-gray-700">
                                        {{ number_format($package->average_rating, 1) }} <span class="text-gray-500">({{ $package->reviews->count() }})</span>
                                    </span>
                                </div>
                            </div>

                            <!-- Description -->
                            <p class="text-gray-600 mb-4 leading-relaxed">
                                {{ Str::limit($package->description, 120) }}
                            </p>

                            <!-- Price -->
                            <div class="mb-6">
                                <span class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-600 to-purple-600">
                                    Rp {{ number_format($package->price, 0, ',', '.') }}
                                </span>
                                @if($package->original_price && $package->original_price > $package->price)
                                    <span class="ml-2 text-lg text-gray-400 line-through">
                                        Rp {{ number_format($package->original_price, 0, ',', '.') }}
                                    </span>
                                    <span class="ml-2 bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs font-bold">
                                        Hemat {{ number_format(($package->original_price - $package->price) / $package->original_price * 100, 0) }}%
                                    </span>
                                @endif
                            </div>

                            <!-- Action Button -->
                            <div class="flex items-center justify-between">
                                <a href="{{ route('packages.show', $package) }}"
                                   class="flex-1 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-semibold py-3 px-4 rounded-xl transition duration-300 text-center shadow-lg hover:shadow-xl">
                                    Lihat Detail
                                </a>
                                <button class="ml-3 p-3 border border-gray-300 hover:border-pink-300 rounded-xl transition duration-300 group">
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Quick Features -->
                        <div class="px-6 pb-4">
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 text-green-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ $package->duration ?? 'Flexible' }} Jam</span>
                                <span class="mx-2">•</span>
                                <svg class="w-4 h-4 text-blue-500 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                </svg>
                                <span>{{ $package->photos_count ?? '100+' }} Foto</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Empty State -->
            @if($packages->isEmpty())
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-12 text-center">
                    <div class="max-w-md mx-auto">
                        <div class="w-24 h-24 bg-gradient-to-br from-pink-50 to-purple-50 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <h3 class="font-playfair text-2xl font-bold text-gray-900 mb-3">Belum Ada Paket Tersedia</h3>
                        <p class="text-gray-600 mb-6">
                            Saat ini belum ada paket yang tersedia. Silakan hubungi admin untuk informasi lebih lanjut.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('dashboard') }}"
                               class="bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-semibold py-3 px-6 rounded-xl transition duration-300">
                                Kembali ke Dashboard
                            </a>
                            <button class="border-2 border-pink-500 text-pink-600 hover:bg-pink-50 font-semibold py-3 px-6 rounded-xl transition duration-300">
                                Hubungi Admin
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Additional Info Section -->
            <div class="mt-12 bg-gradient-to-r from-pink-500 to-purple-600 rounded-2xl p-8 text-white">
                <div class="max-w-4xl mx-auto text-center">
                    <h3 class="font-playfair text-2xl font-bold mb-4">Butuh Paket Kustom?</h3>
                    <p class="text-pink-100 mb-6 text-lg">
                        Kami siap membuat paket khusus sesuai kebutuhan spesial Anda. Konsultasi gratis tanpa biaya!
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <button class="bg-white text-pink-600 hover:bg-pink-50 font-semibold py-3 px-8 rounded-xl transition duration-300">
                            Konsultasi Gratis
                        </button>
                        <button class="border-2 border-white text-white hover:bg-white hover:bg-opacity-10 font-semibold py-3 px-8 rounded-xl transition duration-300">
                            Lihat Portfolio
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
