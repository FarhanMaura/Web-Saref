<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Statistik Penjualan') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Info Box -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <div class="flex items-center">
                <svg class="h-5 w-5 text-blue-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p class="text-blue-700 text-sm">
                    <strong>Info:</strong> Statistik hanya menampilkan pesanan dengan status <span class="font-semibold">Completed</span>
                    dan pembayaran <span class="font-semibold">Lunas</span>
                </p>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <!-- Total Completed & Paid Orders Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Pesanan Selesai & Lunas</p>
                                <p class="text-2xl font-semibold text-gray-900">
                                    {{ \App\Models\Order::where('status', 'completed')->where('payment_status', 'paid')->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Revenue Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Pendapatan</p>
                                <p class="text-2xl font-semibold text-gray-900">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Packages Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Paket</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $totalPackages }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Users Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-orange-500 rounded-md p-3">
                                <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-500">Total Users</p>
                                <p class="text-2xl font-semibold text-gray-900">{{ $totalUsers }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <!-- Monthly Statistics Card -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Statistik Penjualan</h3>

                        <!-- Year and Month Selector -->
                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="yearSelect" class="block text-sm font-medium text-gray-700 mb-2">Pilih Tahun:</label>
                                <select id="yearSelect" onchange="updateChart()" class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full">
                                    @for($year = 2000; $year <= 2090; $year++)
                                        <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div>
                                <label for="monthSelect" class="block text-sm font-medium text-gray-700 mb-2">Pilih Bulan:</label>
                                <select id="monthSelect" onchange="updateChart()" class="border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 w-full">
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ $i == $selectedMonth ? 'selected' : '' }}>
                                            {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <!-- Chart Container -->
                        <div class="h-64">
                            <canvas id="weeklyChart"></canvas>
                        </div>

                        <!-- Week Summary -->
                        <div class="mt-4 grid grid-cols-4 gap-2 text-xs">
                            @php
                                $currentWeek = $selectedYear == date('Y') && $selectedMonth == date('n') ? ceil(date('j') / 7) : null;
                            @endphp
                            @for($week = 1; $week <= 4; $week++)
                                @php
                                    $weekOrders = $weeklyData[$week] ?? 0;
                                    $color = $weekOrders >= 10 ? 'bg-green-500' : ($weekOrders >= 6 ? 'bg-yellow-500' : 'bg-red-500');
                                    $isCurrent = $week == $currentWeek;
                                @endphp
                                <div class="text-center p-2 rounded {{ $color }} text-white font-semibold {{ $isCurrent ? 'ring-2 ring-white' : '' }}">
                                    <div>Minggu {{ $week }}</div>
                                    <div class="text-lg">{{ $weekOrders }}</div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>

                <!-- Weekly Details -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">Detail Mingguan - {{ DateTime::createFromFormat('!m', $selectedMonth)->format('F') }} {{ $selectedYear }}</h3>

                        <div class="space-y-3">
                            @php
                                $totalMonthly = 0;
                            @endphp
                            @for($week = 1; $week <= 4; $week++)
                                @php
                                    $weekOrders = $weeklyData[$week] ?? 0;
                                    $totalMonthly += $weekOrders;
                                    $color = $weekOrders >= 10 ? 'text-green-600' : ($weekOrders >= 6 ? 'text-yellow-600' : 'text-red-600');
                                @endphp
                                <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                                    <span class="font-medium">Minggu ke {{ $week }}</span>
                                    <span class="{{ $color }} font-bold">{{ $weekOrders }} pesanan</span>
                                </div>
                            @endfor

                            <!-- Monthly Total -->
                            <div class="flex justify-between items-center p-3 bg-blue-50 rounded border border-blue-200 mt-4">
                                <span class="font-bold text-blue-800">Total Bulan {{ DateTime::createFromFormat('!m', $selectedMonth)->format('F') }}</span>
                                <span class="font-bold text-blue-800">{{ $totalMonthly }} pesanan</span>
                            </div>

                            <!-- Legend -->
                            <div class="mt-4 p-3 bg-gray-100 rounded text-xs">
                                <div class="font-semibold mb-2">Keterangan Warna:</div>
                                <div class="flex space-x-4">
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 bg-green-500 rounded mr-1"></div>
                                        <span>10+ pesanan</span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 bg-yellow-500 rounded mr-1"></div>
                                        <span>6-9 pesanan</span>
                                    </div>
                                    <div class="flex items-center">
                                        <div class="w-3 h-3 bg-red-500 rounded mr-1"></div>
                                        <span>1-5 pesanan</span>
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

            weeklyChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'],
                    datasets: [{
                        label: 'Jumlah Pesanan (Selesai & Lunas)',
                        data: [
                            weekData[1] || 0,
                            weekData[2] || 0,
                            weekData[3] || 0,
                            weekData[4] || 0
                        ],
                        backgroundColor: [
                            getColor(weekData[1] || 0),
                            getColor(weekData[2] || 0),
                            getColor(weekData[3] || 0),
                            getColor(weekData[4] || 0)
                        ],
                        borderColor: [
                            '#374151',
                            '#374151',
                            '#374151',
                            '#374151'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
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
            window.location.href = '{{ route("admin.statistics") }}?year=' + year + '&month=' + month;
        }

        // Initialize chart when page loads
        document.addEventListener('DOMContentLoaded', function() {
            initChart();
        });
    </script>
</x-app-layout>
