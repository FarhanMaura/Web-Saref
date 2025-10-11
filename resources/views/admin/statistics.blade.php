<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-playfair text-2xl font-bold text-gray-900">
                {{ __('📊 Statistik Penjualan') }}
            </h2>
            <div class="text-sm text-gray-600 bg-white px-4 py-2 rounded-xl border border-gray-200">
                Periode: {{ DateTime::createFromFormat('!m', $selectedMonth)->format('F') }} {{ $selectedYear }}
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Info Box -->
            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 border border-blue-200 rounded-2xl p-6 mb-8 shadow-sm">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h4 class="font-semibold text-blue-800 text-lg mb-2">Informasi Statistik</h4>
                        <p class="text-blue-700">
                            Statistik hanya menampilkan pesanan dengan status <span class="font-bold bg-blue-100 px-2 py-1 rounded">Completed</span>
                            dan pembayaran <span class="font-bold bg-green-100 px-2 py-1 rounded text-green-800">Lunas</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Completed & Paid Orders Card -->
                <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100 hover:shadow-xl transition duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl p-4 shadow-lg">
                                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Pesanan Selesai & Lunas</p>
                                <p class="text-3xl font-bold text-gray-900">
                                    {{ \App\Models\Order::where('status', 'completed')->where('payment_status', 'paid')->count() }}
                                </p>
                                <p class="text-xs text-gray-400 mt-1">Total transaksi berhasil</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Revenue Card -->
                <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100 hover:shadow-xl transition duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-r from-green-500 to-green-600 rounded-xl p-4 shadow-lg">
                                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Pendapatan</p>
                                <p class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-green-700">
                                    Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                                </p>
                                <p class="text-xs text-gray-400 mt-1">Revenue bersih</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Packages Card -->
                <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100 hover:shadow-xl transition duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-4 shadow-lg">
                                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Paket</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $totalPackages }}</p>
                                <p class="text-xs text-gray-400 mt-1">Paket tersedia</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Users Card -->
                <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100 hover:shadow-xl transition duration-300">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-gradient-to-r from-orange-500 to-orange-600 rounded-xl p-4 shadow-lg">
                                <svg class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Users</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $totalUsers }}</p>
                                <p class="text-xs text-gray-400 mt-1">User terdaftar</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <!-- Chart Section -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100">
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-6">
                                <h3 class="font-playfair text-xl font-bold text-gray-900">📈 Grafik Penjualan</h3>

                                <!-- Year and Month Selector -->
                                <div class="flex space-x-3">
                                    <div class="relative">
                                        <select id="yearSelect" onchange="updateChart()"
                                                class="border-2 border-gray-200 rounded-xl shadow-sm focus:border-pink-500 focus:ring-pink-500 px-4 py-2 pr-8 appearance-none bg-white cursor-pointer transition duration-200">
                                            @for($year = 2020; $year <= 2030; $year++)
                                                <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
                                                    {{ $year }}
                                                </option>
                                            @endfor
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="relative">
                                        <select id="monthSelect" onchange="updateChart()"
                                                class="border-2 border-gray-200 rounded-xl shadow-sm focus:border-pink-500 focus:ring-pink-500 px-4 py-2 pr-8 appearance-none bg-white cursor-pointer transition duration-200">
                                            @for($i = 1; $i <= 12; $i++)
                                                <option value="{{ $i }}" {{ $i == $selectedMonth ? 'selected' : '' }}>
                                                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                                </option>
                                            @endfor
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Chart Container -->
                            <div class="h-80">
                                <canvas id="weeklyChart"></canvas>
                            </div>

                            <!-- Week Summary -->
                            <div class="mt-6 grid grid-cols-4 gap-3">
                                @php
                                    $currentWeek = $selectedYear == date('Y') && $selectedMonth == date('n') ? ceil(date('j') / 7) : null;
                                @endphp
                                @for($week = 1; $week <= 4; $week++)
                                    @php
                                        $weekOrders = $weeklyData[$week] ?? 0;
                                        $color = $weekOrders >= 10 ? 'from-green-500 to-green-600' :
                                                ($weekOrders >= 6 ? 'from-yellow-500 to-yellow-600' : 'from-red-500 to-red-600');
                                        $isCurrent = $week == $currentWeek;
                                    @endphp
                                    <div class="text-center p-4 rounded-2xl bg-gradient-to-r {{ $color }} text-white font-semibold shadow-lg transform hover:scale-105 transition duration-200 {{ $isCurrent ? 'ring-4 ring-white ring-opacity-50' : '' }}">
                                        <div class="text-sm opacity-90">Minggu {{ $week }}</div>
                                        <div class="text-2xl font-bold mt-1">{{ $weekOrders }}</div>
                                        <div class="text-xs opacity-80 mt-1">pesanan</div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Weekly Details & Analytics -->
                <div class="space-y-6">
                    <!-- Weekly Details -->
                    <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100">
                        <div class="p-6">
                            <h3 class="font-playfair text-xl font-bold text-gray-900 mb-4">📋 Detail Mingguan</h3>

                            <div class="space-y-3">
                                @php
                                    $totalMonthly = 0;
                                    $maxOrders = max($weeklyData);
                                @endphp
                                @for($week = 1; $week <= 4; $week++)
                                    @php
                                        $weekOrders = $weeklyData[$week] ?? 0;
                                        $totalMonthly += $weekOrders;
                                        $percentage = $maxOrders > 0 ? ($weekOrders / $maxOrders) * 100 : 0;
                                        $color = $weekOrders >= 10 ? 'bg-green-500' :
                                                ($weekOrders >= 6 ? 'bg-yellow-500' : 'bg-red-500');
                                    @endphp
                                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-xl hover:bg-gray-100 transition duration-150">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white text-sm font-bold">
                                                {{ $week }}
                                            </div>
                                            <span class="font-medium text-gray-700">Minggu {{ $week }}</span>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <div class="w-20 bg-gray-200 rounded-full h-2">
                                                <div class="h-2 rounded-full {{ $color }}" style="width: {{ $percentage }}%"></div>
                                            </div>
                                            <span class="font-bold text-gray-900 min-w-12 text-right">{{ $weekOrders }} pesanan</span>
                                        </div>
                                    </div>
                                @endfor

                                <!-- Monthly Total -->
                                <div class="flex justify-between items-center p-4 bg-gradient-to-r from-blue-500 to-blue-600 rounded-xl text-white mt-4 shadow-lg">
                                    <span class="font-bold">Total Bulan Ini</span>
                                    <span class="font-bold text-xl">{{ $totalMonthly }} pesanan</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Performance Indicators -->
                    <div class="bg-white overflow-hidden shadow-lg rounded-2xl border border-gray-100">
                        <div class="p-6">
                            <h3 class="font-playfair text-xl font-bold text-gray-900 mb-4">🎯 Indikator Performa</h3>

                            <div class="space-y-4">
                                @php
                                    $avgWeekly = $totalMonthly / 4;
                                    $performance = $avgWeekly >= 10 ? 'Excellent' :
                                                 ($avgWeekly >= 6 ? 'Good' : 'Need Improvement');
                                    $performanceColor = $avgWeekly >= 10 ? 'text-green-600' :
                                                      ($avgWeekly >= 6 ? 'text-yellow-600' : 'text-red-600');
                                    $performanceBg = $avgWeekly >= 10 ? 'bg-green-100' :
                                                   ($avgWeekly >= 6 ? 'bg-yellow-100' : 'bg-red-100');
                                @endphp

                                <div class="flex justify-between items-center p-3 {{ $performanceBg }} rounded-lg">
                                    <span class="font-medium">Rata-rata Mingguan</span>
                                    <span class="font-bold {{ $performanceColor }}">{{ number_format($avgWeekly, 1) }}</span>
                                </div>

                                <div class="flex justify-between items-center p-3 bg-gray-100 rounded-lg">
                                    <span class="font-medium">Performansi</span>
                                    <span class="font-bold {{ $performanceColor }}">{{ $performance }}</span>
                                </div>

                                <div class="flex justify-between items-center p-3 bg-gray-100 rounded-lg">
                                    <span class="font-medium">Minggu Terbaik</span>
                                    <span class="font-bold text-green-600">{{ $maxOrders }} pesanan</span>
                                </div>
                            </div>

                            <!-- Legend -->
                            <div class="mt-4 p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200">
                                <div class="font-semibold text-gray-900 mb-3">🎨 Keterangan Warna:</div>
                                <div class="space-y-2 text-sm">
                                    <div class="flex items-center">
                                        <div class="w-4 h-4 bg-gradient-to-r from-green-500 to-green-600 rounded mr-3"></div>
                                        <span class="text-gray-700">10+ pesanan (Excellent)</span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="w-4 h-4 bg-gradient-to-r from-yellow-500 to-yellow-600 rounded mr-3"></div>
                                        <span class="text-gray-700">6-9 pesanan (Good)</span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="w-4 h-4 bg-gradient-to-r from-red-500 to-red-600 rounded mr-3"></div>
                                        <span class="text-gray-700">1-5 pesanan (Improve)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        let weeklyChart;

        function initChart() {
            const ctx = document.getElementById('weeklyChart').getContext('2d');
            const weekData = {!! json_encode($weeklyData) !!};

            // Gradient function for chart bars
            const createGradient = (ctx, color) => {
                const gradient = ctx.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, color + 'CC');
                gradient.addColorStop(1, color + '66');
                return gradient;
            };

            weeklyChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
                    datasets: [{
                        label: 'Jumlah Pesanan',
                        data: [
                            weekData[1] || 0,
                            weekData[2] || 0,
                            weekData[3] || 0,
                            weekData[4] || 0
                        ],
                        backgroundColor: [
                            createGradient(ctx, getColor(weekData[1] || 0)),
                            createGradient(ctx, getColor(weekData[2] || 0)),
                            createGradient(ctx, getColor(weekData[3] || 0)),
                            createGradient(ctx, getColor(weekData[4] || 0))
                        ],
                        borderColor: [
                            getColor(weekData[1] || 0),
                            getColor(weekData[2] || 0),
                            getColor(weekData[3] || 0),
                            getColor(weekData[4] || 0)
                        ],
                        borderWidth: 2,
                        borderRadius: 8,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.8)',
                            titleFont: {
                                size: 14
                            },
                            bodyFont: {
                                size: 13
                            },
                            padding: 12,
                            cornerRadius: 8
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.1)'
                            },
                            ticks: {
                                stepSize: 1,
                                font: {
                                    size: 12
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                }
                            }
                        }
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeInOutQuart'
                    }
                }
            });
        }

        function getColor(value) {
            if (value >= 10) return '#10B981'; // green
            if (value >= 6) return '#F59E0B';  // yellow
            return '#EF4444'; // red
        }

        function updateChart() {
            const year = document.getElementById('yearSelect').value;
            const month = document.getElementById('monthSelect').value;

            // Show loading state
            const event = new CustomEvent('show-loading', {
                detail: { message: 'Memuat data statistik...' }
            });
            window.dispatchEvent(event);

            window.location.href = '{{ route("admin.statistics") }}?year=' + year + '&month=' + month;
        }

        // Add interactivity to selects
        document.addEventListener('DOMContentLoaded', function() {
            initChart();

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
