<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-playfair text-2xl font-bold text-gray-900">
                {{ __('Manajemen User') }}
            </h2>
            <div class="bg-gradient-to-r from-pink-500 to-purple-600 text-white px-4 py-2 rounded-xl font-semibold">
                Total: {{ $users->count() }} Users
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Alert Messages -->
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

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm mb-6">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <!-- Main Content Card -->
            <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100">
                <div class="p-8">
                    @if($users->count() > 0)
                        <div class="overflow-x-auto rounded-xl border border-gray-200">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            User
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Kontak
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Role
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Tanggal Daftar
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Total Pesanan
                                        </th>
                                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($users as $user)
                                        <tr class="hover:bg-pink-50 transition duration-150 group">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center space-x-3">
                                                    <div class="flex-shrink-0">
                                                        <div class="bg-gradient-to-r from-pink-500 to-purple-600 h-12 w-12 rounded-full flex items-center justify-center shadow-lg">
                                                            <span class="text-white font-bold text-sm">
                                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="text-sm font-semibold text-gray-900 group-hover:text-pink-600">
                                                            {{ $user->name }}
                                                            @if($user->id === auth()->id())
                                                                <span class="ml-2 text-xs bg-gradient-to-r from-green-500 to-green-600 text-white px-2 py-1 rounded-full font-medium">Anda</span>
                                                            @endif
                                                        </div>
                                                        <div class="text-xs text-gray-500">
                                                            ID: #{{ $user->id }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $user->email }}</div>
                                                <div class="text-sm text-blue-600 font-medium mt-1">
                                                    📱 {{ $user->getFormattedPhone() }}
                                                </div>
                                                @if($user->email_verified_at)
                                                    <div class="text-xs text-green-600 flex items-center mt-1">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                        Email Verified
                                                    </div>
                                                @else
                                                    <div class="text-xs text-yellow-600 flex items-center mt-1">
                                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        Email Unverified
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @php
                                                    $roleColors = [
                                                        'main_admin' => 'bg-gradient-to-r from-purple-500 to-purple-600 text-white',
                                                        'admin' => 'bg-gradient-to-r from-blue-500 to-blue-600 text-white',
                                                        'user' => 'bg-gradient-to-r from-gray-500 to-gray-600 text-white'
                                                    ];
                                                    $roleIcons = [
                                                        'main_admin' => '👑',
                                                        'admin' => '⚡',
                                                        'user' => '👤'
                                                    ];
                                                @endphp
                                                <span class="px-3 py-2 inline-flex items-center text-xs font-semibold rounded-full {{ $roleColors[$user->role] ?? 'bg-gray-100 text-gray-800' }} shadow-sm">
                                                    {{ $roleIcons[$user->role] ?? '👤' }}
                                                    <span class="ml-1">{{ $user->getRoleDisplayName() }}</span>
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $user->created_at->format('d M Y') }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    {{ $user->created_at->format('H:i') }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-center">
                                                    <div class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-600 to-purple-600">
                                                        {{ $user->orders->count() }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">pesanan</div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if(auth()->user()->isAdmin())
                                                    <div class="flex items-center space-x-2">
                                                        <!-- Role Dropdown -->
                                                        <div class="relative">
                                                            <select
                                                                onchange="updateRole({{ $user->id }}, this.value)"
                                                                class="text-sm border-2 border-gray-200 rounded-xl shadow-sm focus:border-pink-500 focus:ring-pink-500 px-3 py-2 transition duration-200 {{ $user->isMainAdmin() ? 'bg-gray-100 cursor-not-allowed opacity-75' : 'bg-white hover:border-pink-300' }}"
                                                                {{ $user->isMainAdmin() ? 'disabled' : '' }}
                                                            >
                                                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>👤 User</option>
                                                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>⚡ Admin</option>
                                                                @if(auth()->user()->isMainAdmin())
                                                                    <option value="main_admin" {{ $user->role === 'main_admin' ? 'selected' : '' }}>👑 Main Admin</option>
                                                                @endif
                                                            </select>
                                                        </div>

                                                        <!-- Delete Button -->
                                                        @if((!$user->isMainAdmin() || auth()->user()->isMainAdmin()) && $user->id !== auth()->id())
                                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                                                  onsubmit="return confirmDelete('{{ $user->name }}')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                        class="bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold py-2 px-3 rounded-xl transition duration-300 shadow-lg hover:shadow-xl text-sm">
                                                                    🗑️
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                @else
                                                    <span class="text-gray-400 text-sm">Hanya Admin</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination Info -->
                        <div class="mt-6 flex justify-between items-center">
                            <p class="text-gray-600 text-sm">
                                Menampilkan {{ $users->count() }} users
                            </p>
                        </div>
                    @else
                        <!-- Empty State -->
                        <div class="text-center py-16">
                            <div class="w-32 h-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                            <h3 class="font-playfair text-2xl font-bold text-gray-900 mb-3">Belum Ada User</h3>
                            <p class="text-gray-600 mb-8 max-w-md mx-auto">
                                Saat ini belum ada user yang terdaftar dalam sistem.
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Info Box -->
            <div class="mt-8 bg-gradient-to-r from-blue-50 to-cyan-50 border border-blue-200 rounded-2xl p-6 shadow-sm">
                <div class="flex items-start mb-4">
                    <div class="flex-shrink-0">
                        <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h4 class="font-playfair text-xl font-bold text-gray-900 mb-3">Informasi Role & Hak Akses</h4>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-white p-4 rounded-xl border border-purple-200">
                                <div class="flex items-center mb-2">
                                    <span class="px-3 py-1 inline-flex items-center text-xs font-semibold rounded-full bg-gradient-to-r from-purple-500 to-purple-600 text-white mr-3">
                                        👑 Main Admin
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600">Full access, dapat mengelola semua user termasuk promote ke Main Admin</p>
                            </div>
                            <div class="bg-white p-4 rounded-xl border border-blue-200">
                                <div class="flex items-center mb-2">
                                    <span class="px-3 py-1 inline-flex items-center text-xs font-semibold rounded-full bg-gradient-to-r from-blue-500 to-blue-600 text-white mr-3">
                                        ⚡ Admin
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600">Dapat mengelola user (promote ke Admin), pesanan & paket</p>
                            </div>
                            <div class="bg-white p-4 rounded-xl border border-gray-200">
                                <div class="flex items-center mb-2">
                                    <span class="px-3 py-1 inline-flex items-center text-xs font-semibold rounded-full bg-gradient-to-r from-gray-500 to-gray-600 text-white mr-3">
                                        👤 User
                                    </span>
                                </div>
                                <p class="text-sm text-gray-600">Hanya dapat memesan & memberikan review</p>
                            </div>
                        </div>
                        <div class="mt-4 text-sm text-blue-700 bg-blue-100 p-3 rounded-lg">
                            <strong>Note:</strong> Admin biasa dapat promote user menjadi Admin, tetapi hanya Main Admin yang dapat promote menjadi Main Admin.
                        </div>
                        <div class="mt-3 text-sm text-green-700 bg-green-100 p-3 rounded-lg">
                            <strong>Info Kontak:</strong> Nomor telepon user sekarang ditampilkan untuk memudahkan komunikasi jika ada kendala.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateRole(userId, role) {
            if (confirm('Apakah Anda yakin ingin mengubah role user ini?')) {
                // Show loading state
                const select = event.target;
                const originalValue = select.value;
                select.disabled = true;
                select.classList.add('opacity-50', 'cursor-not-allowed');

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
                        // Show success message
                        const successEvent = new CustomEvent('show-toast', {
                            detail: {
                                message: 'Role berhasil diupdate!',
                                type: 'success'
                            }
                        });
                        window.dispatchEvent(successEvent);

                        // Reload after short delay
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    } else {
                        alert(data.message || 'Terjadi kesalahan');
                        select.value = originalValue;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengupdate role');
                    select.value = originalValue;
                })
                .finally(() => {
                    select.disabled = false;
                    select.classList.remove('opacity-50', 'cursor-not-allowed');
                });
            } else {
                // Reset select to original value
                window.location.reload();
            }
        }

        function confirmDelete(userName) {
            return confirm(`Apakah Anda yakin ingin menghapus user "${userName}"? Tindakan ini tidak dapat dibatalkan.`);
        }

        // Add some interactivity
        document.addEventListener('DOMContentLoaded', function() {
            const selects = document.querySelectorAll('select');

            selects.forEach(select => {
                select.addEventListener('focus', function() {
                    this.classList.add('ring-2', 'ring-pink-200', 'border-pink-500');
                });

                select.addEventListener('blur', function() {
                    this.classList.remove('ring-2', 'ring-pink-200', 'border-pink-500');
                });
            });
        });
    </script>
</x-app-layout>
