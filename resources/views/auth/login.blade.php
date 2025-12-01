@extends('layouts.guest')

@section('content')

<h2 class="text-2xl font-bold text-gray-800 mb-2">Selamat Datang</h2>
<p class="text-gray-500 mb-6">Silakan login untuk melanjutkan</p>

<form method="POST" action="{{ route('login') }}" class="space-y-4">
    @csrf

    {{-- Email --}}
    <div>
        <label class="text-sm text-gray-600">Email</label>
        <input type="email" name="email" required autofocus
            class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-gray-900 focus:border-gray-900 transition"/>
    </div>

    {{-- Password --}}
    <div>
        <label class="text-sm text-gray-600">Password</label>
        <input type="password" name="password" required
            class="w-full mt-1 px-4 py-2 border rounded-lg focus:ring-gray-900 focus:border-gray-900 transition"/>
    </div>

    {{-- Remember --}}
    <div class="flex items-center justify-between text-sm">
        <label class="flex items-center gap-2">
            <input type="checkbox" name="remember" class="rounded border-gray-300">
            Ingat saya
        </label>
        
        <a class="text-gray-500 hover:text-gray-900" href="{{ route('password.request') }}">
            Lupa password?
        </a>
    </div>

    {{-- Login Button --}}
    <button class="w-full bg-gray-800 hover:bg-gray-900 text-white py-2 rounded-lg font-medium transition">
        Login
    </button>
</form>


@endsection
