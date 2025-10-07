<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Paket') }} - {{ $package->name }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.packages.update', $package) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="space-y-6">
                            <!-- Current Image Preview -->
                            @if($package->image)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Saat Ini</label>
                                    <img src="{{ asset('storage/' . $package->image) }}"
                                         alt="{{ $package->name }}"
                                         class="h-32 w-32 object-cover rounded-lg border">
                                    <p class="text-sm text-gray-500 mt-1">{{ $package->image }}</p>
                                </div>
                            @endif

                            <!-- Package Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama Paket</label>
                                <input type="text" name="name" id="name"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       value="{{ old('name', $package->name) }}"
                                       required>
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea name="description" id="description" rows="3"
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                          required>{{ old('description', $package->description) }}</textarea>
                                @error('description')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                                <input type="number" name="price" id="price"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       value="{{ old('price', $package->price) }}"
                                       min="0"
                                       required>
                                @error('price')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Features -->
                            <div>
                                <label for="features" class="block text-sm font-medium text-gray-700">
                                    Fitur Paket (satu fitur per baris)
                                </label>
                                <textarea name="features" id="features" rows="5"
                                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                          placeholder="Contoh:&#10;2 jam sesi foto&#10;50 foto edited&#10;1 lokasi shooting"
                                          required>{{ old('features', is_array($package->features) ? implode("\n", $package->features) : $package->features) }}</textarea>
                                @error('features')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Image -->
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700">
                                    {{ $package->image ? 'Ganti Gambar Paket' : 'Gambar Paket (Optional)' }}
                                </label>
                                <input type="file" name="image" id="image"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                       accept="image/*">
                                @error('image')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Active Status -->
                            <div class="flex items-center">
                                <input type="checkbox" name="is_active" id="is_active"
                                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                                       {{ $package->is_active ? 'checked' : '' }}>
                                <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                    Aktifkan paket (paket akan ditampilkan ke user)
                                </label>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex justify-end space-x-4 pt-6">
                                <a href="{{ route('admin.packages.index') }}"
                                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                                    Batal
                                </a>
                                <button type="submit"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                                    Update Paket
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
