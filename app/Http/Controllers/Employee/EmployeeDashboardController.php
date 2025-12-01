<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class EmployeeDashboardController extends Controller
{
    public function index()
    {
        $employeeId = Auth::user()->employee->id;
        $today = Carbon::today()->toDateString();

        // Check status presensi hari ini
        $todayAttendance = Attendance::where('employee_id', $employeeId)
            ->where('date', $today)
            ->first();

        // Grafik 7 hari terakhir
        $chartData = Attendance::where('employee_id', $employeeId)
            ->whereBetween('date', [Carbon::now()->subDays(7), Carbon::now()])
            ->orderBy('date', 'asc')
            ->get();

        $labels = $chartData->pluck('date')->map(fn($d) => Carbon::parse($d)->format('d M'));
        $values = $chartData->pluck('status')->map(function ($status) {
            return $status === 'late' ? 1 : ($status === 'on_time' ? 2 : 0);
        });

        return view('employee.dashboard', compact('todayAttendance', 'labels', 'values'));
    }
}
