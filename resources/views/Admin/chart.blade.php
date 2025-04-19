<x-app-layout>
    <div class="min-h-screen bg-gray-50/50 py-6 sm:py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8 sm:mb-10">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 tracking-tight">Dashboard Kepala Staff</h1>
                    <p class="text-sm sm:text-base text-gray-500 mt-1">Statistik laporan terbaru dan distribusinya</p>
                </div>
            </div>

            <!-- Statistik Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8 sm:mb-10">
                <!-- Total Reports Card -->
                <div class="bg-white p-5 rounded-xl shadow-sm hover:shadow-md transition-all border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Laporan</h3>
                            <p class="text-3xl font-bold text-gray-800 mt-1">{{ $totalReports }}</p>
                        </div>
                        <div class="p-3 rounded-lg bg-gray-100 text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Responded Reports Card -->
                <div class="bg-white p-5 rounded-xl shadow-sm hover:shadow-md transition-all border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Laporan Ditanggapi</h3>
                            <p class="text-3xl font-bold text-blue-600 mt-1">{{ $respondedReports }}</p>
                        </div>
                        <div class="p-3 rounded-lg bg-blue-50 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Unresponded Reports Card -->
                <div class="bg-white p-5 rounded-xl shadow-sm hover:shadow-md transition-all border border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Belum Ditanggapi</h3>
                            <p class="text-3xl font-bold text-red-500 mt-1">{{ $unrespondedReports }}</p>
                        </div>
                        <div class="p-3 rounded-lg bg-red-50 text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Grid Layout -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Reports Overview Chart (Doughnut) -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-5 pb-3 border-b border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-800">Status Laporan</h2>
                    </div>
                    <div class="p-5 pt-0">
                        <div class="h-64 sm:h-72">
                            <canvas id="reportsChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Reports Status Bar Chart -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-5 pb-3 border-b border-gray-100">
                        <h2 class="text-lg font-semibold text-gray-800">Perbandingan Status Laporan</h2>
                    </div>
                    <div class="p-5 pt-0">
                        <div class="h-64 sm:h-72">
                            <canvas id="statusBarChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Province Distribution Chart -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                <div class="p-5 pb-3 border-b border-gray-100">
                    <h2 class="text-lg font-semibold text-gray-800">Distribusi Laporan per Provinsi</h2>
                </div>
                <div class="p-5 pt-0">
                    <div class="h-64 sm:h-80">
                        <canvas id="provinceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ChartJS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Reports Status Doughnut Chart
            const ctx1 = document.getElementById('reportsChart').getContext('2d');
            new Chart(ctx1, {
                type: 'doughnut',
                data: {
                    labels: ['Ditanggapi', 'Belum Ditanggapi'],
                    datasets: [{
                        label: 'Status',
                        data: [{{ $respondedReports }}, {{ $unrespondedReports }}],
                        backgroundColor: ['#38bdf8', '#f87171'],
                        borderColor: ['#fff', '#fff'],
                        borderWidth: 2,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { 
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = {{ $totalReports }};
                                    const percentage = ((value / total) * 100).toFixed(2);
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    },
                    cutout: '70%'
                }
            });

            // Reports Status Bar Chart
            const ctx2 = document.getElementById('statusBarChart').getContext('2d');
            new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: ['Status Laporan'],
                    datasets: [
                        {
                            label: 'Ditanggapi',
                            data: [{{ $respondedReports }}],
                            backgroundColor: '#38bdf8',
                            borderRadius: 4
                        },
                        {
                            label: 'Belum Ditanggapi',
                            data: [{{ $unrespondedReports }}],
                            backgroundColor: '#f87171',
                            borderRadius: 4
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    const label = context.dataset.label || '';
                                    const value = context.raw || 0;
                                    const total = {{ $totalReports }};
                                    const percentage = ((value / total) * 100).toFixed(2);
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                drawBorder: false
                            }
                        }
                    }
                }
            });

            // Province Distribution Chart
            const ctx3 = document.getElementById('provinceChart').getContext('2d');
            new Chart(ctx3, {
                type: 'pie',
                data: {
                    labels: {!! json_encode($provinceData->keys()) !!},
                    datasets: [{
                        label: 'Provinsi',
                        data: {!! json_encode($provinceData->values()) !!},
                        backgroundColor: [
                            '#facc15', '#34d399', '#60a5fa', '#f87171', 
                            '#a78bfa', '#f472b6', '#fb923c', '#94a3b8'
                        ],
                        borderColor: '#fff',
                        borderWidth: 2,
                        hoverOffset: 10
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { 
                            position: 'bottom',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                pointStyle: 'circle'
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    const label = context.label || '';
                                    const value = context.raw || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(2);
                                    return `${label}: ${value} (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>