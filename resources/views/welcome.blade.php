<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('images/logo.jpg') }}" type="image/x-icon">
    <title>RJ VISUAL STORIES - WEDDING CREATOR MOMENT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        .font-playfair { font-family: 'Playfair Display', serif; }
        .font-inter { font-family: 'Inter', sans-serif; }

        /* Slider Styles */
        .slider-container {
            position: relative;
            overflow: hidden;
        }

        .slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slide {
            min-width: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            position: absolute;
            top: 0;
            left: 0;
        }

        .slide.active {
            opacity: 1;
            position: relative;
        }

        .slider-dots {
            display: flex;
            justify-content: center;
            margin-top: 1rem;
        }

        .slider-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.5);
            margin: 0 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .slider-dot.active {
            background-color: #ec4899;
        }
    </style>
</head>
<body class="font-inter bg-gradient-to-br from-pink-50 to-white">
    <!-- Navigation -->
    <nav class="bg-white/80 backdrop-blur-md border-b border-pink-100 fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="flex items-center space-x-2 flex-shrink-0">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Logo"
                            class="h-10 w-10 object-cover rounded-full">
                        <span class="font-playfair text-2xl font-bold text-pink-600">💍RJ VISUAL STORIES</span>
                    </div>

                </div>
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="#services" class="text-gray-600 hover:text-pink-600 px-3 py-2 text-sm font-medium">Layanan</a>
                        <a href="#packages" class="text-gray-600 hover:text-pink-600 px-3 py-2 text-sm font-medium">Paket</a>
                        <a href="#about" class="text-gray-600 hover:text-pink-600 px-3 py-2 text-sm font-medium">Tentang</a>
                        <a href="{{ route('login') }}" class="bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded-full text-sm font-medium transition duration-300">Masuk</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-24 pb-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="font-playfair text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                        Abadikan Momen
                        <span class="text-pink-600">Terindah</span>
                        Pernikahan Anda
                    </h1>
                    <p class="mt-6 text-xl text-gray-600 leading-relaxed">
                        Wedding & Event Content Creator profesional siap mengabadikan setiap detik berharga
                        pernikahan Anda dengan gaya yang elegan dan timeless.
                    </p>
                    <div class="mt-10 flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('register') }}" class="bg-pink-500 hover:bg-pink-600 text-white px-8 py-4 rounded-full text-lg font-semibold transition duration-300 text-center">
                            Mulai Pesan Sekarang
                        </a>
                        <button onclick="showPackageAlert()" class="border-2 border-pink-500 text-pink-600 hover:bg-pink-50 px-8 py-4 rounded-full text-lg font-semibold transition duration-300 text-center">
                            Lihat Paket
                        </button>
                    </div>
                </div>
                <div class="relative">
                    <div class="bg-pink-100 rounded-2xl p-8 transform rotate-3 slider-container">
                        <div class="slider">
                            <!-- Slide 1 -->
                            <div class="slide active rounded-2xl shadow-2xl transform -rotate-3">
                                <img src="{{ asset('images/image1.jpg') }}"
                                    alt="Wedding Couple"
                                    class="rounded-2xl w-full h-full object-cover">
                            </div>
                            <!-- Slide 2 -->
                            <div class="slide rounded-2xl shadow-2xl transform -rotate-3">
                                <img src="{{ asset('images/image2.jpg') }}"
                                    alt="Wedding Rings"
                                    class="rounded-2xl w-full h-full object-cover">
                            </div>
                            <!-- Slide 3 -->
                            <div class="slide rounded-2xl shadow-2xl transform -rotate-3">
                                <img src="{{ asset('images/image3.jpg') }}"
                                    alt="Wedding Ceremony"
                                    class="rounded-2xl w-full h-full object-cover">
                            </div>
                            <!-- Slide 4 -->
                            <div class="slide rounded-2xl shadow-2xl transform -rotate-3">
                                <img src="{{ asset('images/image4.jpg') }}"
                                    alt="Bride and Groom"
                                    class="rounded-2xl w-full h-full object-cover">
                            </div>
                            <!-- Slide 5 -->
                            <div class="slide rounded-2xl shadow-2xl transform -rotate-3">
                                <img src="{{ asset('images/image5.jpg') }}"
                                    alt="Wedding Moment"
                                    class="rounded-2xl w-full h-full object-cover">
                            </div>
                            <!-- Slide 6 -->
                            <div class="slide rounded-2xl shadow-2xl transform -rotate-3">
                                <img src="{{ asset('images/image6.jpg') }}"
                                    alt="Wedding Celebration"
                                    class="rounded-2xl w-full h-full object-cover">
                            </div>
                        </div>
                        <div class="slider-dots">
                            <span class="slider-dot active" data-slide="0"></span>
                            <span class="slider-dot" data-slide="1"></span>
                            <span class="slider-dot" data-slide="2"></span>
                            <span class="slider-dot" data-slide="3"></span>
                            <span class="slider-dot" data-slide="4"></span>
                            <span class="slider-dot" data-slide="5"></span>
                        </div>
                    </div>
                    <div class="absolute -bottom-6 -left-6 bg-white rounded-2xl p-6 shadow-xl">
                        <div class="flex items-center space-x-4">
                            <div class="bg-green-100 p-3 rounded-full">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">500+ Pasangan</p>
                                <p class="text-sm text-gray-600">Percayakan Momen Mereka</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="font-playfair text-4xl font-bold text-gray-900">Layanan Kami</h2>
                <p class="mt-4 text-xl text-gray-600">Mengabadikan setiap momen spesial dengan penuh makna</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-8 rounded-2xl bg-pink-50 hover:bg-pink-100 transition duration-300">
                    <div class="bg-white rounded-full p-4 w-20 h-20 mx-auto mb-6 flex items-center justify-center">
                        <span class="text-3xl">💒</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Wedding Day</h3>
                    <p class="text-gray-600">Dokumentasi lengkap hari pernikahan Anda dari preparation hingga reception</p>
                </div>
                <div class="text-center p-8 rounded-2xl bg-blue-50 hover:bg-blue-100 transition duration-300">
                    <div class="bg-white rounded-full p-4 w-20 h-20 mx-auto mb-6 flex items-center justify-center">
                        <span class="text-3xl">📸</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Prewedding</h3>
                    <p class="text-gray-600">Sesi foto romantis sebelum hari pernikahan dengan berbagai konsep kreatif</p>
                </div>
                <div class="text-center p-8 rounded-2xl bg-purple-50 hover:bg-purple-100 transition duration-300">
                    <div class="bg-white rounded-full p-4 w-20 h-20 mx-auto mb-6 flex items-center justify-center">
                        <span class="text-3xl">🎉</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Event Lainnya</h3>
                    <p class="text-gray-600">Engagement, birthday party, dan acara spesial lainnya</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Packages Section -->
    <section id="packages" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="font-playfair text-4xl font-bold text-gray-900">Paket Layanan</h2>
                <p class="mt-4 text-xl text-gray-600">Pilih paket yang sesuai dengan kebutuhan Anda</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <!-- Package 1 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border-2 border-pink-100 hover:border-pink-300 transition duration-300">
                    <div class="bg-pink-500 text-white p-6 text-center">
                        <h3 class="text-2xl font-bold">Paket Basic</h3>
                        <div class="mt-4">
                            <span class="text-4xl font-bold">Rp 2.5JT</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3 text-gray-600">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                2 jam sesi foto
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                50 foto edited
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                1 lokasi shooting
                            </li>
                        </ul>
                        <button onclick="showPackageAlert()" class="w-full mt-6 bg-pink-500 hover:bg-pink-600 text-white py-3 rounded-lg font-semibold transition duration-300">
                            Lihat Detail
                        </button>
                    </div>
                </div>

                <!-- Package 2 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border-2 border-purple-100 hover:border-purple-300 transition duration-300 transform scale-105">
                    <div class="bg-purple-500 text-white p-6 text-center relative">
                        <div class="absolute -top-2 -right-2 bg-yellow-500 text-white px-3 py-1 rounded-full text-sm font-bold">
                            POPULAR
                        </div>
                        <h3 class="text-2xl font-bold">Paket Silver</h3>
                        <div class="mt-4">
                            <span class="text-4xl font-bold">Rp 5JT</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3 text-gray-600">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                8 jam dokumentasi
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                200+ foto edited
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Video highlight 3-5 menit
                            </li>
                        </ul>
                        <button onclick="showPackageAlert()" class="w-full mt-6 bg-purple-500 hover:bg-purple-600 text-white py-3 rounded-lg font-semibold transition duration-300">
                            Lihat Detail
                        </button>
                    </div>
                </div>

                <!-- Package 3 -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border-2 border-blue-100 hover:border-blue-300 transition duration-300">
                    <div class="bg-blue-500 text-white p-6 text-center">
                        <h3 class="text-2xl font-bold">Paket Gold</h3>
                        <div class="mt-4">
                            <span class="text-4xl font-bold">Rp 8JT</span>
                        </div>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3 text-gray-600">
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                10 jam dokumentasi
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                2 photographer
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Drone footage
                            </li>
                        </ul>
                        <button onclick="showPackageAlert()" class="w-full mt-6 bg-blue-500 hover:bg-blue-600 text-white py-3 rounded-lg font-semibold transition duration-300">
                            Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
            <div class="text-center mt-8">
                <p class="text-gray-600">Dan masih banyak paket lainnya yang tersedia</p>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="font-playfair text-4xl font-bold text-gray-900 mb-8">Tentang Kami</h2>
            <p class="text-xl text-gray-600 leading-relaxed mb-8">
                RJ Visual Stories adalah tim profesional yang berdedikasi untuk mengabadikan momen-momen terindah
                dalam hidup Anda. Dengan pengalaman lebih dari 5 tahun dalam industri wedding photography,
                kami memahami betapa berharganya setiap detik dalam pernikahan Anda.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                <div class="text-center">
                    <div class="bg-pink-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">🎯</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Profesional</h3>
                    <p class="text-gray-600 mt-2">Tim fotografer berpengalaman</p>
                </div>
                <div class="text-center">
                    <div class="bg-pink-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">💝</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Berkualitas</h3>
                    <p class="text-gray-600 mt-2">Hasil foto & video terbaik</p>
                </div>
                <div class="text-center">
                    <div class="bg-pink-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">⏱️</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Tepat Waktu</h3>
                    <p class="text-gray-600 mt-2">Proses cepat dan efisien</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-pink-500 to-purple-600">
        <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="font-playfair text-4xl font-bold text-white mb-6">
                Siap Abadikan Momen Spesial Anda?
            </h2>
            <p class="text-xl text-pink-100 mb-10">
                Pesan sekarang dan dapatkan konsultasi gratis dengan tim profesional kami
            </p>
            <a href="{{ route('register') }}" class="bg-white text-pink-600 hover:bg-pink-50 px-10 py-4 rounded-full text-lg font-semibold transition duration-300 inline-block">
                Daftar Sekarang
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="font-playfair text-2xl font-bold mb-4">RJ VISUAL STORIES Wedding Creator</h3>
                    <p class="text-gray-400">Mengabadikan momen terindah pernikahan Anda dengan penuh cinta dan profesionalisme.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#services" class="hover:text-white">Layanan</a></li>
                        <li><a href="#packages" class="hover:text-white">Paket</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-white">Masuk</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li>Phone: +62 812-3456-7890</li>
                        <li>Alamat: KayuAgung, Palembang</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Follow Kami</h4>
                    <div class="flex space-x-4">
                        <a href="https://www.instagram.com/rj.visualstories?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="text-gray-400 hover:text-white">Instagram</a>
                        <a href="https://www.tiktok.com/@rj.visualstories?_t=ZS-90Rl9oqFFEg&_r=1" class="text-gray-400 hover:text-white">TikTok</a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 WeddingCreator. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Package Alert Modal -->
    <div id="packageAlert" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl p-8 max-w-md mx-4">
            <div class="text-center">
                <div class="w-16 h-16 bg-pink-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Login Diperlukan</h3>
                <p class="text-gray-600 mb-6">Silakan login terlebih dahulu untuk melihat detail paket dan melakukan pemesanan</p>
                <div class="flex space-x-3">
                    <button onclick="hidePackageAlert()" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 py-3 rounded-lg font-semibold transition duration-300">
                        Nanti Saja
                    </button>
                    <a href="{{ route('login') }}" class="flex-1 bg-pink-500 hover:bg-pink-600 text-white py-3 rounded-lg font-semibold transition duration-300 text-center">
                        Login Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Slider functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.slider-dot');
        const slideCount = slides.length;

        function showSlide(n) {
            // Hide all slides
            slides.forEach(slide => {
                slide.classList.remove('active');
            });

            // Remove active class from all dots
            dots.forEach(dot => {
                dot.classList.remove('active');
            });

            // Set current slide
            currentSlide = (n + slideCount) % slideCount;

            // Show current slide
            slides[currentSlide].classList.add('active');
            dots[currentSlide].classList.add('active');
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        // Auto slide every 5 seconds
        setInterval(nextSlide, 5000);

        // Add click event to dots
        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                showSlide(index);
            });
        });

        // Initialize slider
        showSlide(0);

        // Existing functions
        function showPackageAlert() {
            document.getElementById('packageAlert').classList.remove('hidden');
        }

        function hidePackageAlert() {
            document.getElementById('packageAlert').classList.add('hidden');
        }

        // Smooth scroll untuk anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Close modal ketika klik di luar
        document.getElementById('packageAlert').addEventListener('click', function(e) {
            if (e.target === this) {
                hidePackageAlert();
            }
        });

        // Close modal dengan ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hidePackageAlert();
            }
        });
    </script>
</body>
</html>
