<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::with('user')
            ->when($request->search, function ($query) use ($request) {
                $query->where('fullname', 'like', "%{$request->search}%")
                    ->orWhereHas('user', function ($q) use ($request) {
                        $q->where('email', 'like', "%{$request->search}%");
                    });
            })
            ->paginate(10);

        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email|unique:users',
            'nik' => 'required|unique:employees,nik',
            'position' => 'required',
        ]);

        $user = User::create([
            'role_id' => 2, // karyawan
            'name' => $request->fullname, // samakan ke kolom Breeze (name)
            'email' => $request->email,
            'password' => Hash::make('karyawan123'),
        ]);

        Employee::create([
            'user_id' => $user->id,
            'nik' => $request->nik,
            'fullname' => $request->fullname,
            'position' => $request->position,
            'department' => $request->department,
            'phone' => $request->phone,
            'address' => $request->address,
            'hired_at' => $request->hired_at,
        ]);

        return redirect()->route('admin.employees.index')
            ->with('success', 'Karyawan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $employee = User::findOrFail($id);
        return view('admin.employees.edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fullname' => 'required',
            'email' => 'required|email',
            'nik' => 'required',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->fullname,
            'email' => $request->email,
        ]);

        $user->employee->update([
            'nik' => $request->nik,
            'fullname' => $request->fullname,
            'position' => $request->position,
            'department' => $request->department,
            'phone' => $request->phone,
            'address' => $request->address,
            'hired_at' => $request->hired_at,
        ]);

        return redirect()->route('admin.employees.index')
            ->with('success', 'Data karyawan berhasil diperbarui.');
    }

    public function destroy(Employee $employee)
    {
        if ($employee->user) {
            $employee->user->delete();
        }
        $employee->delete();
        return back()->with('success', 'Karyawan berhasil dihapus.');
    }
}
