<x-app-layout>
    <div class="p-6 space-y-4">
        <h1 class="text-2xl font-bold">Presensi Hari Ini</h1>

        @if(session('success'))
            <div class="bg-green-300 p-3 rounded">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="bg-red-300 p-3 rounded">{{ session('error') }}</div>
        @endif

        <div class="space-y-2">
            <p><strong>Check-in:</strong> {{ $attendanceToday->check_in ?? '-' }}</p>
            <p><strong>Status:</strong> {{ $attendanceToday->status ?? '-' }}</p>
            <p><strong>Check-out:</strong> {{ $attendanceToday->check_out ?? '-' }}</p>
        </div>

        <div class="flex gap-3">
            @if(!isset($attendanceToday->check_in))
                <form method="POST" action="{{ route('employee.checkin') }}">
                    @csrf
                    <button class="bg-blue-600 text-white px-4 py-2 rounded">Presensi Masuk</button>
                </form>
            @endif

            @if(isset($attendanceToday->check_in) && !isset($attendanceToday->check_out))
                <form method="POST" action="{{ route('employee.checkout') }}">
                    @csrf
                    <button class="bg-green-600 text-white px-4 py-2 rounded">Presensi Pulang</button>
                </form>
            @endif
        </div>
    </div>
</x-app-layout>
