<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>

<h2>Laporan Rekap Kehadiran</h2>

<p>
    Bulan: <strong>{{ $month }}</strong><br>
    Tahun: <strong>{{ $year }}</strong>
</p>

<table>
    <thead>
        <tr>
            <th>Nama</th>
            <th>Tanggal</th>
            <th>Masuk</th>
            <th>Pulang</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        @foreach($records as $r)
        <tr>
            <td>{{ $r->employee->fullname ?? '-' }}</td>
            <td>{{ $r->created_at->format('d-m-Y') }}</td>
            <td>{{ $r->check_in }}</td>
            <td>{{ $r->check_out ?? '-' }}</td>
            <td>{{ $r->status }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
