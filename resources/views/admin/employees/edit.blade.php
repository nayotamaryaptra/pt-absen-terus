<x-app-layout>
    <h2 class="text-xl font-semibold mb-4">Edit Karyawan</h2>

    <a href="{{ route('admin.employees.index') }}" class="text-blue-600 mb-4 inline-block">Kembali</a>

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
            <label class="block font-medium">Nama Lengkap</label>
            <input type="text" name="fullname" class="w-full border p-2 rounded"
                   value="{{ $employee->fullname }}" required>
        </div>

        <div>
            <label class="block font-medium">Email</label>
            <input type="email" name="email" class="w-full border p-2 rounded"
                   value="{{ $employee->user->email }}" required>
        </div>

        <div>
            <label class="block font-medium">NIK</label>
            <input type="text" name="nik" class="w-full border p-2 rounded"
                   value="{{ $employee->nik }}" required>
        </div>

        <div>
            <label class="block font-medium">Posisi</label>
            <input type="text" name="position" class="w-full border p-2 rounded"
                   value="{{ $employee->position }}">
        </div>

        <div>
            <label class="block font-medium">Departemen</label>
            <input type="text" name="department" class="w-full border p-2 rounded"
                   value="{{ $employee->department }}">
        </div>

        <div>
            <label class="block font-medium">No HP</label>
            <input type="text" name="phone" class="w-full border p-2 rounded"
                   value="{{ $employee->phone }}">
        </div>

        <div>
            <label class="block font-medium">Alamat</label>
            <textarea name="address" class="w-full border p-2 rounded">{{ $employee->address }}</textarea>
        </div>

        <div>
            <label class="block font-medium">Tanggal Masuk</label>
            <input type="date" name="hired_at" class="w-full border p-2 rounded"
                   value="{{ $employee->hired_at }}">
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Update
        </button>
    </form>
</x-app-layout>
