<x-app-layout>
    <div class="space-y-4">

        <h2 class="text-xl font-semibold">Dashboard Admin</h2>
        <p class="text-gray-500 mb-4">Overview Kehadiran dan Data Sistem</p>

        {{-- STAT CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            {{-- Total Karyawan --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm flex items-center">
                <div class="p-3 bg-indigo-100 text-indigo-600 rounded-lg">
                    <x-heroicon-o-user-group class="w-7 h-7" />
                </div>
                <div class="ml-4">
                    <h4 class="text-gray-500 text-sm">Total Karyawan</h4>
                    <p class="text-2xl font-semibold">{{ $totalEmployees }}</p>
                </div>
            </div>

            {{-- Hadir Hari Ini --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm flex items-center">
                <div class="p-3 bg-green-100 text-green-600 rounded-lg">
                    <x-heroicon-o-check-circle class="w-7 h-7" />
                </div>
                <div class="ml-4">
                    <h4 class="text-gray-500 text-sm">Hadir Hari Ini</h4>
                    <p class="text-2xl font-semibold">{{ $presentToday }}</p>
                </div>
            </div>

            {{-- Telat --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm flex items-center">
                <div class="p-3 bg-yellow-100 text-yellow-600 rounded-lg">
                    <x-heroicon-o-clock class="w-7 h-7" />
                </div>
                <div class="ml-4">
                    <h4 class="text-gray-500 text-sm">Telat</h4>
                    <p class="text-2xl font-semibold">{{ $lateToday }}</p>
                </div>
            </div>

            {{-- Tidak Hadir --}}
            <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm flex items-center">
                <div class="p-3 bg-red-100 text-red-600 rounded-lg">
                    <x-heroicon-o-x-circle class="w-7 h-7" />
                </div>
                <div class="ml-4">
                    <h4 class="text-gray-500 text-sm">Tidak Hadir</h4>
                    <p class="text-2xl font-semibold">{{ $absentToday }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- CHART --}}
    <div class="mt-8 bg-white border border-gray-200 shadow-md rounded-xl p-6">
        <h3 class="text-lg font-semibold mb-3">Grafik Kehadiran 30 Hari Terakhir</h3>
        <canvas id="attendanceChart" style="height: 260px"></canvas>
    </div>

    <canvas id="attendanceChart" height="10"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('attendanceChart').getContext('2d');

        const attendanceChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Total Presensi',
                    data: {!! json_encode($values) !!},
                    borderColor: 'rgb(99, 102, 241)', // indigo
                    backgroundColor: 'rgba(99, 102, 241, 0.25)',
                    tension: 0.35,
                    borderWidth: 3,
                    fill: true,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true },
                    tooltip: { enabled: true }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
</x-app-layout>
