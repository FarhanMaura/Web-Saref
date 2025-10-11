<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Wedding Creator</title>
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
                    <h2 class="mt-6 text-3xl font-bold text-gray-900">Masuk ke Akun Anda</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Atau
                        <a href="{{ route('register') }}" class="font-medium text-pink-600 hover:text-pink-500">
                            daftar akun baru
                        </a>
                    </p>
                </div>
            </div>

            <!-- Login Form -->
            <form class="mt-8 space-y-6 bg-white p-8 rounded-2xl shadow-lg" method="POST" action="{{ route('login') }}">
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
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" name="email" type="email" required
                               class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500 transition duration-300"
                               placeholder="email@example.com"
                               value="{{ old('email') }}">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" name="password" type="password" required
                               class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500 transition duration-300"
                               placeholder="Masukkan password">
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox"
                                   class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                                Ingat saya
                            </label>
                        </div>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-pink-600 hover:text-pink-500">
                                Lupa password?
                            </a>
                        @endif
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-pink-500 hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition duration-300">
                        Masuk
                    </button>
                </div>

                <div class="text-center">
                    <a href="{{ url('/') }}" class="text-sm text-gray-600 hover:text-gray-900">
                        ← Kembali ke Home
                    </a>
                </div>
            </form>

            <!-- Demo Accounts Info -->
            {{-- <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h4 class="font-semibold text-blue-800 mb-2">Akun Demo:</h4>
                <div class="text-sm text-blue-700 space-y-1">
                    <p><strong>Admin:</strong> admin@weddingcreator.com / password123</p>
                    <p><strong>User:</strong> customer@test.com / password123</p>
                </div>
            </div> --}}
        </div>
    </div>
</body>
</html>
