<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class AttendanceExport implements FromCollection, WithHeadings
{
    protected $month;
    protected $year;

    public function __construct($month = null, $year = null)
    {
        $this->month = $month ?? now()->month;
        $this->year  = $year  ?? now()->year;
    }

    /**
     * Return collection of rows to export.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $rows = Attendance::with('employee')
            ->when($this->month, fn($q) => $q->whereMonth('created_at', $this->month))
            ->when($this->year,  fn($q) => $q->whereYear('created_at', $this->year))
            ->get()
            ->map(function ($r) {
                return [
                    'Nama Karyawan' => $r->employee->fullname ?? '-',
                    'Tanggal'       => $r->created_at->format('d-m-Y'),
                    'Check In'      => $r->check_in,
                    'Check Out'     => $r->check_out ?? '-',
                    'Status'        => $r->status ?? '-',
                ];
            });

        // ensure it's a Collection instance
        return new Collection($rows);
    }

    public function headings(): array
    {
        return [
            'Nama Karyawan',
            'Tanggal',
            'Check In',
            'Check Out',
            'Status',
        ];
    }
}
