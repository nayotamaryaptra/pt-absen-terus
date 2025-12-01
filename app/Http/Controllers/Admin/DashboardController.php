<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Attendance;
use App\Models\Employee;
use Carbon\Carbon;

class DashboardController extends Controller
{
    
    public function index()
    {
        $today = Carbon::today()->toDateString();

        $totalEmployees = Employee::count();
        $presentToday = Attendance::where('date', $today)->count();
        $lateToday = Attendance::where('date', $today)->where('status', 'late')->count();
        $absentToday = $totalEmployees - $presentToday;

        // Grafik: total presensi 30 hari terakhir
        $chartData = Attendance::select(
                DB::raw('DATE(date) as day'),
                DB::raw('COUNT(*) as total')
            )
            ->whereBetween('date', [Carbon::now()->subDays(30), Carbon::now()])
            ->groupBy('day')
            ->orderBy('day', 'asc')
            ->get();

        $labels = $chartData->pluck('day')->map(fn($d) => Carbon::parse($d)->format('d M'));
        $values = $chartData->pluck('total');

        return view('admin.dashboard', compact(
            'totalEmployees', 'presentToday', 'lateToday', 'absentToday', 'labels', 'values'
        ));
    }
}
