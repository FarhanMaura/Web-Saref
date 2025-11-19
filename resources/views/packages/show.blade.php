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
                                                    <button onclick="showReplyForm({{ $review->id }})"
                                                            class="bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white text-sm font-medium py-2 px-4 rounded-lg transition duration-200 shadow hover:shadow-md">
                                                        💬 Balas
                                                    </button>
                                                    <form action="{{ route('admin.reviews.hide', $review) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                                class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white text-sm font-medium py-2 px-4 rounded-lg transition duration-200 shadow hover:shadow-md">
                                                            🙈 Sembunyikan
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

                                    <!-- Reply Form for Admin -->
                                    @auth
                                        @if(Auth::user()->isAdmin())
                                            <div id="replyForm-{{ $review->id }}" class="mt-4 p-4 bg-blue-50 rounded-xl border border-blue-200 hidden">
                                                <h5 class="font-semibold text-blue-800 mb-3">💌 Balas Komentar:</h5>
                                                <form action="{{ route('admin.review-replies.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="review_id" value="{{ $review->id }}">
                                                    <div class="mb-3">
                                                        <textarea name="reply_message"
                                                                  rows="3"
                                                                  class="w-full border-blue-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500 p-3"
                                                                  placeholder="Tulis balasan Anda untuk komentar ini..."
                                                                  required></textarea>
                                                    </div>
                                                    <div class="flex justify-end space-x-2">
                                                        <button type="button"
                                                                onclick="hideReplyForm({{ $review->id }})"
                                                                class="border-2 border-gray-300 hover:border-gray-400 text-gray-700 font-medium py-2 px-4 rounded-lg transition duration-200">
                                                            Batal
                                                        </button>
                                                        <button type="submit"
                                                                class="bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white font-medium py-2 px-4 rounded-lg transition duration-200 shadow hover:shadow-md">
                                                            Kirim Balasan
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        @endif
                                    @endauth

                                    <!-- Display Replies -->
                                    @if($review->visibleReplies->count() > 0)
                                        <div class="mt-4 ml-8 space-y-4">
                                            @foreach($review->visibleReplies as $reply)
                                                <div class="bg-white p-4 rounded-xl border-l-4 border-blue-500 shadow-sm">
                                                    <div class="flex justify-between items-start">
                                                        <div class="flex items-center space-x-2">
                                                            <span class="font-semibold text-blue-600">{{ $reply->user->name }}</span>
                                                            @if($reply->user->isAdmin())
                                                                <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full font-medium">Admin</span>
                                                            @endif
                                                            <span class="text-xs text-gray-500">{{ $reply->created_at->format('d M Y H:i') }}</span>
                                                        </div>

                                                        <!-- Admin Reply Controls -->
                                                        @auth
                                                            @if(Auth::user()->isAdmin())
                                                                <div class="flex space-x-1">
                                                                    <button onclick="editReply({{ $reply->id }}, '{{ addslashes($reply->reply_message) }}')"
                                                                            class="text-yellow-600 hover:text-yellow-800 text-xs bg-yellow-100 hover:bg-yellow-200 py-1 px-2 rounded transition duration-200">
                                                                        ✏️ Edit
                                                                    </button>
                                                                    <form action="{{ route('admin.review-replies.hide', $reply) }}" method="POST" class="inline">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <button type="submit"
                                                                                class="text-red-600 hover:text-red-800 text-xs bg-red-100 hover:bg-red-200 py-1 px-2 rounded transition duration-200">
                                                                            🙈 Hide
                                                                        </button>
                                                                    </form>
                                                                    <form action="{{ route('admin.review-replies.destroy', $reply) }}" method="POST" class="inline" onsubmit="return confirm('Hapus balasan ini?')">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                                class="text-red-600 hover:text-red-800 text-xs bg-red-100 hover:bg-red-200 py-1 px-2 rounded transition duration-200">
                                                                            🗑️ Hapus
                                                                        </button>
                                                                    </form>
                                                                </div>
                                                            @endif
                                                        @endauth
                                                    </div>
                                                    <p class="text-gray-700 mt-2" id="reply-text-{{ $reply->id }}">{{ $reply->reply_message }}</p>

                                                    <!-- Edit Reply Form (Hidden by Default) -->
                                                    @auth
                                                        @if(Auth::user()->isAdmin())
                                                            <div id="edit-reply-form-{{ $reply->id }}" class="mt-3 hidden">
                                                                <form action="{{ route('admin.review-replies.update', $reply) }}" method="POST">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <textarea name="reply_message"
                                                                              rows="2"
                                                                              class="w-full border-yellow-300 rounded-lg shadow-sm focus:border-yellow-500 focus:ring-yellow-500 p-2"
                                                                              required>{{ $reply->reply_message }}</textarea>
                                                                    <div class="flex justify-end space-x-2 mt-2">
                                                                        <button type="button"
                                                                                onclick="cancelEdit({{ $reply->id }}, '{{ addslashes($reply->reply_message) }}')"
                                                                                class="border border-gray-300 hover:border-gray-400 text-gray-700 text-xs py-1 px-2 rounded transition duration-200">
                                                                            Batal
                                                                        </button>
                                                                        <button type="submit"
                                                                                class="bg-yellow-500 hover:bg-yellow-600 text-white text-xs py-1 px-2 rounded transition duration-200">
                                                                            Update
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        @endif
                                                    @endauth
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
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
                                                    <button onclick="showReplyForm({{ $review->id }})"
                                                            class="bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-600 hover:to-cyan-600 text-white text-sm font-medium py-2 px-4 rounded-lg transition duration-200 shadow hover:shadow-md">
                                                        💬 Balas
                                                    </button>
                                                    <form action="{{ route('admin.reviews.show', $review) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                                class="bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white text-sm font-medium py-2 px-4 rounded-lg transition duration-200 shadow hover:shadow-md">
                                                            👁️ Tampilkan
                                                        </button>
                                                    </form>
                                                    <span class="text-xs px-3 py-2 rounded-full bg-red-100 text-red-700 font-medium">
                                                        Disembunyikan
                                                    </span>
                                                </div>
                                            </div>
                                            <p class="text-gray-700 leading-relaxed mb-3">{{ $review->comment }}</p>
                                            <span class="text-sm text-gray-500">{{ $review->created_at->format('d M Y H:i') }}</span>

                                            <!-- Display Hidden Replies -->
                                            @if($review->replies->count() > 0)
                                                <div class="mt-4 ml-8 space-y-4">
                                                    @foreach($review->replies as $reply)
                                                        <div class="bg-gray-100 p-4 rounded-xl border-l-4 border-gray-400 opacity-75">
                                                            <div class="flex justify-between items-start">
                                                                <div class="flex items-center space-x-2">
                                                                    <span class="font-semibold text-gray-600">{{ $reply->user->name }}</span>
                                                                    @if($reply->user->isAdmin())
                                                                        <span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded-full font-medium">Admin</span>
                                                                    @endif
                                                                    <span class="text-xs text-gray-500">{{ $reply->created_at->format('d M Y H:i') }}</span>
                                                                    @if(!$reply->is_visible)
                                                                        <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded-full font-medium">Hidden</span>
                                                                    @endif
                                                                </div>

                                                                @auth
                                                                    @if(Auth::user()->isAdmin())
                                                                        <div class="flex space-x-1">
                                                                            @if(!$reply->is_visible)
                                                                                <form action="{{ route('admin.review-replies.show', $reply) }}" method="POST" class="inline">
                                                                                    @csrf
                                                                                    @method('PATCH')
                                                                                    <button type="submit"
                                                                                            class="text-green-600 hover:text-green-800 text-xs bg-green-100 hover:bg-green-200 py-1 px-2 rounded transition duration-200">
                                                                                        👁️ Show
                                                                                    </button>
                                                                                </form>
                                                                            @else
                                                                                <form action="{{ route('admin.review-replies.hide', $reply) }}" method="POST" class="inline">
                                                                                    @csrf
                                                                                    @method('PATCH')
                                                                                    <button type="submit"
                                                                                            class="text-red-600 hover:text-red-800 text-xs bg-red-100 hover:bg-red-200 py-1 px-2 rounded transition duration-200">
                                                                                        🙈 Hide
                                                                                    </button>
                                                                                </form>
                                                                            @endif
                                                                            <form action="{{ route('admin.review-replies.destroy', $reply) }}" method="POST" class="inline" onsubmit="return confirm('Hapus balasan ini?')">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit"
                                                                                        class="text-red-600 hover:text-red-800 text-xs bg-red-100 hover:bg-red-200 py-1 px-2 rounded transition duration-200">
                                                                                    🗑️ Hapus
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    @endif
                                                                @endauth
                                                            </div>
                                                            <p class="text-gray-600 mt-2">{{ $reply->reply_message }}</p>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
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

        // Reply Functions
        function showReplyForm(reviewId) {
            document.getElementById('replyForm-' + reviewId).classList.remove('hidden');
            document.getElementById('replyForm-' + reviewId).scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        function hideReplyForm(reviewId) {
            document.getElementById('replyForm-' + reviewId).classList.add('hidden');
        }

        function editReply(replyId, originalMessage) {
            // Hide the reply text
            document.getElementById('reply-text-' + replyId).classList.add('hidden');
            // Show the edit form
            document.getElementById('edit-reply-form-' + replyId).classList.remove('hidden');
        }

        function cancelEdit(replyId, originalMessage) {
            // Show the reply text
            document.getElementById('reply-text-' + replyId).classList.remove('hidden');
            // Hide the edit form
            document.getElementById('edit-reply-form-' + replyId).classList.add('hidden');
            // Reset the textarea value
            const textarea = document.querySelector('#edit-reply-form-' + replyId + ' textarea');
            textarea.value = originalMessage;
        }
    </script>
</x-app-layout>
