<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'PT Absen Terus') }}</title>

    {{-- Vite CSS & JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
</head>

<body class="min-h-screen bg-cover bg-center bg-no-repeat relative font-inter"
      style="background-image: url('/images/bg-login.jpg');">

    <!-- Overlay gelap -->
    <div class="absolute inset-0 bg-black/40 backdrop-blur-sm"></div>

    <div class="relative min-h-screen flex items-center justify-center px-4">

        <div class="bg-white shadow-xl rounded-xl overflow-hidden w-full max-w-5xl 
                    grid grid-cols-1 md:grid-cols-2">

            {{-- LEFT: Branding --}}
            <div class="hidden md:flex items-center justify-center bg-gray-900 text-white p-10">
                <div class="text-center">
                    <x-heroicon-o-clock class="w-16 h-16 mx-auto mb-4 text-white opacity-90"/>
                    <h1 class="text-3xl font-semibold tracking-wide">PT Absen Terus</h1>
                    <p class="opacity-90 mt-2 text-sm">Sistem Presensi Karyawan</p>
                </div>
            </div>

            {{-- RIGHT: Auth Slot --}}
            <div class="p-10">
                @yield('content')
            </div>
        </div>
    </div>

</body>
</html>
