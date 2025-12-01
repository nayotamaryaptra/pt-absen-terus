<x-app-layout>
    <h2 class="text-xl font-bold mb-4">Rekap Kehadiran Karyawan</h2>

    {{-- FILTER + EXPORT ACTIONS --}}
    <div class="flex flex-wrap items-center justify-between gap-4 mb-6">

        {{-- FILTER FORM --}}
        <form method="GET" class="flex items-center gap-3">

            {{-- Month Select --}}
            <div class="relative">
                <select name="month"
                    class="custom-select px-3 py-2 pr-10 border border-gray-300 rounded-lg text-gray-700
                        focus:ring-indigo-500 focus:border-indigo-500 transition w-40">
                    @foreach(range(1,12) as $m)
                        <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                        </option>
                    @endforeach
                </select>

                <x-heroicon-o-chevron-down 
                    class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-500 pointer-events-none" />
            </div>

            {{-- Year Select --}}
            <div class="relative">
                <select name="year"
                    class="custom-select px-3 py-2 pr-10 border border-gray-300 rounded-lg text-gray-700
                        focus:ring-indigo-500 focus:border-indigo-500 transition w-24">
                    @foreach(range(date('Y')-3, date('Y')) as $y)
                        <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>
                            {{ $y }}
                        </option>
                    @endforeach
                </select>

                <x-heroicon-o-chevron-down 
                    class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-500 pointer-events-none" />
            </div>

            {{-- BUTTON FILTER --}}
            <button class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700
                        text-white px-5 py-2 rounded-lg shadow-sm transition">
                <x-heroicon-o-magnifying-glass class="w-5 h-5" />
                Filter
            </button>
        </form>

        {{-- EXPORT BUTTONS --}}
        <div class="flex gap-3">

            <a href="{{ route('admin.attendance.export.pdf', ['month'=>$month,'year'=>$year]) }}"
            class="flex items-center gap-2 bg-rose-500 hover:bg-rose-600
                    text-white px-5 py-2 rounded-lg shadow-sm transition">
                <x-heroicon-o-document-text class="w-5 h-5" />
                PDF
            </a>

            <a href="{{ route('admin.attendance.export.excel', ['month'=>$month,'year'=>$year]) }}"
            class="flex items-center gap-2 bg-emerald-500 hover:bg-emerald-600
                    text-white px-5 py-2 rounded-lg shadow-sm transition">
                <x-heroicon-o-document-arrow-down class="w-5 h-5" />
                Excel
            </a>
        </div>
    </div>

    <table class="w-full border">
        <thead class="bg-slate-200">
            <tr>
                <th class="p-2 border">Nama</th>
                <th class="p-2 border">Tanggal</th>
                <th class="p-2 border">Masuk</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Pulang</th>
            </tr>
        </thead>

        <tbody>
        @forelse($records as $row)
            <tr>
                <td class="p-2 border">{{ $row->user?->name ?? '-' }}</td>
                <td class="p-2 border">{{ $row->created_at->format('d-m-Y') }}</td>
                <td class="p-2 border">{{ $row->check_in }}</td>
                <td class="p-2 border">
                    <span class="{{ $row->status == 'Late' ? 'text-red-600' : 'text-green-600' }}">
                        {{ $row->status }}
                    </span>
                </td>
                <td class="p-2 border">{{ $row->check_out ?? '-' }}</td>
            </tr>

        @empty
            <tr>
                <td colspan="5" class="p-4 text-center text-gray-500">
                    Tidak ada data untuk periode ini
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</x-app-layout>
