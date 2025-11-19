<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Wedding Creator</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        .font-playfair { font-family: 'Playfair Display', serif; }
        .font-inter { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="font-inter bg-gradient-to-br from-pink-50 via-purple-50 to-blue-50 min-h-screen">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Header -->
            <div>
                <div class="text-center">
                    <a href="{{ url('/') }}" class="inline-block">
                        <span class="font-playfair text-3xl font-bold text-pink-600">💍 WeddingCreator</span>
                    </a>
                    <h2 class="mt-6 text-3xl font-bold text-gray-900">Daftar Akun Baru</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Atau
                        <a href="{{ route('login') }}" class="font-medium text-pink-600 hover:text-pink-500">
                            masuk ke akun yang sudah ada
                        </a>
                    </p>
                </div>
            </div>

            <!-- Register Form -->
            <form class="mt-8 space-y-6 bg-white p-8 rounded-2xl shadow-lg" method="POST" action="{{ route('register') }}">
                @csrf

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input id="name" name="name" type="text" required
                               class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500 transition duration-300"
                               placeholder="Masukkan nama lengkap"
                               value="{{ old('name') }}">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" name="email" type="email" required
                               class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500 transition duration-300"
                               placeholder="email@example.com"
                               value="{{ old('email') }}">
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input id="phone" name="phone" type="tel"
                               class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500 transition duration-300"
                               placeholder="Contoh: +6281234567890 atau 081234567890"
                               value="{{ old('phone') }}">
                        <p class="mt-1 text-xs text-gray-500">Nomor telepon digunakan untuk komunikasi penting terkait pesanan Anda</p>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" name="password" type="password" required
                               class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500 transition duration-300"
                               placeholder="Minimal 8 karakter">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required
                               class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500 transition duration-300"
                               placeholder="Ketik ulang password">
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-pink-500 hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition duration-300">
                        Daftar Sekarang
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ url('/') }}" class="text-sm text-gray-600 hover:text-gray-900">
                        ← Kembali ke beranda
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
