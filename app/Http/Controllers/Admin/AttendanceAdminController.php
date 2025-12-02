<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class AttendanceAdminController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->month ?? now()->month;
        $year = $request->year ?? now()->year;

        $records = Attendance::with('user')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->get();

        $employees = User::where('role_id', 2)->count();
        $presentToday = Attendance::whereDate('created_at', today())->count();

        return view('admin.attendance.index', compact('records', 'month', 'year', 'employees', 'presentToday'));
    }

    public function exportPdf(Request $request)
    {
        $month = $request->month ?? now()->month;
        $year = $request->year ?? now()->year;

        $records = Attendance::with('employee')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->get();

        $pdf = Pdf::loadView('admin.attendance.pdf', [
            'records' => $records,
            'month'   => $month,
            'year'    => $year,
        ]);

        return $pdf->stream("Rekap-Absensi-$month-$year.pdf");
    }

    public function exportExcel(Request $request)
    {
        $month = $request->month ?? now()->month;
        $year  = $request->year ?? now()->year;

        $records = \App\Models\Attendance::with('employee')
            ->when($month, fn($q) => $q->whereMonth('created_at', $month))
            ->when($year,  fn($q) => $q->whereYear('created_at', $year))
            ->get();

        $filename = "rekap-absensi-{$month}-{$year}.csv";

        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $columns = ['Nama Karyawan', 'Tanggal', 'Check In', 'Check Out', 'Status'];

        $callback = function() use ($records, $columns) {
            $output = fopen('php://output', 'w');
            // Optional: write BOM for Excel UTF-8 support
            fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($output, $columns);

            foreach ($records as $r) {
                fputcsv($output, [
                    $r->employee->fullname ?? '-',
                    $r->created_at->format('d-m-Y'),
                    $r->check_in,
                    $r->check_out ?? '-',
                    $r->status ?? '-',
                ]);
            }

            fclose($output);
        };

        return response()->stream($callback, 200, $headers);
    }
}
