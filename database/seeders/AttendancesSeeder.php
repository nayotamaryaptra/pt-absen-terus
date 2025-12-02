<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendancesSeeder extends Seeder {
    public function run() {
        // buat sample 7 hari terakhir untuk setiap employee
        $employees = Employee::all();
        foreach ($employees as $emp) {
            for ($i = 7; $i >= 1; $i--) {
                $date = Carbon::today()->subDays($i);
                // random: on_time (08:00), late (08:30), absent (no check_in)
                $rand = rand(1,10);
                if ($rand <= 2) {
                    // absent
                    Attendance::create([
                        'employee_id'=>$emp->id,
                        'date'=>$date->format('Y-m-d'),
                        'status'=>'absent'
                    ]);
                } elseif ($rand <= 6) {
                    // on time
                    Attendance::create([
                        'employee_id'=>$emp->id,
                        'date'=>$date->format('Y-m-d'),
                        'check_in'=>$date->copy()->setTime(10,30,0),
                        'check_out'=>$date->copy()->setTime(17,0,0),
                        'status'=>'on_time'
                    ]);
                } else {
                    // late
                    Attendance::create([
                        'employee_id'=>$emp->id,
                        'date'=>$date->format('Y-m-d'),
                        'check_in'=>$date->copy()->setTime(11,30,0),
                        'check_out'=>$date->copy()->setTime(17,10,0),
                        'status'=>'late'
                    ]);
                }
            }
        }
    }
}
