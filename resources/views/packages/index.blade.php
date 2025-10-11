<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            <h2 class="font-playfair text-3xl font-bold text-gray-900 mb-2">
                ✨ Paket Spesial Pernikahan & Event
            </h2>
            <p class="text-gray-600 text-lg">
                Abadikan momen berharga dengan paket photography terbaik kami
            </p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="text-center mb-12">
                <div class="bg-gradient-to-r from-pink-500 to-purple-600 rounded-3xl p-8 text-white mb-8 shadow-2xl">
                    <h1 class="font-playfair text-4xl font-bold mb-4">
                        💝 Pilih Paket Impian Anda
                    </h1>
                    <p class="text-xl text-pink-100 mb-6 max-w-2xl mx-auto">
                        Setiap momen spesial layak diabadikan dengan sempurna. Temukan paket yang tepat untuk cerita cinta Anda.
                    </p>
                    <div class="flex flex-wrap justify-center gap-4 text-sm">
                        <div class="flex items-center bg-white bg-opacity-20 px-4 py-2 rounded-full">
                            <span class="mr-2">🎯</span> Profesional Team
                        </div>
                        <div class="flex items-center bg-white bg-opacity-20 px-4 py-2 rounded-full">
                            <span class="mr-2">💫</span> Hasil Premium
                        </div>
                        <div class="flex items-center bg-white bg-opacity-20 px-4 py-2 rounded-full">
                            <span class="mr-2">⚡</span> Proses Cepat
                        </div>
                    </div>
                </div>
            </div>

            <!-- Package Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                @foreach($packages as $package)
                    <div class="group relative">
                        <!-- Popular Badge -->
                        @if($package->is_popular)
                            <div class="absolute -top-3 left-1/2 transform -translate-x-1/2 z-10">
                                <div class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-white px-6 py-2 rounded-full text-sm font-bold shadow-lg flex items-center">
                                    <span class="mr-2">🔥</span> MOST POPULAR
                                </div>
                            </div>
                        @endif

                        <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden transform transition-all duration-500 group-hover:scale-105 group-hover:shadow-3xl h-full flex flex-col">
                            <!-- Image Section -->
                            <div class="relative overflow-hidden">
                                @if($package->image)
                                    <img src="{{ Storage::disk('public')->exists($package->image) ? asset('storage/' . $package->image) : asset('images/default-package.jpg') }}"
                                         alt="{{ $package->name }}"
                                         class="w-full h-64 object-cover transition-transform duration-700 group-hover:scale-110">
                                @else
                                    <div class="w-full h-64 bg-gradient-to-br from-pink-100 to-purple-100 flex items-center justify-center relative">
                                        <div class="absolute inset-0 bg-black bg-opacity-10"></div>
                                        <div class="text-center relative z-10">
                                            <div class="w-16 h-16 bg-white bg-opacity-90 rounded-full flex items-center justify-center mx-auto mb-3 shadow-lg">
                                                <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                            <span class="text-gray-600 font-medium">Preview Package</span>
                                        </div>
                                    </div>
                                @endif

                                <!-- Overlay Gradient -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-20"></div>
                            </div>

                            <!-- Content Section -->
                            <div class="p-6 flex-1 flex flex-col">
                                <!-- Header -->
                                <div class="flex justify-between items-start mb-3">
                                    <h3 class="text-2xl font-bold text-gray-900 font-playfair">{{ $package->name }}</h3>
                                    <div class="flex items-center bg-yellow-50 px-3 py-1 rounded-full border border-yellow-200">
                                        <span class="text-yellow-500 text-sm">⭐</span>
                                        <span class="ml-1 text-sm font-bold text-gray-800">
                                            {{ number_format($package->average_rating, 1) }}
                                        </span>
                                        <span class="ml-1 text-xs text-gray-500">({{ $package->reviews->count() }})</span>
                                    </div>
                                </div>

                                <!-- Description -->
                                <p class="text-gray-600 mb-4 leading-relaxed flex-1">
                                    {{ Str::limit($package->description, 100) }}
                                </p>

                                <!-- Price Section -->
                                <div class="mb-6">
                                    <div class="flex items-baseline mb-2">
                                        <span class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-600 to-purple-600">
                                            Rp {{ number_format($package->price, 0, ',', '.') }}
                                        </span>
                                        @if($package->original_price && $package->original_price > $package->price)
                                            <span class="ml-3 text-lg text-gray-400 line-through">
                                                Rp {{ number_format($package->original_price, 0, ',', '.') }}
                                            </span>
                                        @endif
                                    </div>
                                    @if($package->original_price && $package->original_price > $package->price)
                                        <div class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-bold inline-block">
                                            🎉 Hemat {{ number_format(($package->original_price - $package->price) / $package->original_price * 100, 0) }}%
                                        </div>
                                    @endif
                                </div>

                                <!-- Quick Features -->
                                <div class="grid grid-cols-2 gap-3 mb-6">
                                    <div class="flex items-center text-sm text-gray-600 bg-gray-50 px-3 py-2 rounded-lg">
                                        <span class="text-green-500 mr-2">⏱️</span>
                                        <span>{{ $package->duration ?? 'Flex' }} Jam</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600 bg-gray-50 px-3 py-2 rounded-lg">
                                        <span class="text-blue-500 mr-2">📸</span>
                                        <span>{{ $package->photos_count ?? '100+' }} Foto</span>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="flex space-x-3">
                                    <a href="{{ route('packages.show', $package) }}"
                                       class="flex-1 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-bold py-4 px-4 rounded-xl transition-all duration-300 text-center shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                        <span class="flex items-center justify-center">
                                            <span class="mr-2">👀</span>
                                            Lihat Detail
                                        </span>
                                    </a>
                                    <button class="w-12 h-12 border-2 border-gray-300 hover:border-pink-300 rounded-xl transition-all duration-300 flex items-center justify-center group hover:bg-pink-50">
                                        <svg class="w-6 h-6 text-gray-400 group-hover:text-pink-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Empty State -->
            @if($packages->isEmpty())
                <div class="bg-gradient-to-br from-white to-gray-50 rounded-3xl shadow-2xl border border-gray-200 p-16 text-center">
                    <div class="max-w-md mx-auto">
                        <div class="w-32 h-32 bg-gradient-to-br from-pink-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-8 shadow-lg">
                            <svg class="w-16 h-16 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <h3 class="font-playfair text-3xl font-bold text-gray-900 mb-4">Paket Sedang Disiapkan</h3>
                        <p class="text-gray-600 text-lg mb-8 leading-relaxed">
                            Kami sedang menyiapkan paket terbaik untuk Anda. Silakan hubungi kami untuk informasi lebih lanjut.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="{{ route('dashboard') }}"
                               class="bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-bold py-4 px-8 rounded-xl transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                🏠 Kembali ke Dashboard
                            </a>
                            <button class="border-2 border-pink-500 text-pink-600 hover:bg-pink-50 font-bold py-4 px-8 rounded-xl transition duration-300 transform hover:-translate-y-1">
                                📞 Hubungi Admin
                            </button>
                        </div>
                    </div>
                </div>
            @endif

            <!-- CTA Section -->
            <div class="bg-gradient-to-r from-pink-500 via-purple-500 to-pink-600 rounded-3xl p-12 text-white text-center relative overflow-hidden">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute -top-20 -right-20 w-40 h-40 bg-white rounded-full"></div>
                    <div class="absolute -bottom-20 -left-20 w-40 h-40 bg-white rounded-full"></div>
                </div>

                <div class="relative z-10">
                    <h3 class="font-playfair text-3xl font-bold mb-4">Butuh Paket Kustom?</h3>
                    <p class="text-xl text-pink-100 mb-8 max-w-2xl mx-auto leading-relaxed">
                        Ceritakan konsep impian Anda, kami akan wujudkan dalam paket photography yang sempurna!
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <button class="bg-white text-pink-600 hover:bg-pink-50 font-bold py-4 px-8 rounded-xl transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            💬 Konsultasi Gratis
                        </button>
                        <button class="border-2 border-white text-white hover:bg-white hover:bg-opacity-10 font-bold py-4 px-8 rounded-xl transition duration-300 transform hover:-translate-y-1">
                            🎨 Lihat Portfolio
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .shadow-3xl {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        .group:hover .group-hover\:scale-105 {
            transform: scale(1.05);
        }
    </style>
</x-app-layout>
