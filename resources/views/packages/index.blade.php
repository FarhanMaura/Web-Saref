<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Paket Wedding & Event Content Creator') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($packages as $package)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            @if($package->image)
                                <img src="{{ Storage::disk('public')->exists($package->image) ? asset('storage/' . $package->image) : asset('images/default-package.jpg') }}"
                                     alt="{{ $package->name }}"
                                     class="w-full h-48 object-cover mb-4 rounded">
                            @else
                                <div class="w-full h-48 bg-gray-200 mb-4 rounded flex items-center justify-center">
                                    <span class="text-gray-500">No Image</span>
                                </div>
                            @endif

                            <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $package->name }}</h3>
                            <p class="text-gray-600 mb-4">{{ Str::limit($package->description, 100) }}</p>

                            <div class="mb-4">
                                <span class="text-2xl font-bold text-green-600">Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <span class="text-yellow-400">★</span>
                                    <span class="ml-1 text-gray-600">{{ number_format($package->average_rating, 1) }} ({{ $package->reviews->count() }})</span>
                                </div>
                                <a href="{{ route('packages.show', $package) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($packages->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center text-gray-500">
                        Belum ada paket yang tersedia.
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
