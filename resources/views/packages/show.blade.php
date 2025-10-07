<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Paket') }}
        </h2>
    </x-slot>

    @if(session('error'))
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Package Image -->
                        <div>
                            @if($package->image)
                                <img src="{{ asset('storage/' . $package->image) }}" alt="{{ $package->name }}" class="w-full h-64 object-cover rounded-lg">
                            @else
                                <div class="w-full h-64 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-500">No Image</span>
                                </div>
                            @endif
                        </div>

                        <!-- Package Details -->
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $package->name }}</h1>
                            <p class="text-gray-600 mb-6">{{ $package->description }}</p>

                            <div class="mb-6">
                                <span class="text-3xl font-bold text-green-600">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                            </div>

                            <!-- Features -->
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-3">Fitur Paket:</h3>
                                <ul class="list-disc list-inside space-y-2">
                                    @if(is_array($package->features))
                                        @foreach($package->features as $feature)
                                            <li class="text-gray-600">{{ $feature }}</li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex space-x-4">
                                @auth
                                    @if(Auth::user()->isAdmin())
                                        <!-- Admin tidak bisa pesan, tapi bisa edit paket nanti -->
                                        <button disabled class="bg-gray-400 cursor-not-allowed text-white font-bold py-3 px-6 rounded-lg">
                                            Admin Mode
                                        </button>
                                    @else
                                        @php
                                            $hasUnpaidOrder = Auth::user()->orders()
                                                ->whereIn('payment_status', ['unpaid', 'pending'])
                                                ->exists();
                                        @endphp

                                        @if($hasUnpaidOrder)
                                            <button disabled class="bg-gray-400 cursor-not-allowed text-white font-bold py-3 px-6 rounded-lg">
                                                Selesaikan Pembayaran Terlebih Dahulu
                                            </button>
                                        @else
                                            <a href="{{ route('orders.create', $package) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg">
                                                Pesan Sekarang
                                            </a>
                                        @endif
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg">
                                        Login untuk Memesan
                                    </a>
                                @endauth
                                <a href="{{ route('packages.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-3 px-6 rounded-lg">
                                    Kembali
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Reviews Section -->
                    <div class="mt-12">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-2xl font-bold">Ulasan Pelanggan</h3>

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
                                        <button onclick="showReviewForm()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                                            Beri Ulasan
                                        </button>
                                    @elseif($hasPaidOrder && $hasReviewed)
                                        <p class="text-green-600 font-semibold">Anda sudah memberikan ulasan</p>
                                    @else
                                        <p class="text-gray-500">Pesan dan lunasi pembayaran untuk memberikan ulasan</p>
                                    @endif
                                @endif
                            @endauth
                        </div>

                        <!-- Review Form (Hidden by Default) -->
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
                                    <div id="reviewForm" class="bg-gray-50 p-6 rounded-lg mb-6 hidden">
                                        <h4 class="text-lg font-semibold mb-4">Tulis Ulasan Anda</h4>
                                        <form action="{{ route('reviews.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="package_id" value="{{ $package->id }}">

                                            <div class="mb-4">
                                                <label class="block text-sm font-medium text-gray-700 mb-2">Rating</label>
                                                <div class="flex space-x-1">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <button type="button" onclick="setRating({{ $i }})" class="text-2xl">
                                                            <span id="star-{{ $i }}" class="text-gray-300">★</span>
                                                        </button>
                                                    @endfor
                                                </div>
                                                <input type="hidden" name="rating" id="ratingInput" value="0" required>
                                                @error('rating')
                                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="mb-4">
                                                <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">Komentar</label>
                                                <textarea name="comment" id="comment" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Bagaimana pengalaman Anda menggunakan paket ini?" required></textarea>
                                                @error('comment')
                                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="flex justify-end space-x-3">
                                                <button type="button" onclick="hideReviewForm()" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                                    Batal
                                                </button>
                                                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                    Kirim Ulasan
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            @endif
                        @endauth

                        @if($reviews->where('is_visible', true)->count() > 0)
                            <div class="space-y-6">
                                @foreach($reviews->where('is_visible', true) as $review)
                                    <div class="border-b pb-6">
                                        <div class="flex justify-between items-start mb-2">
                                            <div class="flex items-center">
                                                <div class="flex items-center">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $review->rating)
                                                            <span class="text-yellow-400">★</span>
                                                        @else
                                                            <span class="text-gray-300">★</span>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <span class="ml-2 font-semibold">{{ $review->user->name }}</span>
                                            </div>

                                            <!-- Admin Controls -->
                                            @auth
                                                @if(Auth::user()->isAdmin())
                                                    <div class="flex space-x-2">
                                                        <form action="{{ route('admin.reviews.hide', $review) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm bg-red-100 hover:bg-red-200 py-1 px-2 rounded">
                                                                Hide
                                                            </button>
                                                        </form>
                                                        <span class="text-xs px-2 py-1 rounded-full bg-green-100 text-green-800">
                                                            Visible
                                                        </span>
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>
                                        <p class="text-gray-600">{{ $review->comment }}</p>
                                        <span class="text-sm text-gray-400">{{ $review->created_at->format('d M Y') }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-8">Belum ada ulasan untuk paket ini.</p>
                        @endif

                        <!-- Hidden Reviews (Only visible to admin) -->
                        @auth
                            @if(Auth::user()->isAdmin() && $reviews->where('is_visible', false)->count() > 0)
                                <div class="mt-8">
                                    <h4 class="text-lg font-semibold mb-4 text-gray-500">Komentar yang Disembunyikan</h4>
                                    <div class="space-y-6 opacity-75">
                                        @foreach($reviews->where('is_visible', false) as $review)
                                            <div class="border-b pb-6 border-gray-300">
                                                <div class="flex justify-between items-start mb-2">
                                                    <div class="flex items-center">
                                                        <div class="flex items-center">
                                                            @for($i = 1; $i <= 5; $i++)
                                                                @if($i <= $review->rating)
                                                                    <span class="text-yellow-400">★</span>
                                                                @else
                                                                    <span class="text-gray-300">★</span>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        <span class="ml-2 font-semibold">{{ $review->user->name }}</span>
                                                    </div>

                                                    <div class="flex space-x-2">
                                                        <form action="{{ route('admin.reviews.show', $review) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit" class="text-green-600 hover:text-green-900 text-sm bg-green-100 hover:bg-green-200 py-1 px-2 rounded">
                                                                Show
                                                            </button>
                                                        </form>
                                                        <span class="text-xs px-2 py-1 rounded-full bg-red-100 text-red-800">
                                                            Hidden
                                                        </span>
                                                    </div>
                                                </div>
                                                <p class="text-gray-600">{{ $review->comment }}</p>
                                                <span class="text-sm text-gray-400">{{ $review->created_at->format('d M Y') }}</span>
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
    </div>

    <script>
        function showReviewForm() {
            document.getElementById('reviewForm').classList.remove('hidden');
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
