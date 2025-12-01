<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</head>

@if(session('success'))
<script>
Toastify({
    text: "{{ session('success') }}",
    gravity: "top",
    position: "right",
    backgroundColor: "#16a34a",
    stopOnFocus: true
}).showToast();
</script>
@endif

@if(session('error'))
<script>
Toastify({
    text: "{{ session('error') }}",
    gravity: "top",
    position: "right",
    backgroundColor: "#dc2626",
    stopOnFocus: true
}).showToast();
</script>
@endif

<body class="bg-gray-50 text-gray-900 font-inter">

<div class="flex h-screen overflow-hidden">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-gray-900 text-gray-200 flex flex-col shadow-xl">

        {{-- LOGO --}}
        <div class="px-6 py-5 border-b border-gray-800">
            <h1 class="text-xl font-semibold tracking-wide flex items-center gap-2">
                <x-heroicon-o-clock class="w-6 h-6 text-indigo-400" />
                PT Absen Terus
            </h1>
        </div>

        {{-- MENU --}}
        <nav class="flex-1 px-4 py-4 space-y-1 text-sm">
            @if(auth()->user()->role->name == 'admin')

                <x-sidebar-item route="admin.dashboard" label="Dashboard" icon="home" />
                <x-sidebar-item route="admin.employees.index" label="Kelola Karyawan" icon="user-group" />
                <x-sidebar-item route="admin.attendance.index" label="Rekap Absensi" icon="clipboard-document-check" />

            @endif

            @if(auth()->user()->role->name == 'karyawan')

                <x-sidebar-item route="employee.dashboard" label="Dashboard" icon="home" />
                <x-sidebar-item route="employee.attendance" label="Presensi" icon="clock" />
                <x-sidebar-item route="employee.history" label="Riwayat Kehadiran" icon="calendar-days" />

            @endif
        </nav>

        {{-- FOOTER --}}
        <div class="p-4 border-t border-gray-800 flex items-center gap-3">

            {{-- Avatar User --}}
            <img 
                src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=6366f1&color=ffffff&size=60"
                class="w-10 h-10 rounded-full shadow"
            >

            {{-- Nama + Role --}}
            <div class="flex-1">
                <p class="font-semibold text-sm">{{ auth()->user()->name }}</p>
                <p class="text-xs text-gray-400 capitalize">{{ auth()->user()->role->name }}</p>
            </div>

            {{-- Logout --}}
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button title="Logout">
                    <x-heroicon-o-arrow-right-on-rectangle class="w-6 h-6 text-red-500 hover:text-red-600"/>
                </button>
            </form>
        </div>
    </aside>

    {{-- MAIN CONTENT AREA --}}
    <main class="flex-1 overflow-y-auto p-8">

        {{-- PAGE HEADER --}}
        <div class="mb-6">
            <h2 class="text-2xl font-semibold tracking-tight text-gray-800">
                Selamat datang, {{ auth()->user()->name }}
            </h2>
            <p class="text-sm text-gray-500">
                Sistem Presensi Karyawan PT Absen Terus
            </p>
        </div>

        {{-- WHITE CONTENT CARD --}}
        <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200">
            {{ $slot }}
        </div>

    </main>
</div>

</body>
</html>
