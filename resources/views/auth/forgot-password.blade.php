<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - RJ VISUAL STORIES</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        .font-playfair { font-family: 'Playfair Display', serif; }
        .font-inter { font-family: 'Inter', sans-serif; }
        .break-all { word-break: break-all; }
        .select-all { user-select: all; }
    </style>
</head>
<body class="font-inter bg-gradient-to-br from-pink-50 via-purple-50 to-blue-50 min-h-screen">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Header -->
            <div>
                <div class="text-center">
                    <a href="{{ url('/') }}" class="inline-block">
                        <span class="font-playfair text-3xl font-bold text-pink-600">💍 RJ VISUAL STORIES</span>
                    </a>
                    <h2 class="mt-6 text-3xl font-bold text-gray-900">Reset Password</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Masukkan email Anda untuk mendapatkan link reset password
                    </p>
                </div>
            </div>

            <!-- Success/Status Message -->
            @if (session('status'))
                <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="text-sm text-green-700">
                            {!! session('status') !!}
                        </div>
                    </div>
                </div>
            @endif

            <!-- Forgot Password Form -->
            <form class="mt-8 space-y-6 bg-white p-8 rounded-2xl shadow-lg" method="POST" action="{{ route('password.email') }}">
                @csrf

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Information Text -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-sm text-blue-700">
                            <strong>Mode Development:</strong> Link reset password akan langsung ditampilkan di halaman ini. Copy dan buka di browser baru.
                        </p>
                    </div>
                </div>

                <!-- Email Input -->
                <div class="space-y-2">
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Alamat Email
                    </label>
                    <div class="relative">
                        <input id="email"
                               name="email"
                               type="email"
                               required
                               autofocus
                               class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:ring-pink-500 focus:border-pink-500 transition duration-300 placeholder-gray-400"
                               placeholder="email@example.com"
                               value="{{ old('email') }}">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    </div>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit"
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-pink-500 to-purple-600 hover:from-pink-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 transition duration-300 shadow-lg hover:shadow-xl">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-pink-300 group-hover:text-pink-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </span>
                        Buat Link Reset Password
                    </button>
                </div>

                <!-- Navigation Links -->
                <div class="flex flex-col space-y-3 text-center">
                    <a href="{{ route('login') }}" class="text-sm text-pink-600 hover:text-pink-500 font-medium">
                        ← Kembali ke Halaman Masuk
                    </a>
                    <a href="{{ url('/') }}" class="text-sm text-gray-600 hover:text-gray-900">
                        Kembali ke Home
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Copy Function JavaScript -->
    <script>
        function copyResetLink() {
            const codeElement = document.querySelector('code');
            const textArea = document.createElement('textarea');
            textArea.value = codeElement.textContent;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);

            // Show copied message
            const button = event.target;
            const originalText = button.textContent;
            button.textContent = '✓ Tersalin!';
            button.classList.add('bg-green-500', 'hover:bg-green-600');
            button.classList.remove('bg-gray-500', 'hover:bg-gray-600');

            setTimeout(() => {
                button.textContent = originalText;
                button.classList.remove('bg-green-500', 'hover:bg-green-600');
                button.classList.add('bg-gray-500', 'hover:bg-gray-600');
            }, 2000);
        }

        // Add some interactivity
        document.addEventListener('DOMContentLoaded', function() {
            const emailInput = document.getElementById('email');

            // Add focus effect
            emailInput.addEventListener('focus', function() {
                this.classList.add('ring-2', 'ring-pink-200', 'border-pink-500');
            });

            emailInput.addEventListener('blur', function() {
                this.classList.remove('ring-2', 'ring-pink-200', 'border-pink-500');
            });
        });
    </script>
</body>
</html>
