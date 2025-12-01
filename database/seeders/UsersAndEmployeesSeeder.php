<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class UsersAndEmployeesSeeder extends Seeder {
    public function run() {
        $adminRole = Role::where('name','admin')->first();
        $kRole = Role::where('name','karyawan')->first();

        // Admin user
        User::firstOrCreate(
            ['email' => 'admin@absenterus.test'], // kondisi cek duplikat
            [
                'role_id' => $adminRole->id,
                'name' => 'Admin PT Absen',
                'password' => Hash::make('password123')
            ]
        );

        // 5 karyawan + user accounts
        $karyawanList = [
            ['nik'=>'KAR001','fullname'=>'Wicaksono Catur','email'=>'wicaksono@example.test','position'=>'Staff IT'],
            ['nik'=>'KAR002','fullname'=>'Siti A. Nur','email'=>'siti@example.test','position'=>'HRD'],
            ['nik'=>'KAR003','fullname'=>'Budi Santoso','email'=>'budi@example.test','position'=>'Staff Admin'],
            ['nik'=>'KAR004','fullname'=>'Rina W','email'=>'rina@example.test','position'=>'Marketing'],
            ['nik'=>'KAR005','fullname'=>'Arif Maulana','email'=>'arif@example.test','position'=>'Finance'],
        ];

        foreach($karyawanList as $k) {
            $user = User::firstOrCreate(
                ['email' => $k['email']],
                [
                    'role_id' => $kRole->id,
                    'name' => $k['fullname'],
                    'password' => Hash::make('karyawan123')
                ]
            );
            Employee::create([
                'user_id' => $user->id,
                'nik' => $k['nik'],
                'fullname' => $k['fullname'],
                'position' => $k['position'],
                'department' => 'General',
                'phone' => '0812'.rand(100000,999999),
                'hired_at' => now()->subMonths(rand(1,36))->format('Y-m-d')
            ]);
        }
    }
}
