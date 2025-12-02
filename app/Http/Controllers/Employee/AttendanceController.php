<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();
        $employeeId = auth()->user()->employee->id;

        $attendanceToday = Attendance::where('employee_id', $employeeId)
            ->where('date', $today)
            ->first();

        return view('employee.attendance', compact('attendanceToday'));
    }

    public function checkIn()
    {
        $employeeId = auth()->user()->employee->id;
        $today = Carbon::today()->toDateString();

        $existing = Attendance::where('employee_id', $employeeId)
            ->where('date', $today)
            ->first();

        if ($existing && $existing->check_in) {
            return back()->with('error', 'Kamu sudah melakukan presensi masuk.');
        }

        $now = Carbon::now();

        // aturan jam masuk
        $officeStart = Carbon::createFromTime(15, 0, 0);

        $status = $now->lessThanOrEqualTo($officeStart) ? 'on_time' : 'late';

        Attendance::updateOrCreate(
            ['employee_id' => $employeeId, 'date' => $today],
            [
                'user_id' => auth()->id(),
                'check_in' => $now,
                'status' => $status
            ]
        );

        return back()->with('success', 'Presensi masuk berhasil.');
    }

    public function checkOut()
    {
        $employeeId = auth()->user()->employee->id;
        $today = Carbon::today()->toDateString();

        $attendance = Attendance::where('employee_id', $employeeId)
            ->where('date', $today)
            ->first();

        if (!$attendance || !$attendance->check_in) {
            return back()->with('error', 'Silakan presensi masuk dulu.');
        }

        if ($attendance->check_out) {
            return back()->with('error', 'Kamu sudah melakukan presensi pulang.');
        }

        Attendance::where('id', $attendance->id)
            ->update([
                'check_out' => Carbon::now(),
                'user_id' => auth()->id()
            ]);

        return back()->with('success', 'Presensi pulang berhasil.');
    }

    public function history(Request $request)
    {
        $month = $request->month ?? now()->month;
        $year =  $request->year ?? now()->year;

        // Ambil employee_id dari user login
        $employeeId = auth()->user()->employee->id;

        // Ambil semua kehadiran berdasarkan employee_id
        $records = Attendance::where('employee_id', $employeeId)
            ->whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('employee.attendance.history', compact('records', 'month', 'year'));
    }
}
