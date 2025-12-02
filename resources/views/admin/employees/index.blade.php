<x-app-layout>
    {{-- Page Title --}}
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Kelola Karyawan</h2>

    {{-- Card Container --}}
    <div class="bg-white shadow-md rounded-xl p-6 border border-gray-200">

        {{-- Header Row --}}
        <div class="flex flex-col md:flex-row items-center justify-between gap-3 mb-4">

            {{-- Search --}}
            <form method="GET" class="w-full md:w-auto">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama / email..."
                    class="w-full md:w-64 px-3 py-2 border rounded-lg focus:ring-indigo-500 focus:border-indigo-500 text-gray-700 transition" />
            </form>

            {{-- Add New Button --}}
            <a href="{{ route('admin.employees.create') }}"
            class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 
                    text-white px-5 py-2 rounded-lg shadow-sm transition">
                <x-heroicon-o-user-plus class="w-5 h-5"/>
                Tambah Karyawan
            </a>
        </div>


        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm border-collapse">

                <thead>
                    <tr class="bg-gray-100 text-gray-700 border-b">
                        <th class="text-left px-4 py-3">Nama</th>
                        <th class="text-left px-4 py-3">Email</th>
                        <th class="text-left px-4 py-3">Posisi</th>
                        <th class="text-left px-4 py-3">Telepon</th>
                        <th class="text-center px-4 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    @forelse($employees as $employee)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">{{ $employee->fullname }}</td>
                            <td class="px-4 py-3">{{ $employee->user->email ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $employee->position ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $employee->phone ?? '-' }}</td>

                            <td class="px-4 py-3 flex justify-center gap-3">

                                {{-- Edit --}}
                                <a href="{{ route('admin.employees.edit', $employee->id) }}"
                                class="text-blue-600 hover:text-blue-800 transition">
                                    <x-heroicon-o-pencil-square class="w-5 h-5"/>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('admin.employees.destroy', $employee) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus?')"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 transition">
                                        <x-heroicon-o-trash class="w-5 h-5"/>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 py-4">Belum ada data karyawan</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>


        {{-- Pagination --}}
        <div class="mt-4">
            {{ $employees->links() }}
        </div>

    </div>
</x-app-layout>
