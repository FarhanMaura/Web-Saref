<x-app-layout>
    <x-slot name="header">
        <h2 class="font-playfair text-2xl font-bold text-gray-900">
            {{ __('Detail Paket') }}
        </h2>
    </x-slot>

    <!-- Alert Messages -->
    @if(session('error'))
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('error') }}
                </div>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <!-- Main Package Card -->
            <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100">
                <div class="p-8">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                        <!-- Package Image -->
                        <div class="space-y-6">
                            @if($package->image)
                                <div class="rounded-2xl overflow-hidden shadow-lg">
                                    <img src="{{ asset('storage/' . $package->image) }}"
                                         alt="{{ $package->name }}"
                                         class="w-full h-80 object-cover transition-transform duration-300 hover:scale-105">
                                </div>
                            @else
                                <div class="w-full h-80 bg-gradient-to-br from-pink-50 to-purple-50 rounded-2xl flex items-center justify-center shadow-lg">
                                    <div class="text-center">
                                        <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                            <svg class="w-8 h-8 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                        <span class="text-gray-400">Gambar Tidak Tersedia</span>
                                    </div>
                                </div>
                            @endif

                            <!-- Quick Stats -->
                            <div class="grid grid-cols-3 gap-4">
                                <div class="text-center p-4 bg-pink-50 rounded-xl">
                                    <div class="text-2xl font-bold text-pink-600">{{ $package->duration ?? 'Flex' }}</div>
                                    <div class="text-sm text-gray-600">Jam</div>
                                </div>
                                <div class="text-center p-4 bg-purple-50 rounded-xl">
                                    <div class="text-2xl font-bold text-purple-600">{{ $package->photos_count ?? '100+' }}</div>
                                    <div class="text-sm text-gray-600">Foto</div>
                                </div>
                                <div class="text-center p-4 bg-blue-50 rounded-xl">
                                    <div class="text-2xl font-bold text-blue-600">{{ $package->reviews->count() }}</div>
                                    <div class="text-sm text-gray-600">Ulasan</div>
                                </div>
                            </div>
                        </div>

                        <!-- Package Details -->
                        <div class="space-y-6">
                            <!-- Header -->
                            <div>
                                <h1 class="font-playfair text-3xl font-bold text-gray-900 mb-3">{{ $package->name }}</h1>
                                <div class="flex items-center mb-4">
                                    <div class="flex items-center bg-yellow-50 px-3 py-1 rounded-full">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $package->average_rating)
                                                <span class="text-yellow-400 text-sm">★</span>
                                            @else
                                                <span class="text-gray-300 text-sm">★</span>
                                            @endif
                                        @endfor
                                        <span class="ml-2 text-sm font-medium text-gray-700">
                                            {{ number_format($package->average_rating, 1) }} ({{ $package->reviews->count() }} ulasan)
                                        </span>
                                    </div>
                                </div>
                                <p class="text-gray-600 leading-relaxed text-lg">{{ $package->description }}</p>
                            </div>

                            <!-- Price -->
                            <div class="bg-gradient-to-r from-pink-50 to-purple-50 p-6 rounded-2xl">
                                <div class="text-center">
                                    <div class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-600 to-purple-600 mb-2">
                                        Rp {{ number_format($package->price, 0, ',', '.') }}
                                    </div>
                                    <p class="text-gray-600">Harga sudah termasuk pajak dan semua fitur</p>
                                </div>
                            </div>

                            <!-- Features -->
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-4">Fitur Paket:</h3>
                                <div class="space-y-3">
                                    @if(is_array($package->features))
                                        @foreach($package->features as $feature)
                                            <div class="flex items-center p-3 bg-green-50 rounded-xl">
                                                <svg class="w-5 h-5 text-green-500 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                                <span class="text-gray-700">{{ $feature }}</span>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row gap-4 pt-4">
                                @auth
                                    @if(Auth::user()->isAdmin())
                                        <div class="flex-1 bg-gradient-to-r from-gray-500 to-gray-600 text-white font-bold py-4 px-6 rounded-xl text-center">
                                            Mode Admin
                                        </div>
                                    @else
                                        @php
                                            $hasUnpaidOrder = Auth::user()->orders()
                                                ->whereIn('payment_status', ['unpaid', 'pending'])
                                                ->exists();
                                        @endphp

                                        @if($hasUnpaidOrder)
                                            <div class="flex-1 bg-gradient-to-r from-gray-400 to-gray-500 text-white font-bold py-4 px-6 rounded-xl text-center cursor-not-allowed">
                                                Selesaikan Pembayaran Terlebih Dahulu
                                            </div>
                                        @else
                                            <a href="{{ route('orders.create', $package) }}"
                                               class="flex-1 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-bold py-4 px-6 rounded-xl transition duration-300 text-center shadow-lg hover:shadow-xl">
                                                Pesan Sekarang
                                            </a>
                                        @endif
                                    @endif
                                @else
                                    <a href="{{ route('login') }}"
                                       class="flex-1 bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-bold py-4 px-6 rounded-xl transition duration-300 text-center shadow-lg hover:shadow-xl">
                                        Login untuk Memesan
                                    </a>
                                @endauth

                                <a href="{{ route('packages.index') }}"
                                   class="flex-1 border-2 border-gray-300 hover:border-pink-300 text-gray-700 hover:text-pink-600 font-bold py-4 px-6 rounded-xl transition duration-300 text-center">
                                    Kembali ke Paket
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="mt-12 bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100">
                <div class="p-8">
                    <!-- Reviews Header -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
                        <div>
                            <h3 class="font-playfair text-2xl font-bold text-gray-900 mb-2">Ulasan Pelanggan</h3>
                            <p class="text-gray-600">Pengalaman nyata dari pelanggan kami</p>
                        </div>

                        @auth
                            @if(!Auth::user()->isAdmin())
                                @php
                                    $hasPaidOrder = Auth::user()->orders()
                                        ->where('package_id', $package->id)
                                        ->where('payment_status', 'paid')
                                        ->exists();
                                    $hasReviewed = Auth::user()->reviews()
                                        ->where('package_id', $package->id)
                                        ->exists();
                                @endphp

                                @if($hasPaidOrder && !$hasReviewed)
                                    <button onclick="showReviewForm()"
                                            class="bg-gradient-to-r from-green-500 to-teal-500 hover:from-green-600 hover:to-teal-600 text-white font-bold py-3 px-6 rounded-xl transition duration-300 shadow-lg hover:shadow-xl">
                                        ✨ Beri Ulasan
                                    </button>
                                @elseif($hasPaidOrder && $hasReviewed)
                                    <div class="bg-green-100 text-green-700 px-4 py-2 rounded-xl font-semibold">
                                        ✅ Anda sudah memberikan ulasan
                                    </div>
                                @else
                                    <div class="bg-gray-100 text-gray-600 px-4 py-2 rounded-xl">
                                        Pesan dan lunasi untuk memberikan ulasan
                                    </div>
                                @endif
                            @endif
                        @endauth
                    </div>

                    <!-- Review Form -->
                    @auth
                        @if(!Auth::user()->isAdmin())
                            @php
                                $hasPaidOrder = Auth::user()->orders()
                                    ->where('package_id', $package->id)
                                    ->where('payment_status', 'paid')
                                    ->exists();
                                $hasReviewed = Auth::user()->reviews()
                                    ->where('package_id', $package->id)
                                    ->exists();
                            @endphp

                            @if($hasPaidOrder && !$hasReviewed)
                                <div id="reviewForm" class="bg-gradient-to-br from-gray-50 to-white p-6 rounded-2xl border border-gray-200 mb-8 hidden">
                                    <h4 class="text-xl font-bold text-gray-900 mb-4">Tulis Ulasan Anda</h4>
                                    <form action="{{ route('reviews.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="package_id" value="{{ $package->id }}">

                                        <!-- Rating -->
                                        <div class="mb-6">
                                            <label class="block text-sm font-medium text-gray-700 mb-3">Rating</label>
                                            <div class="flex space-x-2">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <button type="button"
                                                            onclick="setRating({{ $i }})"
                                                            class="text-3xl transition-transform duration-200 hover:scale-110">
                                                        <span id="star-{{ $i }}" class="text-gray-300 hover:text-yellow-400">★</span>
                                                    </button>
                                                @endfor
                                            </div>
                                            <input type="hidden" name="rating" id="ratingInput" value="0" required>
                                            @error('rating')
                                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Comment -->
                                        <div class="mb-6">
                                            <label for="comment" class="block text-sm font-medium text-gray-700 mb-3">Komentar</label>
                                            <textarea name="comment"
                                                      id="comment"
                                                      rows="4"
                                                      class="w-full border-gray-300 rounded-xl shadow-sm focus:border-pink-500 focus:ring-pink-500 p-4 border"
                                                      placeholder="Bagaimana pengalaman Anda menggunakan paket ini? Ceritakan hal-hal yang Anda sukai..."
                                                      required></textarea>
                                            @error('comment')
                                                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Form Actions -->
                                        <div class="flex justify-end space-x-4">
                                            <button type="button"
                                                    onclick="hideReviewForm()"
                                                    class="border-2 border-gray-300 hover:border-gray-400 text-gray-700 font-bold py-3 px-6 rounded-xl transition duration-300">
                                                Batal
                                            </button>
                                            <button type="submit"
                                                    class="bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-bold py-3 px-6 rounded-xl transition duration-300 shadow-lg hover:shadow-xl">
                                                Kirim Ulasan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        @endif
                    @endauth

                    <!-- Reviews List -->
                    @if($reviews->where('is_visible', true)->count() > 0)
                        <div class="space-y-6">
                            @foreach($reviews->where('is_visible', true) as $review)
                                <div class="bg-gray-50 p-6 rounded-2xl border border-gray-200">
                                    <div class="flex justify-between items-start mb-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex items-center">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $review->rating)
                                                        <span class="text-yellow-400 text-lg">★</span>
                                                    @else
                                                        <span class="text-gray-300 text-lg">★</span>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span class="font-semibold text-gray-900">{{ $review->user->name }}</span>
                                        </div>

                                        <!-- Admin Controls -->
                                        @auth
                                            @if(Auth::user()->isAdmin())
                                                <div class="flex space-x-2">
                                                    <form action="{{ route('admin.reviews.hide', $review) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                                class="text-red-600 hover:text-red-800 text-sm bg-red-100 hover:bg-red-200 py-2 px-3 rounded-lg transition duration-200">
                                                            Sembunyikan
                                                        </button>
                                                    </form>
                                                    <span class="text-xs px-3 py-2 rounded-full bg-green-100 text-green-700 font-medium">
                                                        Tampil
                                                    </span>
                                                </div>
                                            @endif
                                        @endauth
                                    </div>
                                    <p class="text-gray-700 leading-relaxed mb-3">{{ $review->comment }}</p>
                                    <span class="text-sm text-gray-500">{{ $review->created_at->format('d M Y H:i') }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Ulasan</h4>
                            <p class="text-gray-600">Jadilah yang pertama memberikan ulasan untuk paket ini</p>
                        </div>
                    @endif

                    <!-- Hidden Reviews (Admin Only) -->
                    @auth
                        @if(Auth::user()->isAdmin() && $reviews->where('is_visible', false)->count() > 0)
                            <div class="mt-12 pt-8 border-t border-gray-200">
                                <h4 class="text-lg font-bold text-gray-500 mb-6">💬 Komentar yang Disembunyikan</h4>
                                <div class="space-y-6 opacity-75">
                                    @foreach($reviews->where('is_visible', false) as $review)
                                        <div class="bg-red-50 p-6 rounded-2xl border border-red-200">
                                            <div class="flex justify-between items-start mb-4">
                                                <div class="flex items-center space-x-3">
                                                    <div class="flex items-center">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($i <= $review->rating)
                                                                <span class="text-yellow-400 text-lg">★</span>
                                                            @else
                                                                <span class="text-gray-300 text-lg">★</span>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                    <span class="font-semibold text-gray-900">{{ $review->user->name }}</span>
                                                </div>

                                                <div class="flex space-x-2">
                                                    <form action="{{ route('admin.reviews.show', $review) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                                class="text-green-600 hover:text-green-800 text-sm bg-green-100 hover:bg-green-200 py-2 px-3 rounded-lg transition duration-200">
                                                            Tampilkan
                                                        </button>
                                                    </form>
                                                    <span class="text-xs px-3 py-2 rounded-full bg-red-100 text-red-700 font-medium">
                                                        Disembunyikan
                                                    </span>
                                                </div>
                                            </div>
                                            <p class="text-gray-700 leading-relaxed mb-3">{{ $review->comment }}</p>
                                            <span class="text-sm text-gray-500">{{ $review->created_at->format('d M Y H:i') }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <script>
        function showReviewForm() {
            document.getElementById('reviewForm').classList.remove('hidden');
            document.getElementById('reviewForm').scrollIntoView({ behavior: 'smooth' });
        }

        function hideReviewForm() {
            document.getElementById('reviewForm').classList.add('hidden');
        }

        function setRating(rating) {
            // Update stars visual
            for (let i = 1; i <= 5; i++) {
                const star = document.getElementById('star-' + i);
                if (i <= rating) {
                    star.classList.remove('text-gray-300');
                    star.classList.add('text-yellow-400');
                } else {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                }
            }
            // Update hidden input
            document.getElementById('ratingInput').value = rating;
        }
    </script>
</x-app-layout>
