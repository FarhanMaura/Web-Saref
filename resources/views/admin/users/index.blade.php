<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen User') }}
            </h2>
            <div class="text-sm text-gray-600">
                Total: {{ $users->count() }} Users
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if($users->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            User
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Email
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Role
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tanggal Daftar
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total Pesanan
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($users as $user)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10 bg-pink-500 rounded-full flex items-center justify-center">
                                                        <span class="text-white font-bold text-sm">
                                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                                        </span>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $user->name }}
                                                            @if($user->id === auth()->id())
                                                                <span class="ml-2 text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">Anda</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->getRoleBadgeColor() }}">
                                                    {{ $user->getRoleDisplayName() }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ $user->created_at->format('d M Y') }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $user->created_at->format('H:i') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900 text-center">
                                                    {{ $user->orders->count() }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                @if(auth()->user()->isAdmin())
                                                    <div class="flex space-x-2">
                                                        <!-- Role Dropdown -->
                                                        <div class="relative">
                                                            <select
                                                                onchange="updateRole({{ $user->id }}, this.value)"
                                                                class="text-xs border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 {{ $user->isMainAdmin() ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                                                                {{ $user->isMainAdmin() ? 'disabled' : '' }}
                                                            >
                                                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                                                @if(auth()->user()->isMainAdmin())
                                                                    <option value="main_admin" {{ $user->role === 'main_admin' ? 'selected' : '' }}>Main Admin</option>
                                                                @endif
                                                            </select>
                                                        </div>

                                                        <!-- Delete Button -->
                                                        @if((!$user->isMainAdmin() || auth()->user()->isMainAdmin()) && $user->id !== auth()->id())
                                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus user {{ $user->name }}?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                        class="text-red-600 hover:text-red-900 bg-red-100 hover:bg-red-200 py-1 px-3 rounded text-xs">
                                                                    Hapus
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                @else
                                                    <span class="text-gray-400 text-xs">Hanya Admin</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500 text-lg">Belum ada user terdaftar.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Info Box -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h4 class="font-semibold text-blue-800 mb-2">Informasi Role & Hak Akses:</h4>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-blue-700">
                    <div class="flex items-center">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800 mr-2">Main Admin</span>
                        <span>Full access, dapat mengelola semua user termasuk promote ke Main Admin</span>
                    </div>
                    <div class="flex items-center">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800 mr-2">Admin</span>
                        <span>Dapat mengelola user (promote ke Admin), pesanan & paket</span>
                    </div>
                    <div class="flex items-center">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800 mr-2">User</span>
                        <span>Hanya dapat memesan & memberikan review</span>
                    </div>
                </div>
                <div class="mt-3 text-xs text-blue-600">
                    <strong>Note:</strong> Admin biasa dapat promote user menjadi Admin, tetapi hanya Main Admin yang dapat promote menjadi Main Admin.
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateRole(userId, role) {
            if (confirm('Apakah Anda yakin ingin mengubah role user ini?')) {
                fetch(`/admin/users/${userId}/role`, {
                    method: 'PATCH',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ role: role })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        window.location.reload();
                    } else {
                        alert(data.message || 'Terjadi kesalahan');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengupdate role');
                });
            } else {
                // Reset select to original value
                window.location.reload();
            }
        }
    </script>
</x-app-layout>
