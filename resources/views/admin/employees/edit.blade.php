<x-app-layout>
    <h2 class="text-xl font-semibold mb-4">Edit Karyawan</h2>

    <a href="{{ route('admin.employees.index') }}" class="text-blue-600 mb-4 inline-block">⬅ Kembali</a>

    @if ($errors->any())
        <div class="bg-red-200 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.employees.update', $employee->id) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block">Nama Lengkap</label>
            <input type="text" name="fullname" class="w-full border p-2" value="{{ $employee->employee->fullname ?? '' }}" required>
        </div>

        <div>
            <label class="block">Email</label>
            <input type="email" name="email" class="w-full border p-2" value="{{ $employee->email }}" required>
        </div>

        <div>
            <label class="block">NIK</label>
            <input type="text" name="nik" class="w-full border p-2" value="{{ $employee->employee->nik ?? '' }}" required>
        </div>

        <div>
            <label class="block">Posisi</label>
            <input type="text" name="position" class="w-full border p-2" value="{{ $employee->employee->position ?? '' }}">
        </div>

        <div>
            <label class="block">Departemen</label>
            <input type="text" name="department" class="w-full border p-2" value="{{ $employee->employee->department ?? '' }}">
        </div>

        <div>
            <label class="block">No HP</label>
            <input type="text" name="phone" class="w-full border p-2" value="{{ $employee->employee->phone ?? '' }}">
        </div>

        <div>
            <label class="block">Alamat</label>
            <textarea name="address" class="w-full border p-2">{{ $employee->employee->address ?? '' }}</textarea>
        </div>

        <div>
            <label class="block">Tanggal Masuk</label>
            <input type="date" name="hired_at" class="w-full border p-2" value="{{ $employee->employee->hired_at ?? '' }}">
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
    </form>
</x-app-layout>
