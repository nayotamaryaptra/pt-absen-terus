<x-app-layout>
    <div class="space-y-6">

    <h2 class="text-xl font-semibold">Dashboard Karyawan</h2>
    <p class="text-gray-500 mb-4">Selamat datang, {{ auth()->user()->name }}</p>

    {{-- STATUS PRESENSI --}}
    <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-5 flex justify-between items-center">
        <div>
            <h4 class="font-semibold text-indigo-700 text-lg">Status Hari ini</h4>
            <p class="text-gray-600">
                @if(!$todayAttendance)
                    Belum presensi
                @elseif(!$todayAttendance->check_out)
                    Sudah presensi masuk
                @else
                    Presensi selesai hari ini
                @endif
            </p>
        </div>
        <div class="space-x-2">
            @if(!$todayAttendance)
                <form method="POST" action="{{ route('employee.checkin') }}" id="checkinForm">
                    @csrf
                    <button id="checkinBtn" class="px-4 py-2 bg-green-600 text-white rounded-md flex items-center gap-2">
                        <span id="checkinText">Check In</span>
                        <span id="checkinLoading" class="hidden animate-spin border-2 border-white border-t-transparent rounded-full w-4 h-4"></span>
                    </button>
                </form>
            @elseif(!$todayAttendance->check_out)
                <form method="POST" action="{{ route('employee.checkout') }}" id="checkoutForm">
                    @csrf
                    <button id="checkoutBtn" class="px-4 py-2 bg-blue-600 text-white rounded-md flex items-center gap-2">
                        <span id="checkoutText">Check Out</span>
                        <span id="checkoutLoading" class="hidden animate-spin border-2 border-white border-t-transparent rounded-full w-4 h-4"></span>
                    </button>
                </form>

            @else
                <button disabled class="px-4 py-2 bg-gray-400 text-white rounded-md cursor-not-allowed">
                    Selesai
                </button>
            @endif
        </div>
    </div>

    {{-- GRAFIK --}}
    <div class="bg-white border border-gray-200 shadow-md rounded-xl p-6">
        <h3 class="text-lg font-semibold mb-3">Aktivitas 7 Hari Terakhir</h3>
        <canvas id="employeeChart" height="230"></canvas>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('employeeChart').getContext('2d');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!},
            datasets: [{
                label: 'Status Kehadiran',
                data: {!! json_encode($values) !!},
                backgroundColor: [
                    'rgba(34,197,94,0.8)', // on_time
                ],
                borderRadius: 6,
            }]
        },
        options: {
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    ticks: {
                        callback: value => value === 2 ? "On Time" : value === 1 ? "Late" : "Absent"
                    },
                    beginAtZero: true,
                    max: 2
                }
            }
        }
    });
</script>

<script>
document.getElementById('checkinForm')?.addEventListener('submit', () => {
    document.getElementById('checkinText').innerText = "Menyimpan...";
    document.getElementById('checkinLoading').classList.remove('hidden');
});

document.getElementById('checkoutForm')?.addEventListener('submit', () => {
    document.getElementById('checkoutText').innerText = "Menyimpan...";
    document.getElementById('checkoutLoading').classList.remove('hidden');
});
</script>


</x-app-layout>
