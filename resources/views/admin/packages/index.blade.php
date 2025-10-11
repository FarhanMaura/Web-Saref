<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-playfair text-2xl font-bold text-gray-900">
                📦 Manajemen Paket
            </h2>
            <a href="{{ route('admin.packages.create') }}"
               class="bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-bold py-3 px-6 rounded-xl transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Paket
                </span>
            </a>
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

            <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100">
                <div class="p-6">
                    @if($packages->count() > 0)
                        <!-- Header Stats -->
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6 p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">{{ $packages->count() }}</div>
                                <div class="text-sm text-gray-600">Total Paket</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-600">{{ $packages->where('is_active', true)->count() }}</div>
                                <div class="text-sm text-gray-600">Aktif</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-red-600">{{ $packages->where('is_active', false)->count() }}</div>
                                <div class="text-sm text-gray-600">Nonaktif</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-600">{{ $packages->where('is_popular', true)->count() }}</div>
                                <div class="text-sm text-gray-600">Popular</div>
                            </div>
                        </div>

                        <div class="overflow-x-auto rounded-xl border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Gambar
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Detail Paket
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Harga
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($packages as $package)
                                        <tr class="hover:bg-pink-50 transition duration-150 group">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($package->image)
                                                    <div class="relative">
                                                        <img src="{{ Storage::disk('public')->exists($package->image) ? asset('storage/' . $package->image) : asset('images/default-package.jpg') }}"
                                                             alt="{{ $package->name }}"
                                                             class="h-16 w-16 object-cover rounded-xl shadow-md group-hover:shadow-lg transition duration-300">
                                                        @if($package->is_popular)
                                                            <div class="absolute -top-1 -right-1">
                                                                <span class="bg-gradient-to-r from-yellow-400 to-yellow-500 text-white px-2 py-1 rounded-full text-xs font-bold shadow-lg">
                                                                    🔥
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                @else
                                                    <div class="h-16 w-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl flex items-center justify-center shadow-md group-hover:shadow-lg transition duration-300">
                                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm font-semibold text-gray-900 group-hover:text-pink-600">
                                                    {{ $package->name }}
                                                </div>
                                                <div class="text-sm text-gray-500 mt-1 max-w-xs">
                                                    {{ Str::limit($package->description, 60) }}
                                                </div>
                                                <div class="flex items-center mt-2 text-xs text-gray-400">
                                                    <span class="flex items-center mr-3">
                                                        <svg class="w-4 h-4 mr-1 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                        </svg>
                                                        {{ number_format($package->average_rating, 1) }} ({{ $package->reviews->count() }})
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-600 to-purple-600">
                                                    Rp {{ number_format($package->price, 0, ',', '.') }}
                                                </div>
                                                @if($package->original_price && $package->original_price > $package->price)
                                                    <div class="text-sm text-gray-400 line-through">
                                                        Rp {{ number_format($package->original_price, 0, ',', '.') }}
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex flex-col space-y-2">
                                                    @if($package->is_active)
                                                        <span class="px-3 py-1 inline-flex items-center text-xs font-semibold rounded-full bg-green-100 text-green-800 border border-green-200">
                                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                            </svg>
                                                            Active
                                                        </span>
                                                    @else
                                                        <span class="px-3 py-1 inline-flex items-center text-xs font-semibold rounded-full bg-red-100 text-red-800 border border-red-200">
                                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                            </svg>
                                                            Inactive
                                                        </span>
                                                    @endif

                                                    @if($package->is_popular)
                                                        <span class="px-3 py-1 inline-flex items-center text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                            <span class="mr-1">🔥</span>
                                                            Popular
                                                        </span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center space-x-2">
                                                    <a href="{{ route('packages.show', $package) }}"
                                                       target="_blank"
                                                       class="text-blue-600 hover:text-blue-800 bg-blue-100 hover:bg-blue-200 py-2 px-3 rounded-lg text-xs font-semibold transition duration-200 flex items-center"
                                                       title="Lihat Preview">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                        </svg>
                                                        Lihat
                                                    </a>
                                                    <a href="{{ route('admin.packages.edit', $package) }}"
                                                       class="text-green-600 hover:text-green-800 bg-green-100 hover:bg-green-200 py-2 px-3 rounded-lg text-xs font-semibold transition duration-200 flex items-center"
                                                       title="Edit Paket">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                        </svg>
                                                        Edit
                                                    </a>
                                                    <form action="{{ route('admin.packages.destroy', $package) }}" method="POST"
                                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket {{ $package->name }}?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                                class="text-red-600 hover:text-red-800 bg-red-100 hover:bg-red-200 py-2 px-3 rounded-lg text-xs font-semibold transition duration-200 flex items-center"
                                                                title="Hapus Paket">
                                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                            </svg>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination Info -->
                        <div class="mt-6 flex justify-between items-center">
                            <p class="text-gray-600 text-sm">
                                Menampilkan {{ $packages->count() }} paket
                            </p>
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-16">
                            <div class="w-32 h-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                            <h3 class="font-playfair text-2xl font-bold text-gray-900 mb-3">Belum Ada Paket</h3>
                            <p class="text-gray-600 mb-8 max-w-md mx-auto">
                                Mulai dengan membuat paket pertama untuk menawarkan layanan photography Anda.
                            </p>
                            <a href="{{ route('admin.packages.create') }}"
                               class="inline-flex items-center bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 text-white font-bold py-4 px-8 rounded-xl transition duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Tambah Paket Pertama
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
