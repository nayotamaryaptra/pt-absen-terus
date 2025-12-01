<x-app-layout>
    <h2 class="text-xl font-semibold mb-4">Tambah Karyawan</h2>

    <form method="POST" action="{{ route('admin.employees.store') }}" class="space-y-4">
        @csrf

        <div>
            <label>Nama Lengkap</label>
            <input type="text" name="fullname" class="w-full border p-2 rounded-lg" required>
        </div>

        <div>
            <label>Email</label>
            <input type="email" name="email" class="w-full border p-2 rounded-lg" required>
        </div>

        <div>
            <label>NIK</label>
            <input type="text" name="nik" class="w-full border p-2 rounded-lg" required>
        </div>

        <div>
            <label>Posisi</label>
            <input type="text" name="position" class="w-full border p-2 rounded-lg" required>
        </div>

        <div>
            <label>Departemen</label>
            <input type="text" name="department" class="w-full border p-2 rounded-lg">
        </div>

        <div>
            <label>No HP</label>
            <input type="text" name="phone" class="w-full border p-2 rounded-lg">
        </div>

        <div>
            <label>Alamat</label>
            <textarea name="address" class="w-full border p-2 rounded-lg"></textarea>
        </div>

        <div>
            <label>Tanggal Masuk</label>
            <input type="date" name="hired_at" class="w-full border p-2 rounded-lg">
        </div>

        <button class="bg-blue-600 text-white px-4 py-2 rounded ">
            Simpan
        </button>
    </form>
</x-app-layout>
