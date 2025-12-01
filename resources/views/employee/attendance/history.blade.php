<x-app-layout>
    <h2 class="text-xl font-bold mb-4">Riwayat Kehadiran</h2>

    <table class="w-full border text-sm">
        <thead class="bg-slate-200">
            <tr>
                <th class="p-2 border">Tanggal</th>
                <th class="p-2 border">Masuk</th>
                <th class="p-2 border">Pulang</th>
                <th class="p-2 border">Status</th>
            </tr>
        </thead>

        <tbody>
        @forelse($records as $row)
            <tr>
                <td class="p-2 border">{{ $row->created_at->format('d-m-Y') }}</td>
                <td class="p-2 border">{{ $row->check_in }}</td>
                <td class="p-2 border">{{ $row->check_out ?? '-' }}</td>
                <td class="p-2 border">
                    <span class="{{ $row->status == 'Late' ? 'text-red-600' : 'text-green-600' }}">
                        {{ $row->status }}
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center text-gray-500 p-4">Belum ada presensi.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</x-app-layout>
